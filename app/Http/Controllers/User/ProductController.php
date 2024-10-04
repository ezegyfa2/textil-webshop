<?php

namespace App\Http\Controllers\User;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product\ProductType;
use App\Models\Product\ProductCategory;
use App\Http\Requests\User\ProductTypeFetchRequest;
use App\Http\Resources\User\Product\ProductTypeFetchResource;
use App\Http\Resources\User\Product\ProductTypeResource;
use App\Http\Controllers\Controller;
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
        return Inertia::render('User/Product/Index', [
            'sizes' => Size::all()->select(['name', 'id']),
            'colors' => Color::all()->select(['name', 'id']),
            'categories' => ProductCategory::all()->select(['name', 'id']),
        ]);
    }

    public function show(Request $request, ProductType $productType): Response
    {
        $productType->load('sizes', 'sizes.size', 'products', 'products.colors', 'products.sizes');
        return Inertia::render('User/Product/Show', (new ProductTypeResource($productType))->toArray($request));
    }

    public function getFetchQuery(ProductTypeFetchRequest $request): Builder
    {
        $query = ProductType::with('products', 'mainImage');
        
        if ($request->search) {
            $query->where('name', 'LIKE', "%$request->search%");
        }
        $query->whereExists(function (QueryBuilder $filterQuery) use ($request) {
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
                $filterQuery->join('product_colors', 'product_colors.product_id', 'products.id')
                    ->whereIn('color_id', $request->color_ids);
            }
        });
        if ($request->category_ids) {
            $request->whereIn('product_category_id', $request->category_ids);
        }

        return $query;
    }
}
