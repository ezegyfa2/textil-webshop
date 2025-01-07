<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'purchase_price' => $this->purchase_price,
            'combined_colors' => $this->combinedColors->map(function ($combinedColor) {
                return [
                    'id' => $combinedColor->id,
                    'codes' => $combinedColor->colors()->select(['colors.id', 'name', 'code'])->get(),
                ];
            }),
            'sizes' => $this->sizes->select('name')->pluck('name'),
        ];
    }
}
