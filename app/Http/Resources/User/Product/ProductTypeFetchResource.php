<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class ProductTypeFetchResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->getPrice(),
            'image_src' => $this->mainImage->getSrc(400),
        ];
    }

    protected function getPrice(): string|array
    {
        $prices = $this->products->pluck('price')->unique();
        if ($prices->count() == 0) {
            throw new \Exception('Invalid product type');
        } else if ($prices->count() == 1) {
            return $prices[0];
        } else {
            return [
                $prices->min(),
                $prices->max(),
            ];
        }
    }
}
