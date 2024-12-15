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
            'width' => 400,
            'height' => 400,
        ],
        [
            'width' => 1200,
            'height' => 1200,
        ],
    ];
}
