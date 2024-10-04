<?php

namespace App\Http\Middleware;

use App\Models\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class SaveCart
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('cart_id')) {
            session([
                'cart_id' => $this->getCurrentCart()->id,
            ]);
        }
 
        return $next($request);
    }

    protected function getCurrentCart(): Cart
    {
        if (Auth::check()) {
            $cartData = [
                'user_id' => Auth::user()->id,
                'user_type' => User::class,
            ];
            $cart = Cart::where($cartData)
                ->doesntHave('checkout')
                ->first();
            
            return $cart ?? Cart::create($cartData);
        } else {
            $cartData = [
                'user_id' => session()->getId(),
                'user_type' => 'Session',
            ];
            $cart = Cart::where($cartData)
                ->doesntHave('checkout')
                ->first();

            return $cart ?? Cart::create($cartData);
        }
    }
}
