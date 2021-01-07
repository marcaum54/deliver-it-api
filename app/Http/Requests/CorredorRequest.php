<?php

namespace App\Http\Requests;

use App\Models\Corredor;

class CorredorRequest extends BaseRequest
{
    public function __construct(Corredor $model)
    {
        $this->model = $model;
    }

    public function sanitizers()
    {
        return ['cpf' => 'cpf'];
    }

    public function rules()
    {
        return [
            'nome' => 'required',
            'cpf' => 'required|numeric|regex:/^\d{11}$/|unique:App\Models\Corredor,cpf',
            'data_nascimento' => [
                'required',
                function ($attribute, $value, $fail) {
                    $start_date = date_create($value);
                    $diff = date_diff($start_date, now());
                    if ($diff->y < 18) {
                        $fail('Não é permitida a inscrição de menores de idade.');
                    }
                }
            ],
        ];
    }
}
