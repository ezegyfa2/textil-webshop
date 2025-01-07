<?php

namespace App\Http\Requests\Admin\Brand;

use App\Http\Requests\FetchRequest;

class BrandFetchRequest extends FetchRequest
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
