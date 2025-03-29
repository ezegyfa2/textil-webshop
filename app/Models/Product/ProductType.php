<?php

namespace App\Models\Product;

use App\Models\Image;
use App\Models\Model;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'main_image_id',
        'gender',
        'gram_per_m2',
        'product_category_id',
        'brand_id',
    ];

    protected function casts(): array
    {
        return [
            'gender' => Gender::class,
            'gram_per_m2' => 'integer',
        ];
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function($productType) {
            foreach ($productType->images as $image) {
                $image->delete();
            }
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductTypeImage::class);
    }

    public function mainImage(): BelongsTo
    {
        return $this->belongsTo(ProductTypeImage::class, 'main_image_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function sizes(): HasMany
    {
        return $this->hasMany(ProductTypeSize::class)
            ->orderBy('order');
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

    public function getOrderedSizeValues(): array
    {
        $orderedSizes = $this->getOrderedSizes();
        $orderedSizeValues = [];
        if (count($orderedSizes) > 0) {
            $headers = array_keys(array_values($orderedSizes)[0]);
            array_push($orderedSizeValues, ['type', ...$headers]);
            foreach ($orderedSizes as $key => $orderedSize) {
                array_push($orderedSizeValues, array_values([$key, ...$orderedSize]));
            }
        }
        
        return $orderedSizeValues;
    }

    public function getOrderedSizes(): array
    {
        // order mezo
        $orderedSizes = [];
        foreach ($this->sizes as $size) {
            if (!array_key_exists($size->name, $orderedSizes)) {
                $orderedSizes[$size->name] = [];
            }
            $orderedSizes[$size->name][$size->size->name] = $size->value;
        }
        return $orderedSizes;
    }
}
