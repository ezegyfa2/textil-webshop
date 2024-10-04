<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cart\Checkout;
use App\Http\Requests\Admin\Checkout\CheckoutFetchRequest;
use App\Http\Resources\Admin\Checkout\CheckoutResource;
use App\Http\Resources\Admin\Checkout\CheckoutFetchResource;
use App\Http\Resources\Admin\CartItemResource;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Inertia\Inertia;
use Inertia\Response;

class CheckoutController extends Controller
{
    public function fetch(CheckoutFetchRequest $request): AnonymousResourceCollection
    {
        return $this->getFetchResponseByQuery(
            $this->getFetchQuery($request),
            $request,
            CheckoutFetchResource::class
        );
    }

    public function index(): Response
    {
        return Inertia::render('Admin/Checkout/Index');
    }

    public function show(Checkout $checkout): Response
    {
        $checkout->load('cart', 'cart.items', 'cart.items.product');
        return Inertia::render('Admin/Checkout/Show', (new CheckoutResource($checkout))->toArray(request()));
    }

    protected function getFetchQuery(CheckoutFetchRequest $request): Builder
    {
        $search = $request->input('search', '');

        $query = Checkout::with('cart', 'cart.items', 'cart.items.product')
            ->latest();

        if ($search) {
            $query = $query->where(\DB::raw('CONCAT(first_name, last_name)'), 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('company_name', 'LIKE', "%$search%")
                ->orWhere('address', 'LIKE', "%$search%")
                ->orWhere('postal_code', 'LIKE', "%$search%");
        }

        return $query;
    }
}
