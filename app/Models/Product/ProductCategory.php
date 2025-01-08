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

    public static function boot()
    {
        parent::boot();

        self::deleted(function($productCategory) {
            $productCategory->image->delete();
        });
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(ProductCategoryImage::class);
    }
}
