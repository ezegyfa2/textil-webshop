<?php

namespace App\Http\Resources\Admin\ProductCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        if ($this->image) {
            $image = [
                'id' => $this->image->id,
                'url' => $this->image->getUrl(770),
            ];
        } else {
            $image = null;
        }
        
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $image,
        ];
    }
}
