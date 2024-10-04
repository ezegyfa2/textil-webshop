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
            'image_sources' => $this->images->map(fn ($image) => $image->getSrc(1200)),
            'fabric_properties' => $this->fabricProperties->pluck('name'),
            'cut_properties' => $this->cutProperties->pluck('name'),
            'products' => ProductResource::collection($this->products),
            'sizes' => $this->getOrderedSizes(),
        ];
    }

    protected function getOrderedSizes(): array
    {
        $orderedSizes = [];
        foreach ($this->sizes as $size) {
            if (!array_key_exists($size->name, $orderedSizes)) {
                $orderedSizes[$size->name] = [];
            }
            $orderedSizes[$size->name][$size->size->name] = $size->value;
        }
        return $orderedSizes;
    }
}
