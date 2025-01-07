<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class ProfileRequest extends FormRequest
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
