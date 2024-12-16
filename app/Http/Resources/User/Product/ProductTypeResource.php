<?php

namespace App\Http\Resources\User\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gram_per_m2' => $this->gram_per_m2,
            'brand' => $this->brand->name,
            'category' => $this->category->name,
            'image_sources' => $this->images->map(fn ($image) => $image->getUrl(1200)),
            'fabric_properties' => $this->fabricProperties->pluck('name'),
            'cut_properties' => $this->cutProperties->pluck('name'),
            'products' => ProductResource::collection($this->products),
            'sizes' => $this->getOrderedSizes(),
        ];
    }
}
