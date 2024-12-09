<?php

namespace App\Models\Product;

use App\Models\Image;

class ProductTypeImage extends Image
{
    protected $fillable = [
        'relative_path',
        'product_type_id',
    ];

    protected $relativeFolderPath = 'producttype';
    protected $resizeValues = [
        [
            'width' => 100,
            'height' => 100,
        ],
        [
            'width' => 250,
            'height' => 200,
        ],
        [
            'width' => 450,
            'height' => 600,
        ],
        [
            'width' => 600,
            'height' => 600,
        ],
        [
            'width' => 770,
            'height' => 600,
        ],
    ];
}
