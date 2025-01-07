<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\FormRequest;

class ProductTypeRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],
            'gram_per_m2' => [
                'nullable',
                'numeric',
                'min:0',
            ],
            'product_category' => [
                'required',
            ],
            'product_category.id' => [
                'required',
                'exists:product_categories,id',
            ],
            'brand' => [
                'required',
            ],
            'brand.id' => [
                'required',
                'exists:brands,id',
            ],
            'sizes' => [
                'array',
            ],
            'sizes.*' => [
                'array',
            ],
            'products' => [
                'array',
                'min:1',
            ],
            'products.*' => [
                'array',
            ],
            'products.*.price' => [
                'numeric',
                'min:0',
            ],
            'products.*.sizes' => [
                'array',
            ],
            'products.*.purchase_price' => [
                'numeric',
                'min:0',
            ],
            'products.*.combined_colors' => [
                'array',
                'min:1',
            ],
        ];
    }
}
