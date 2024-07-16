<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Becario;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Becario>
 */
class BecarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo' => strtoupper(Str::random(10)), // Generar un código único de 12 caracteres al azar
            'dni' => $this->generateUniqueDni(), // Generar un DNI único de 8 números
            'nombre_apellido' => $this->faker->name,
            'direccion' => $this->faker->address,
            'telefono' => $this->faker->numerify('9########'), // Número de teléfono con 9 dígitos
            'fecha_nacimiento' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'email' => $this->faker->unique()->safeEmail(),
            'estado' => '1',
            'fotografia' => '',
            'fecha_ingreso' => $this->faker->date($format = 'Y-m-d'),
        ];
    }

    /**
     * Generate a unique DNI.
     *
     * @return string
     */
    private function generateUniqueDni(): string
    {
        do {
            $dni = $this->faker->unique()->numerify('########'); // Generar un DNI único de 8 números
        } while (Becario::where('dni', $dni)->exists());

        return $dni;
    }
}
