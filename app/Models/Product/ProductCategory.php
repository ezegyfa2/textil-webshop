<?php

namespace App\Models\Product;

use App\Models\Model;
use App\Models\Product\ProductCategoryImage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(ProductCategoryImage::class);
    }
}
