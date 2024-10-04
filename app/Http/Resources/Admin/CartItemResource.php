<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'product' => [
                'name' => $this->product->type->name,
                'price' => $this->product->price,
                'image_src' => $this->product->type->mainImage->getSrc(400),
            ],
            'quantity' => $this->quantity,
        ];
    }
}
