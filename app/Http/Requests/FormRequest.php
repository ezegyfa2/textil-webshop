<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as BaseRequest;

class FormRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function passedValidation()
    {
        $formData = $this->all();
        foreach ($this->all() as $fieldName => $fieldValue) {
            if (is_array($fieldValue) && array_key_exists('id', $fieldValue)) {
                $newFieldName = $fieldName . '_id';
                $formData[$fieldName . '_id'] = $fieldValue['id'];
            }
        }
        $this->replace($formData);
    }
}
