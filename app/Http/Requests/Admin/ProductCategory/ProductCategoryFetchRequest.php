<?php

namespace App\Http\Requests\Admin\ProductCategory;

use App\Http\Requests\FetchRequest;

class ProductCategoryFetchRequest extends FetchRequest
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
