<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Productos>
 */
class ProductosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $precio = number_format((fake()->randomFloat(2, 1, 100)), 2);
        return [
            'nombre' => fake()->colorName(),
            'descripcion' => fake()->sentence(),
            'costo' => $precio,
            'imagen' => 'default.png',
            'negocio_id' => fake()->numberBetween(1, 3),
        ];
    }
}
