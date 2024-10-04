<?php

namespace App\Http\Requests\Admin\User;

use App\Http\Requests\FetchRequest;

class UserFetchRequest extends FetchRequest
{
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'search' => [
                'nullable',
                'string',
            ],
        ]);
    }
}
