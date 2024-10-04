<?php

namespace App\Models\Product;

use App\Models\Image;
use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'main_image_id',
        'gram_per_m2',
    ];

    protected function casts(): array
    {
        return [
            'gram_per_m2' => 'integer',
        ];
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'product_type_images');
    }

    public function mainImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'main_image_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductTypeSize::class)
            ->orderBy('size_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function cutProperties(): BelongsToMany
    {
        return $this->belongsToMany(CutProperty::class, 'product_type_cut_properties');
    }

    public function fabricProperties(): BelongsToMany
    {
        return $this->belongsToMany(FabricProperty::class, 'product_type_fabric_properties');
    }
}
