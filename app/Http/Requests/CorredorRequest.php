<?php

namespace App\Http\Requests;

class CorredorRequest extends BaseRequest
{
    public function sanitizers()
    {
        return [
            'cpf' => 'filter_var:' . FILTER_SANITIZE_NUMBER_INT,
        ];
    }

    public function rules()
    {
        return [
            'nome' => 'required',
            'cpf' => 'required|numeric|size:11',
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
