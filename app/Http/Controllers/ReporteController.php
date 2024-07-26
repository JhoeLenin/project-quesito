<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia; // Asumiendo que tienes un modelo Asistencia
use App\Models\Becario; // Asumiendo que tienes un modelo Becario

class ReporteController extends Controller
{
    public function todasAsistencias()
    {
        $asistencias = Asistencia::with('becario')->get();
        return view('reportes.asistencias', compact('asistencias'));
    }

    public function asistenciasBecario($id)
    {
        $becario = Becario::findOrFail($id);
        $asistencias = Asistencia::where('becario_id', $id)->get();
        return view('reportes.asistencias_becario', compact('becario', 'asistencias'));
    }
}
