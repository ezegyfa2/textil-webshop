<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product\ProductCategory;
use App\Models\Product\ProductCategoryImage;
use App\Http\Resources\Admin\ProductCategory\ProductCategoryFetchResource;
use App\Http\Resources\Admin\ProductCategory\ProductCategoryResource;
use App\Http\Requests\Admin\ProductCategory\ProductCategoryFetchRequest;
use App\Http\Requests\Admin\ProductCategory\ProductCategoryRequest;
use App\Http\Requests\ImageUploadRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ProductCategoryController extends Controller
{
    public function fetch(Request $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            ProductCategoryFetchResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('Admin/ProductCategory/Index');
    }

    public function create(): Response
    {
        return Inertia::render('Admin/ProductCategory/Create');
    }

    public function store(ProductCategoryRequest $request): RedirectResponse
    {
        $this->save($request, new ProductCategory);

        return redirect()->route('admin.product-category.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Categoria de produse a fost creată cu succes',
                ],
            ],
        ]);
    }

    public function edit(ProductCategory $productCategory): Response
    {
        $productCategory->load('image');

        return Inertia::render('Admin/ProductCategory/Edit', [
            'product_category' => new ProductCategoryResource($productCategory),
        ]);
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory): RedirectResponse
    {
        $this->save($request, $productCategory);

        return redirect()->route('admin.product-category.index')->with([
            'notifications' => [
                [
                    'type' => 'success',
                    'message' => 'Categoria de produse a fost modificat cu succes',
                ],
            ],
        ]);
    }

    protected function save(ProductCategoryRequest $request, ProductCategory $productCategory): void
    {
        $productCategory->fill($request->except('image'));
        $productCategory->save();
        $productCategory->load('image');
        $image = $request->get('image');
        if ($image) {
            if ($productCategory->image) {
                $productCategory->image->update([
                    'relative_path' => str_replace('/storage/uploads/', '', $image['url']),
                ]);
            } else {
                $image = ProductCategoryImage::create([
                    'relative_path' => str_replace('/storage/uploads/', '', $image['url']),
                ]);
                $productCategory->image_id = $image->id;
            }
        }
        $productCategory->image->createResizedVersions();
    }

    public function delete(ProductCategory $productCategory): JsonResponse
    {
        $productCategory->delete();

        return response()->json('Produsul a fost eliminată cu succes');
    }

    public function uploadImage(ImageUploadRequest $request): JsonResponse
    {
        $path = $request->file('image')->store('public/uploads');

        return response()->json(Storage::url($path));
    }

    public function deleteImage(ProductCategoryImage $productCategoryImage): JsonResponse
    {
        $productCategoryImage->delete();

        return response()->json('A kép sikeresen el lett távolítva');
    }

    protected function getFetchQuery(Request $request): Builder
    {
        $search = $request->input('search', '');

        $query = ProductCategory::latest();

        if ($search) {
            $query = $query->where('name', 'LIKE', "%$search%");
        }

        return $query;
    }
}
