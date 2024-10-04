<?php

namespace App\Http\Requests\Admin\Cart;

use App\Http\Requests\FetchRequest;

class CartItemFetchRequest extends FetchRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'cart_id' => [
                'required',
                'exists:carts,id'
            ],
        ]);
    }
}
