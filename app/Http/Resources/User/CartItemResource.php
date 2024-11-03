<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->type->name,
                'price' => $this->product->price,
                'image_src' => $this->product->type->mainImage->getSrc(400),
            ],
            'size' => [
                'name' => $this->size->name,
                'id' => $this->size->id,
            ],
            'combined_color' => [
                'codes' => $this->combinedColor->colors->pluck('code'),
                'id' => $this->combinedColor->id,
            ],
            'quantity' => $this->quantity,
        ];
    }
}
