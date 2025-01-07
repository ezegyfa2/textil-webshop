<?php

namespace App\Http\Requests\User\Cart;

use App\Http\Requests\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'max:250',
            ],
            'last_name' => [
                'required',
                'max:250',
            ],
            'email' => [
                'required',
                'max:250',
                'email',
            ],
            'phone' => [
                'nullable',
                'phone:INTERNATIONAL,RO',
            ],
            'company_name' => [
                'max:250',
            ],
            'address' => [
                'max:1000',
            ],
            'postal_code' => [
                'nullable',
                'numeric',
                'max_digits:10',
            ],
        ];
    }
}
