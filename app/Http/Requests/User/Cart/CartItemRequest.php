<?php

namespace App\Http\Requests\User\Cart;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => [
                'required',
                'exists:products,id',
            ],
            'size_id' => [
                'required',
                'exists:sizes,id',
            ],
            'color_id' => [
                'required',
                'exists:colors,id',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ]
        ];
    }
}
