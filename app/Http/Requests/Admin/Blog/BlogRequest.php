<?php

namespace App\Http\Requests\Admin\Blog;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                Rule::unique('blogs', 'title')->ignore($this->route('blog')->id ?? null),
                'required',
                'string',
                'max:255',
            ],
            'short_content' => [
                'required',
                'string',
                'max:1000',
            ],
        ];
    }
}
