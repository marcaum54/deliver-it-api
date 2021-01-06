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

            foreach ($json[$tipo] as $key => &$row)
                $row['posicao'] = $key + 1;
        }

        return response()->json($json);
    }

    public function porIdade()
    {
        $idades = [];

        $ranges = [
            '18 – 25 anos' => [18, 25],
            '25 – 35 anos' => [25, 35],
            '35 – 45 anos' => [35, 45],
            '45 – 55 anos' => [45, 55],
            'Acima de 55 anos' => [55],
        ];

        foreach ($ranges as $key => $range) {
            if (count($range) == 2) {
                foreach (range($range[0], $range[1]) as $idade) {
                    $idades[$idade] = $key;
                }
            } else {
                $idades[$range[0]] = $key;
            }
        }

        $json = [];

        foreach (array_keys($ranges) as $range_idade) {
            $json[$range_idade] = [];
        }

        foreach (Prova::TIPOS as $tipo) {
            $rows = Resultado::whereHas('corredorProva', function ($query) use ($tipo) {
                return $query->whereHas('prova', function ($query) use ($tipo) {
                    return $query->where('tipo', $tipo);
                });
            })->orderBy(DB::raw('hora_fim - hora_ini'))->get()->toArray();

            foreach ($rows as &$row) {
                $idade = isset($idades[$row['idade']]) ? $idades[$row['idade']] : end($idades);
                $json[$idade][$tipo][] = $row;
            }
        }

        return response()->json($json);
    }
}
