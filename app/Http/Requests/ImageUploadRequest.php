<?php

namespace App\Http\Requests;

class ImageUploadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => [
                'required',
                'image',
            ],
        ];
    }
}
