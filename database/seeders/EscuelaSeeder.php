<?php

namespace Database\Seeders;

use App\Models\Escuela;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Escuela::create([
            'nombre_escuela' => 'EPISS',
            'descripcion' => 'Ingeniería de Software y Sistemas',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPIER',
            'descripcion' => 'Ingeniería de Energías Renovables',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPIAF',
            'descripcion' => 'Ingeniería Ambiental y Forestal',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPIA',
            'descripcion' => 'Ingeniería en Industrias Alimentarias',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPITC',
            'descripcion' => 'Ingeniería Textil y de Confecciones',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPIM',
            'descripcion' => 'Ingeniería Mecatrónica',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPII',
            'descripcion' => 'Ingeniería Industrial',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'GPDS',
            'descripcion' => 'Gestión Pública y Desarrollo Social',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPE',
            'descripcion' => 'Economía',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        Escuela::create([
            'nombre_escuela' => 'EPAEE',
            'descripcion' => 'Administración y Emprendimiento Empresarial',
            'estado' => 1,
            'fecha_ingreso' => now(),
            
        ]);
        
    }
}