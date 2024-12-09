<?php

namespace App\Models;

use App\Models\Image;

class BlogImage extends Image
{
    protected $fillable = [
        'relative_path',
    ];

    protected $relativeFolderPath = 'blog';
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
