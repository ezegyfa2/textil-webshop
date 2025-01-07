<?php

namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\FetchRequest;

class BlogFetchRequest extends FetchRequest
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
