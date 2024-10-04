<?php

namespace App\Http\Resources\Admin\Checkout;

use App\Http\Resources\Admin\CartItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckoutResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'cart_id' => $this->cart_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company_name' => $this->company_name,
            'address' => $this->address,
            'postal_code' => $this->postal_code,
            'total_price' => $this->cart->getTotalPrice(),
        ];
    }
}
