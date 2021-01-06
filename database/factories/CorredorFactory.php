<?php

namespace Database\Factories;

use App\Models\Corredor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CorredorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Corredor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cpf = '';
        foreach (range(1, 11) as $i) {
            $cpf .= rand(0, 9);
        }

        return [
            'cpf' => $cpf,
            'nome' => $this->faker->name,
        ];
    }
}
