<?php

namespace App\Http\Middleware;

use App\Models\Product\ProductCategory;
use App\Enums\Gender;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $categories = ProductCategory::with('image')->get()->map(function($productCategory) {
            if ($productCategory->image) {
                $imageSrc = $productCategory->image->getUrl(450);
            } else {
                $imageSrc = null;
            }

            return [
                'id' => $productCategory->id,
                'name' => $productCategory->name,
                'image_src' => $imageSrc,
                'url' => route('product.index') . '?category=' . $productCategory->id,
            ];
        });

        $genders = array_map(function ($gender) {
            return [
                'name' => Gender::translations[$gender->value],
                'value' => $gender->value,
                'url' => route('product.index') . '?gender=' . $gender->value,
            ];
        }, Gender::cases());
        
        return [
            ...parent::share($request),
            'notifications' => session('notifications') ?? [],
            'cart_items' => session('cartitems') ?? [],
            'cart_item_count' => session('cart_item_count') ?? 0,
            'categories' => $categories,
            'genders' => $genders,
            'auth' => [
                'user' => $request->user(),
            ],
        ];
    }
}
