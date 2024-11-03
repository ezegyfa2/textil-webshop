<?php

namespace App\Models\Cart;

use App\Models\Product\Product;
use App\Models\Size;
use App\Models\CombinedColor;
use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'product_id',
        'size_id',
        'combined_color_id',
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

    public function combinedColor(): BelongsTo
    {
        return $this->belongsTo(CombinedColor::class, 'combined_color_id');
    }

    public function getSubtotal(): float
    {
        return $this->quantity * $this->product->price;
    }

    public static function getProductItemQuery(int $productId, int $sizeId, int $combinedColorId): Builder
    {
        return static::where('cart_id', session('cart_id'))
            ->where('product_id', $productId)
            ->where('size_id', $sizeId)
            ->where('combined_color_id', $combinedColorId);
    }
}
