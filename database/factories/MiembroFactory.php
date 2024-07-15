<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Miembro>
 */
class MiembroFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'nombre_apellido' => fake()->name,
            'direccion' => fake()->address,
            'telefono' => random_int(900000000, 999999999),
            'fecha_nacimiento' => fake()->date($format = 'Y-m-d', $max = 'now'),
            'genero' => 'masculino',
            'email' => fake()->unique()->safeEmail(),
            'estado' => '1',
            'ministerio' => 'postoral',
            'fotografia' => '',
            'fecha_ingreso' => fake()->date($format = 'Y-m-d'),

        ];
    }
}
