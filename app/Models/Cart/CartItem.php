<?php

namespace App\Models\Cart;

use App\Models\Product\Product;
use App\Models\Size;
use App\Models\Color;
use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'size_id',
        'color_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'int',
    ];

    public function product(): BelongsTo
    {
        return $this->BelongsTo(Product::class, 'product_id');
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function getSubtotal(): float
    {
        return $this->quantity * $this->product->price;
    }

    public static function getProductItemQuery(int $productId): Builder
    {
        return static::where('cart_id', session('cart_id'))
            ->where('product_id', $productId);
    }
}
