<?php

namespace Database\Seeders;

use App\Models\Prova;
use App\Models\Resultado;
use Illuminate\Database\Seeder;

class ResultadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Prova::all() as $prova) {
            $hora_fim = '00:00:00';
            $prova->corredores()->orderBy('corredores.id', 'DESC')->each(function ($corredor) use (&$hora_fim) {
                $hora_fim = date('H:i:s', strtotime('+10 minutes', strtotime($hora_fim)));

                $resultado = new Resultado;
                $resultado->corredor_prova_id = $corredor->pivot->id;
                $resultado->hora_ini = '00:00:00';
                $resultado->hora_fim = $hora_fim;
                $resultado->save();
            });
        }
    }
}
