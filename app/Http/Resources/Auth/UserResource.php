<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'company_name' => $this->company_name,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
        ];
    }
}
