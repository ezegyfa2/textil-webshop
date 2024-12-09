<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\FetchRequest;

class ProductTypeFetchRequest extends FetchRequest
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
