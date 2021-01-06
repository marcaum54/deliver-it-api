<?php

namespace Database\Seeders;

use App\Models\Prova;
use Illuminate\Database\Seeder;

class ProvaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = date('Y-m-d');
        foreach (Prova::TIPOS as $tipo) {
            Prova::create(compact('tipo', 'data'));
        }
    }
}
