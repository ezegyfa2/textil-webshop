<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Http\Requests\User\ProductFetchRequest;
use App\Http\Resources\User\Product\ProductFetchResource;
use App\Http\Resources\User\Product\ProductResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Database\Eloquent\Builder;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function fetch(ProductFetchRequest $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            ProductFetchResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('User/Product/Index');
    }

    public function show(Request $request, Product $product): Response
    {
        return Inertia::render('User/Product/Show', (new ProductResource($product))->toArray($request));
    }

    public function getFetchQuery(ProductFetchRequest $request): Builder
    {
        $search = $request->get('search');

        $query = Product::select([
            'id',
            'name',
            'price',
            'main_image_id',
        ]);

        if ($search) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%");
        }

        return $query;
    }
}
