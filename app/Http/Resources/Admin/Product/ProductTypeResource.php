<?php

namespace App\Http\Resources\Admin\Product;

use App\Helpers\CommonHelpers;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product_category' => CommonHelpers::getRelationSelectValue($this->category),
            'brand' => CommonHelpers::getRelationSelectValue($this->brand),
            'gram_per_m2' => $this->gram_per_m2,
            'main_image' => $this->main_image_id,
            'images' => $this->images->map(function($image) {
                return [
                    'id' => $image->id,
                    'url' => $image->getUrl(450),
                ];
            }),
        ];
    }
}
