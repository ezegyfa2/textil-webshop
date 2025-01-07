<?php

namespace App\Models;

class Color extends Model
{
    protected $hidden = ['pivot'];

    protected $fillable = [
        'name',
    ];
}
