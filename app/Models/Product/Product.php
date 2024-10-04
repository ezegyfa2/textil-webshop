<?php

namespace App\Models\Product;

use App\Models\Color;
use App\Models\Size;
use App\Models\Cart\CartItem;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'price',
        'product_type_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'float',
        ];
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'product_sizes')->orderBy('size_id');
    }

    public function currentCartItem()
    {
        return $this->hasOne(CartItem::class, 'product_id')
            ->where('cart_id', session('cart_id'));
    }
}
