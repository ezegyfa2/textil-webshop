<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;

class RegistrationRequest extends FormRequest
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
                'unique:users,email',
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
            'password' => [
                'required',
                'confirmed', 
                'string',
                'min:8',
                'max:255',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ];
    }
}
