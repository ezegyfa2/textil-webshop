<?php

namespace App\Http\Requests\Admin\ProductCategory;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class ProductCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                Rule::unique('product_categories', 'name')->ignore($this->route('productCategory')->id),
                'required',
                'string',
                'max:250',
            ],
        ];
    }
}
