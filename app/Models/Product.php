<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'description',
        'price',
        'main_image_id',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'float',
        ];
    }

    public function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class, 'product_images');
    }

    public function mainImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'main_image_id');
    }
}
