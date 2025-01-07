<?php

namespace App\Http\Resources\Admin\ProductCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryFetchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}