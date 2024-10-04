<?php

namespace App\Models\Cart;

use App\Models\Product\Product;
use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'user_type',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function checkout(): HasOne
    {
        return $this->hasOne(Checkout::class);
    }

    public function getTotalPrice(): float
    {
        return $this->items->reduce(fn ($total, $item) => $total + $item->getSubtotal(), 0);
    }

    public static function updateItem(Product $product, int $quantity): void
    {
        $product = Product::find($request->product_id);
        static::getCurrent()->items()->createOrUpdate([
            'product_id' => $product->id,
        ], [
            'quantity' => $quantity,
        ]);
    }

    public static function getCurrent(): Cart
    {
        return static::find(session('cart_id'));
    }
}
