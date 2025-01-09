<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductType;
use App\Models\Product\ProductTypeImage;
use App\Models\Product\Brand;
use App\Models\Product\CutProperty;
use App\Models\Product\FabricProperty;
use App\Models\Color;
use App\Models\Size;
use App\Http\Requests\Admin\Product\ProductTypeRequest;
use App\Http\Requests\Admin\Product\ProductTypeFetchRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Resources\Admin\Product\ProductTypeResource;
use App\Http\Resources\Admin\Product\ProductTypeFetchResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function fetch(ProductTypeFetchRequest $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            ProductTypeFetchResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('Admin/Product/Index');
    }

    public function show(ProductType $productType): Response
    {
        return Inertia::render('Admin/Product/Show', [
            'product' => (new ProductTypeResource($productType))->toArray(request())
        ]);
    }

    public function create(ProductType $productType): Response
    {
        return Inertia::render('Admin/Product/Create', [
            'available_colors' => Color::select(['id', 'name', 'code'])->get(),
        ]);
    }

    public function store(ProductTypeRequest $request, ProductType $productType): RedirectResponse
    {
        $this->save($request, new ProductType);

        return redirect()->route('admin.product.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Produsul a fost modificat cu succes',
                ],
            ],
        ]);
    }

    public function edit(ProductType $productType): Response
    {
        $productType->load('fabricProperties', 'cutProperties', 'sizes', 'sizes.size', 'products', 'products.sizes',
            'products.combinedColors', 'products.combinedColors.colors');

        return Inertia::render('Admin/Product/Edit', [
            'product' => new ProductTypeResource($productType),
            'available_colors' => Color::select(['id', 'name', 'code'])->get(),
        ]);
    }

    public function update(ProductTypeRequest $request, ProductType $productType): RedirectResponse
    {
        $this->save($request, $productType);

        return redirect()->route('admin.product.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Produsul a fost modificat cu succes',
                ],
            ],
        ]);
    }

    protected function save(ProductTypeRequest $request, ProductType $productType): void
    {
        $productType->fill($request->except('brand', 'product_category', 'fabric_properties', 'cut_properties'));
        $productType->save();
        $fabricProperties = $this->createDataFromComboboxValues($request->get('fabric_properties', []));
        $this->updateManyToManyRelatedModels($productType, 'fabricProperties', $fabricProperties);
        $cutProperties = $this->createDataFromComboboxValues($request->get('cut_properties', []));
        $this->updateManyToManyRelatedModels($productType, 'cutProperties', $cutProperties);
        $this->updateSizes($productType, $request);
        $this->updateProducts($productType, $request);
        $this->updateImages($request, $productType);
    }

    protected function updateSizes(ProductType $productType, ProductTypeRequest $request): void
    {
        $sizes = $request->get('sizes', []);
        $productType->sizes()->delete();
        if (count($sizes) > 1) {
            $order = 1;
            for ($sizeRowIndex = 1; $sizeRowIndex < count($sizes); ++$sizeRowIndex) {
                for ($sizeColumnIndex = 1; $sizeColumnIndex < count($sizes[$sizeRowIndex]); ++$sizeColumnIndex) {
                    $size = Size::firstOrCreate(['name' => $sizes[0][$sizeColumnIndex]]);
                    $productType->sizes()->create([
                        'name' => $sizes[$sizeRowIndex][0],
                        'value' => $sizes[$sizeRowIndex][$sizeColumnIndex],
                        'order' => $order,
                        'size_id' => $size->id,
                    ]);
                    ++$order;
                }
            }
        }
    }

    protected function updateProducts(ProductType $productType, ProductTypeRequest $request): void
    {
        $productsData = $request->get('products', []);
        $this->updateRelatedModels($productType, 'products', $productsData, function ($product, $productData) {
            $sizes = array_map(function ($sizeName) {
                $size = Size::firstOrCreate([ 'name' => $sizeName ]);
                return [
                    'id' => $size->id,
                    'name' => $size->name,
                ];
            }, $productData['sizes'] ?? []);
            $this->updateManyToManyRelatedModels($product, 'sizes', $sizes);

            $product->combinedColors()->sync([]);

            $this->updateManyToManyRelatedModels(
                $product,
                'combinedColors',
                $productData['combined_colors'] ?? [], 
                function ($combinedColor, $combinedColorData) {
                    $this->updateManyToManyRelatedModels($combinedColor, 'colors', $combinedColorData['codes'] ?? []);
                }
            );
        });
    }

    protected function updateImages(ProductTypeRequest $request, ProductType $productType): void
    {
        // Unset doesn't work with foreach
        $imageData = array_map(function($image) {
            if (!array_key_exists('id', $image)) {
                $image['relative_path'] = str_replace('/storage/uploads/', '', $image['url']);
            }
            unset($image['url']);
            if (!array_key_exists('description', $image)) {
                $image['description'] = null;
            }

            return $image;
        }, $request->get('images'));

        $this->updateRelatedModels($productType, 'images', $imageData);
        $this->updateDefaultImage($request, $productType);
        $this->moveRelatedFilesFromUploads($productType, 'images');
        foreach ($productType->images as $image) {
            $image->createResizedVersions();
        }
    }

    protected function updateDefaultImage(ProductTypeRequest $request, ProductType $productType): void
    {
        if ($request->get('main_image')) {
            if (is_numeric($request->get('main_image'))) {
                $productType->main_image_id = $request->get('main_image');
            } else {
                $mainImageRelativePath = pathinfo($request->get('main_image'), PATHINFO_BASENAME);
                $productTypeImage = ProductTypeImage::where(
                    'relative_path',
                    $mainImageRelativePath
                )->first();
                if (!$productTypeImage) {
                    $productTypeImage = ProductTypeImage::where(
                        'relative_path',
                        $request->get('main_image')
                    )->first();
                }
                $productType->main_image_id = $productTypeImage->id;
            }
            $productType->save();
        }
    }

    public function delete(ProductType $productType): JsonResponse
    {
        $productType->delete();

        return response()->json('Produsul a fost eliminată cu succes');
    }

    public function uploadImage(ImageUploadRequest $request): JsonResponse
    {
        $path = $request->file('image')->store('public/uploads');

        return response()->json(Storage::url($path));
    }

    public function deleteImage(ProductTypeImage $productTypeImage): JsonResponse
    {
        $productTypeImage->delete();

        return response()->json('Imaginea a fost eliminată cu succes');
    }

    protected function getFetchQuery(ProductTypeFetchRequest $request): Builder
    {
        $search = $request->input('search', '');

        $query = ProductType::with('category', 'brand')
            ->latest();

        if ($search) {
            $query = $query->where('name', 'LIKE', "%$search%")
                ->orWhereHas('category', function (Builder $query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                })
                ->orWhereHas('brand', function (Builder $query) use ($search) {
                    $query->where('name', 'LIKE', "%$search%");
                });
        }

        return $query;
    }

    public function searchCategory(Request $request): Collection
    {
        return ProductCategory::where('name', 'LIKE', "%{$request->get('search')}%")
            ->take(10)
            ->select([
                'name',
                'id',
            ])
            ->get();
    }

    public function searchBrand(Request $request): Collection
    {
        return Brand::where('name', 'LIKE', "%{$request->get('search')}%")
            ->take(10)
            ->select([
                'name',
                'id',
            ])
            ->get();
    }
    
    public function searchFabricProperty(Request $request): JsonResponse
    {
        $searchValue = "%{$request->get('search')}%";
        $fabricProperties = FabricProperty::where('name', 'LIKE', $searchValue)
            ->select(['id', 'name'])
            ->take(10)
            ->get();

        return response()->json($fabricProperties);
    }
    
    public function searchCutProperty(Request $request): JsonResponse
    {
        $searchValue = "%{$request->get('search')}%";
        $cutProperties = CutProperty::where('name', 'LIKE', $searchValue)
            ->select(['id', 'name'])
            ->take(10)
            ->get();

        return response()->json($cutProperties);
    }
}
