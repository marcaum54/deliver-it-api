<?php

namespace App\Http\Requests;

use App\Sanitizers\Sanitizer;
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

        $sanitizer = new Sanitizer($sanitizers);
        $sanitizedData = $sanitizer->sanitize($values);

        if ($sanitizedData)
            $this->replace($sanitizedData);
    }

    public function store()
    {
        return $this->model->create($this->all());
    }
}
