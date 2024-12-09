<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class CommonHelpers
{
    public static function getImageSrc(string $imageName, int $width): string
    {
        return Storage::url('images/'.$imageName.'/'.$width.'.webp');
    }

    public static function getFirstSentence(string $text): string
    {
        return preg_replace('/(.*?[?!.](?=\s|$)).*/', '\\1', $text);
    }

    public static function getRelationSelectValue($model, string $textField = 'name'): ?array
    {
        if ($model) {
            return [
                'id' => $model->id ?? null,
                $textField => $model->$textField ?? '-',
            ];
        } else {
            return null;
        }
    }

    public static function concatenateStrings(array|Collection $stringsToConcatenate, string $concatenator)
    {
        $result = '';
        foreach ($stringsToConcatenate as $stringToConcatenate) {
            $result .= $stringToConcatenate . $concatenator;
        }
        return substr($result, 0, strlen($result) - strlen($concatenator));
    }
}
