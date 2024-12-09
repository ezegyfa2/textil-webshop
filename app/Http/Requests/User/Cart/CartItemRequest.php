<?php

namespace App\Http\Requests\User\Cart;

use App\Http\Requests\FormRequest;

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
            'combined_color_id' => [
                'required',
                'exists:combined_colors,id',
            ],
            'quantity' => [
                'required',
                'integer',
                'min:1',
            ]
        ];
    }
}
