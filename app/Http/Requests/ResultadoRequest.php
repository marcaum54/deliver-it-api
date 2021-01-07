<?php

namespace App\Http\Requests;

use App\Models\CorredorProva;
use App\Models\Prova;
use App\Models\Resultado;

class ResultadoRequest extends BaseRequest
{
    public function __construct(Resultado $model)
    {
        $this->model = $model;
    }

    public function rules()
    {
        return [
            'hora_ini' => 'required|date_format:H:i:s',
            'hora_fim' => 'required|date_format:H:i:s|after:hora_ini',
            'corredor_id' => 'required|exists:App\Models\Corredor,id',
            'prova_id' => [
                'required',
                'exists:App\Models\Prova,id',
                function ($attribute, $value, $fail) {
                    $prova = Prova::find($this->prova_id);
                    $exists = $prova->corredores()->where('corredores.id', $this->corredor_id)->count() > 0;
                    if (!$exists) {
                        $fail('Inscrição inválida, não existe essa combinação de: Prova e Corredor.');
                    }
                },
                function ($attribute, $value, $fail) {
                    $corredorProva = CorredorProva::whereCorredorId($this->corredor_id)->whereProvaId($this->prova_id)->first();
                    if ($corredorProva) {
                        $exists = Resultado::whereCorredorProvaId($corredorProva->id)->count();
                        if ($exists) {
                            $fail('Resultado duplicado, já existe a mesma combinação entre: Prova e Corredor.');
                        }
                    }
                },
            ],
        ];
    }

    public function store()
    {
        $corredorProva = CorredorProva::whereCorredorId($this->corredor_id)->whereProvaId($this->prova_id)->first();

        $resultado = new Resultado;
        $resultado->corredor_prova_id = $corredorProva->id;
        $resultado->hora_ini = $this->hora_ini;
        $resultado->hora_fim = $this->hora_fim;
        $resultado->save();

        return $resultado;
    }
}
