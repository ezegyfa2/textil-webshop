<?php

namespace App\Http\Requests\User\Cart;

use App\Http\Requests\FetchRequest;

class CartItemFetchRequest extends FetchRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'cart_id' => [
                'nullable',
                'exists:carts'
            ],
        ]);
    }
}
