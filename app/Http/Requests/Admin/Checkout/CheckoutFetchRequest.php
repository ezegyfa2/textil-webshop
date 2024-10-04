<?php

namespace App\Http\Requests\Admin\Checkout;

use App\Http\Requests\FetchRequest;

class CheckoutFetchRequest extends FetchRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'search' => [
                'nullable',
                'string'
            ],
        ]);
    }
}
