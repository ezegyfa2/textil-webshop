<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'combined_colors' => $this->combinedColors->map(function ($combinedColor) {
                return [
                    'id' => $combinedColor->id,
                    'codes' => $combinedColor->colors->pluck('code'),
                    'name' => $combinedColor->getName(),
                ];
            }),
            'sizes' => $this->sizes->select(['name', 'id']),
        ];
    }
}
