<?php

namespace Database\Seeders;

use App\Models\Corredor;
use App\Models\Prova;
use Illuminate\Database\Seeder;

class CorredorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ano = date('Y');

        foreach (Prova::all() as $prova) {
            foreach ([20, 27, 37, 47, 57] as $idade) {
                $y = $ano - $idade;
                $corredores = Corredor::factory()
                    ->times(10)
                    ->create(['data_nascimento' => date("{$y}-m-d")]);

                foreach ($corredores as $corredor) {
                    $corredor->provas()->attach([$prova->id]);
                }
            }
        }
    }
}
