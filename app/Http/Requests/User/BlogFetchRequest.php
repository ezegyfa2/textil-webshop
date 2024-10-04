<?php

namespace App\Http\Requests\User;

use App\Http\Requests\FetchRequest;

class BlogFetchRequest extends FetchRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'search' => [
                'string',
                'nullable',
                'max:255'
            ],
        ]);
    }
}
