<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class Helpers
{
    const DATE_FORMAT = 'Y-m-d';
    const DATE_FORMAT_VALIDATION = 'date_format:' . self::DATE_FORMAT;

    public static function createSelectOptions(array $items): array
    {
        return array_map(function ($key) use($items) {
            return [
                'title' => $items[$key],
                'value' => $key,
            ];
        }, array_keys($items));
    }
    
    public static function getTranslatedSelectValues(Collection|array $relatedModels, string $textField = 'name'): Collection
    {
        return collect($relatedModels)->map(function ($relatedModel) use ($textField) {
            return self::getRelationTranslatedSelectValue($relatedModel, $textField);
        });
    }

    public static function getRelationTranslatedSelectValue($model, string $textField = 'name'): ?array
    {
        if ($model) {
            return [
                'id' => $model->id ?? null,
                $textField => $model->getTranslatedDetails()->$textField ?? '-',
            ];
        } else {
            return null;
        }
    }

    public static function getSelectValues(Collection|array $relatedModels, string $textField = 'name'): Collection
    {
        return collect($relatedModels)->map(function ($relatedModel) use ($textField) {
            return self::getRelationSelectValue($relatedModel, $textField);
        });
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

    public static function concatenateStrings(Array $stringsToConcatenate, string $concatenator)
    {
        $result = '';
        foreach ($stringsToConcatenate as $stringToConcatenate) {
            $result .= $stringToConcatenate . $concatenator;
        }
        return substr($result, 0, strlen($result) - strlen($concatenator));
    }

    public static function shortString(?string $text, int $maxLength = 50): ?string
    {
        if ($text) {
            if (strlen($text) > $maxLength) {
                return mb_substr($text, 0, $maxLength, 'UTF-8') . '...';
            }
            else {
                return $text;
            }
        } else {
            return null;
        }
    }

    public static function hasContent(array $itemToCheck, array $propertiesToCheck = null): bool
    {
        if (!$propertiesToCheck) {
            $propertiesToCheck = array_keys($itemToCheck);
        }
        foreach ($propertiesToCheck as $propertyToCheck) {
            if (array_key_exists($propertyToCheck, $itemToCheck) && $itemToCheck[$propertyToCheck] !== null) {
                return true;
            }
        }
        return false;
    }

    public static function getUrlSafeText(?string $text): ?string
    {
        if ($text) {
            $transliterator = \Transliterator::createFromRules(
                ':: Any-Latin; :: Latin-ASCII; :: NFD; :: [:Nonspacing Mark:] Remove; :: NFC;', 
                \Transliterator::FORWARD
            );
            $text = $transliterator->transliterate($text);
           
            return preg_replace('/\W+/', '-', strtolower(trim($text)));
        } else {
            return $text;
        }
    }

    public static function filterNullDetails(array $details): array
    {
        return array_filter($details, function ($detail) {
            return !self::isNullItem($detail);
        });
    }

    public static function isNullItem(array $detail): bool
    {
        foreach ($detail as $key => $detailValue) {
            if ($key != 'language' && !is_null($detailValue)) {
                return false;
            }
        }
        return true;
    }
}
