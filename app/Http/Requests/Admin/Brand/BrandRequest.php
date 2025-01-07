<?php

namespace App\Http\Requests\Admin\Brand;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class BrandRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                Rule::unique('brands', 'name')->ignore($this->route('brand')->id ?? null),
                'required',
                'string',
                'max:250',
            ],
        ];
    }
}
