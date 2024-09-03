<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class CommonHelpers
{
    public static function getImageSrc(string $imageName): string
    {
        return Storage::url('images/'.$imageName);
    }

    public static function getFirstSentence(string $text): string
    {
        return preg_replace('/(.*?[?!.](?=\s|$)).*/', '\\1', $text);
    }
}
