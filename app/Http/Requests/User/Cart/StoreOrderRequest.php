<?php

namespace App\Http\Requests\User\Cart;

use Illuminate\Foundation\Http\FormRequest;

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
                'phone',
            ],
            'company_name' => [
                'max:250',
            ],
            'address' => [
                'max:500',
            ],
            'postal_code' => [
                'nullable',
                'numeric',
                'max_digits:10',
            ],
        ];
    }
}
