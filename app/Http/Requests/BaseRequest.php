<?php

namespace App\Http\Requests;

use Lukzgois\Sanitizer\Sanitizer;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function sanitizers()
    {
        return [];
    }

    protected function prepareForValidation()
    {
        $values = $this->all();
        $sanitizers = $this->sanitizers();

        foreach ($values as $field => $value)
            if (!$value)
                unset($sanitizers[$field]);

        $sanitizer = new Sanitizer($values, $sanitizers);
        $sanitizedData = $sanitizer->sanitize($values);

        if ($sanitizedData)
            $this->replace($sanitizedData);
    }

    public function is_edit()
    {
        return in_array($this->method(), ['PUT', 'PATCH']);
    }
}
