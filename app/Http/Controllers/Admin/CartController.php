<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart\CartItem;
use App\Http\Requests\Admin\Cart\CartItemFetchRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CartItemResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CartController extends Controller
{
    public function fetchItems(CartItemFetchRequest $request): AnonymousResourceCollection
    {
        $cartId = $request->cart_id;
        $query = CartItem::with('product', 'product.type', 'product.type.mainImage');
        if ($cartId) {
            $query->where('cart_id', $cartId);
        }

        return $this->getFetchResponseByQuery(
            $query,
            $request,
            CartItemResource::class
        );
    }
}
