<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Negocios>
 */
class NegociosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 2, 4, 5, 6, 7
        $array = [2, 4, 5, 6, 7];
        $usuario_id = fake()->randomElement($array);
        return [
            'usuario_id' => $usuario_id,
            'nombre' => fake()->company(),
            'imagen' => 'default.png',
            'descripcion' => fake()->sentence(),
            'estado' => true
        ];
    }
}
