<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Asistencia;
use App\Models\Becario;
use Carbon\Carbon;

class GenerarAsistencias extends Command
{
    protected $signature = 'asistencias:generar';
    protected $description = 'Generar asistencias diarias para todos los becarios';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $becarios = Becario::all();
        $fecha = Carbon::now()->toDateString();

        foreach ($becarios as $becario) {
            Asistencia::updateOrCreate(
                ['becario_id' => $becario->id, 'fecha' => $fecha],
                ['estado' => 0]
            );
        }

        $this->info('Asistencias generadas con éxito.');
    }
}
