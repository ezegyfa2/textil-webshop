<?php

namespace App\Models;

use App\Helpers\CommonHelpers;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Image extends Model
{
    protected $fillable = [
        'src',
    ];

    public function getSrc(int $width)
    {
        return CommonHelpers::getImageSrc($this->src, $width);
    }
}
