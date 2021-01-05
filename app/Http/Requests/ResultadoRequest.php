<?php

namespace App\Http\Requests;

use App\Models\Resultado;
use Illuminate\Support\Facades\Input;

class ResultadoRequest extends BaseRequest
{
    public function __construct(Resultado $model)
    {
        $this->model = $model;
    }

    public function rules()
    {
        return [
            'corredor_id' => 'required',
            'prova_id' => 'required',

            'hora_ini' => 'required',
            'hora_fim' => [
                'required',
                function ($attribute, $value, $fail) {
                    $hora_ini = Input::get('hora_ini');
                    if ($value <= $hora_ini) {
                        $fail("O campo deve conter um valor maior que: '{$hora_ini}'");
                    }
                }
            ],
        ];
    }

    public function store()
    {
        $all = $this->all();

        $corredor_id = $all['corredor_id'];
        $prova_id = $all['prova_id'];
    }
}
