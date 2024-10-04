<?php

namespace App\Models\Product;

use App\Models\Size;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTypeSize extends Model
{
    protected $fillable = [
        'name',
        'value',
        'size_id',
        'product_type_id',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'integer',
        ];
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(ProductType::class);
    }
}
