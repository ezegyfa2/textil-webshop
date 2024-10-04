<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

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
                'unique:users',
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
            'password' => [
                'required',
                'confirmed', 
                'password',
                'min:8',
            ],
        ];
    }
}
