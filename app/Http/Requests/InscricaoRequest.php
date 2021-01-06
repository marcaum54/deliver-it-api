<?php

namespace App\Http\Requests;

use App\Models\Corredor;
use App\Models\Prova;
use Illuminate\Validation\Rule;

class InscricaoRequest extends BaseRequest
{
    public function __construct(Prova $model)
    {
        $this->model = $model;
    }

    public function rules()
    {
        return [
            'prova_id' => 'required|exists:App\Models\Prova,id',
            'corredor_id' => [
                'required',
                'exists:App\Models\Corredor,id',
                Rule::unique('corredor_prova')->where(function ($query) {
                    return $query
                        ->whereProvaId($this->prova_id)
                        ->whereCorredorId($this->corredor_id);
                }),
            ],
        ];
    }

    public function messages()
    {
        return [
            'corredor_id.unique' => 'Já existe uma inscrição desse corredor nessa prova.',
        ];
    }

    public function store()
    {
        $prova = Prova::find($this->prova_id);
        $corredor = Corredor::find($this->corredor_id);

        $prova->corredores()->attach($corredor);

        return compact('prova', 'corredor');
    }
}
