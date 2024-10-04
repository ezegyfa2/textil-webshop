<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FetchRequest;

class ProductTypeFetchRequest extends FetchRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'search' => [
                'string',
                'nullable',
                'max:255'
            ],
            'from_price' => [
                'numeric',
                'nullable',
                'min:0',
            ],
            'to_price' => [
                'numeric',
                'nullable',
                $this->from_price ? 'gte:from_price' : '',
            ],
            'category_ids' => [
                'array',
                'nullable',
            ],
            'category_ids.*' => [
                'exists:product_categories,id',
            ],
            'size_ids' => [
                'array',
                'nullable',
            ],
            'size_ids.*' => [
                'exists:sizes,id',
            ],
            'color_ids' => [
                'array',
                'nullable',
            ],
            'color_ids.*' => [
                'exists:colors,id',
            ],
        ]);
    }
}
