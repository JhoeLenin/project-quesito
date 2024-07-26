<?php

namespace App\Http\Controllers;

use App\Models\Becario;
use App\Models\User;
use App\Models\Asistencia;

use App\Models\Escuela;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $escuelas = Escuela::all();
        $becarios = Becario::all();
        $usuarios = User::all();
        $asistencias = Asistencia::all();
        return view('index', ['escuelas' => $escuelas,'becarios' => $becarios,'usuarios' => $usuarios,'asistencias' => $asistencias]);
    }
}
