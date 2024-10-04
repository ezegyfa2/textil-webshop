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
            'colors' => $this->colors->select(['name', 'id']),
            'sizes' => $this->sizes->select(['name', 'id']),
        ];
    }
}
