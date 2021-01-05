<?php

namespace App\Http\Requests;

use App\Models\Prova;
use Illuminate\Validation\Rule;

class ProvaRequest extends BaseRequest
{
    public function __construct(Prova $model)
    {
        $this->model = $model;
    }

    public function rules()
    {
        return [
            'tipo' => 'required|in:' . implode(',', Prova::TIPOS),
            'data' => [
                'required',
                'date',
                Rule::unique('provas')->where(function ($query) {
                    return $query
                        ->whereTipo($this->tipo)
                        ->whereData($this->data);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'data.unique' => "Já existe uma prova de '{$this->tipo}' nessa data."
        ];
    }
}
