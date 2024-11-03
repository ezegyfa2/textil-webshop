<?php

namespace App\Http\Controllers\User;

use App\Models\Cart\Checkout;
use App\Models\Cart\Cart;
use App\Models\Cart\CartItem;
use App\Models\Product\Product;
use App\Http\Requests\User\Cart\CartItemRequest;
use App\Http\Requests\User\Cart\CartItemFetchRequest;
use App\Http\Requests\User\Cart\UpdateCartRequest;
use App\Http\Requests\User\Cart\StoreOrderRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\CartItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function cart(): Response
    {
        return Inertia::render('User/Cart/Cart');
    }

    public function checkout(Request $request): Response
    {
        $items = CartItem::where([
            'cart_id' => session('cart_id'),
        ])->with('product', 'product.type', 'product.type.mainImage', 'size', 'combinedColor', 'combinedColor.colors')
            ->get();
        if (Auth::check()) {
            $userData = Auth::user()->getAttributes();
        } else {
            $userData = [];
        }
        
        return Inertia::render('User/Cart/Checkout', array_merge($userData, [
            'items' => CartItemResource::collection($items),
        ]));
    }

    public function storeOrder(StoreOrderRequest $request): RedirectResponse
    {
        $checkout = Checkout::create([
            'cart_id' => session('cart_id'),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
        ]);
        if (Auth::check()) {
            // Ez nem biztos h kell
            //Auth::user()->updateProfileByCheckout($checkout);
        }
        session(['cart_id' => null]);
        session(['cart_item_count' => 0]);

        return redirect()->route('thank-you');
    }

    public function addToCart(CartItemRequest $request): RedirectResponse
    {
        $correspondingCartItems = CartItem::getProductItemQuery(
            $request->get('product_id'),
            $request->get('size_id'),
            $request->get('combined_color_id')
        )->get();

        if ($correspondingCartItems->count() == 0) {
            CartItem::create([
                'cart_id' => session('cart_id'),
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'combined_color_id' => $request->combined_color_id,
                'quantity' => $request->quantity,
            ]);
            session(['cart_item_count' => session('cart_item_count') + 1]);
        } else {
            $currentItem = $correspondingCartItems[0];
            $currentItem->update([
                'quantity' => $currentItem->quantity + $request->quantity,
            ]);
        }
        
        return redirect()->route('product.index')->with([
            'notifications' => [ 
                [
                    'type' => 'success',
                    'message' => 'Produsul a fost adăugate cu succes la coșul dvs.',
                ]
            ]
        ]);
    }

    public function removeFromCart(CartItemRequest $request): JsonResponse
    {
        $correspondingCartItems = CartItem::getProductItemQuery(
            $request->get('product_id'),
            $request->get('size_id'),
            $request->get('combined_color_id')
        )->get();

        if ($correspondingCartItems->count() == 0) {
            throw new \Exception('Product has not been added to cart');
        } else {
            $correspondingCartItems->each(function ($correspondingItem) {
                $correspondingItem->delete();
                session(['cart_item_count' => session('cart_item_count') - 1]);
            });

            return response()->json([
                'message' => 'Produsul a fost eliminat cu succes din coș',
            ]);
        }
    }

    public function update(UpdateCartRequest $request): JsonResponse
    {
        CartItem::getProductItemQuery(
            $request->get('product_id'),
            $request->get('size_id'),
            $request->get('combined_color_id')
        )->update([
            'quantity' => $request->get('quantity'),
        ]);

        return response()->json([
            'message' => 'Cantitatea produsului au fost modificate cu succes',
        ]);
    }

    public function fetchItems(CartItemFetchRequest $request): AnonymousResourceCollection
    {
        $cartId = $request->cart_id;
        if (!$cartId) {
            $cartId = session('cart_id');
        }
        $query = CartItem::where('cart_id', $cartId)
            ->with('product', 'product.type', 'product.type.mainImage', 'size', 'combinedColor', 'combinedColor.colors');

        return $this->getFetchResponseByQuery(
            $query,
            $request,
            CartItemResource::class
        );
    }
}
