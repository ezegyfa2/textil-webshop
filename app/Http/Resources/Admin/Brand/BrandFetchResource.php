<?php

namespace App\Http\Resources\Admin\Brand;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandFetchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
