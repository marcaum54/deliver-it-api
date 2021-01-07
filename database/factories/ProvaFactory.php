<?php

namespace Database\Factories;

use App\Models\Prova;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prova::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tipo' => $this->model::TIPOS[rand(0, count($this->model::TIPOS) - 1)],
            'data' => date('Y-m-d', strtotime('-' . mt_rand(5, 9999) . ' days')),
        ];
    }
}
