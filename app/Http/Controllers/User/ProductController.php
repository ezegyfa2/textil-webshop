<?php

namespace App\Http\Controllers\User;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product\Brand;
use App\Models\Product\ProductType;
use App\Models\Product\ProductCategory;
use App\Models\Product\FabricProperty;
use App\Models\Product\CutProperty;
use App\Http\Requests\User\ProductTypeFetchRequest;
use App\Http\Resources\User\Product\ProductTypeFetchResource;
use App\Http\Resources\User\Product\ProductTypeResource;
use App\Enums\Gender;
use App\Http\Controllers\Controller;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
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
        $sizes = Size::whereIn('name', [
            'XXS',
            'XS',
            'S',
            'M',
            'L',
            'XL',
            '2XL',
            '3XL',
            '4XL',
            '5XL',
        ])->select(['name', 'id'])->orderBy('id')->get();
        $genders = Helpers::createSelectOptions(Gender::translations);
        
        return Inertia::render('User/Product/Index', [
            'choosed_category_id' => request()->get('category'),
            'choosed_brand_id' => request()->get('brand'),
            'choosed_gender' => request()->get('gender'),
            'sizes' => $sizes,
            'brands' => Brand::select(['name', 'id'])->get(),
            //'colors' => Color::all()->select(['name', 'id']),
        ]);
    }

    public function show(Request $request, ProductType $productType): Response
    {
        $productType->load('sizes', 'sizes.size', 'products', 'products.combinedColors', 
            'products.combinedColors.colors', 'products.sizes');

        return Inertia::render('User/Product/Show', (new ProductTypeResource($productType))->toArray($request));
    }

    public function getFetchQuery(ProductTypeFetchRequest $request): Builder
    {
        $query = ProductType::with('products', 'mainImage');
        
        if ($request->search) {
            $query->where('name', 'LIKE', "%$request->search%");
        }
        $query->whereHas('products', function (Builder $filterQuery) use ($request) {
            $filterQuery->select('products.id')
                ->from('products');
            if ($request->from_price) {
                $filterQuery->where('price', '>=', $request->from_price);
            }
            if ($request->to_price) {
                $filterQuery->where('price', '<=', $request->to_price);
            }
            if ($request->size_ids) {
                $filterQuery->join('product_sizes', 'product_sizes.product_id', 'products.id')
                    ->whereIn('size_id', $request->size_ids);
            }
            if ($request->color_ids) {
                $filterQuery->join(
                    'product_combined_colors',
                    'product_combined_colors.product_id',
                    'products.id'
                )->join(
                    'combined_color_colors',
                    'combined_color_colors.combined_color_id',
                    'product_combined_colors.combined_color_id'
                )->whereIn('combined_color_colors.color_id', $request->color_ids);
            }
        });
        if ($request->category_ids) {
            $query->whereIn('product_category_id', $request->category_ids);
        }
        if ($request->brand_ids) {
            $query->whereIn('brand_id', $request->brand_ids);
        }
        if ($request->genders) {
            $query->whereIn('gender', $request->genders);
        }
        
        return $query;
    }
}
