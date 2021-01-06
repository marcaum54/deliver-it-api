<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultadoRequest;
use App\Models\Prova;
use App\Models\Resultado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResultadoController extends Controller
{
    public function store(ResultadoRequest $request)
    {
        return $request->store();
    }

    public function geral()
    {
        $json = [];

        foreach (Prova::TIPOS as $tipo) {
            $json[$tipo] = Resultado::whereHas('corredorProva', function ($query) use ($tipo) {
                return $query->whereHas('prova', function ($query) use ($tipo) {
                    return $query->where('tipo', $tipo);
                });
            })->orderBy(DB::raw('hora_fim - hora_ini'))->get()->toArray();

            foreach ($json[$tipo] as $key => &$row) {
                $row['posicao'] = $key + 1;
            }
        }

        return response()->json($json);
    }

    public function porIdade()
    {
    }
}
