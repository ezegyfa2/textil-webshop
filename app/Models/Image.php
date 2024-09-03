<?php

namespace App\Models;

use App\Helpers\CommonHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use Notifiable;

    protected $fillable = [
        'src',
    ];

    public function src(): Attribute
    {
        return  Attribute::make(
            get: fn (string $value) => CommonHelpers::getImageSrc($value),
        );
    }
}
