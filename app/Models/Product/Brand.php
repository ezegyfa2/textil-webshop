<?php

namespace App\Models\Product;

use App\Models\Model;
use App\Models\Product\BrandImage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'image_id',
    ];

    public function image(): BelongsTo
    {
        return $this->belongsTo(BrandImage::class);
    }
}
