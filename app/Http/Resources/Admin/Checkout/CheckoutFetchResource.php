<?php

namespace App\Http\Resources\Admin\Checkout;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutFetchResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name . $this->last_name,
            'company_name' => $this->company_name,
            'items_count' => $this->cart->items->count(),
            'total_price' => $this->cart->getTotalPrice(),
            'created_at' => $this->created_at->format('Y.m.d'),
        ];
    }
}
