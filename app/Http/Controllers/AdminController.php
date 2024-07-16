<?php

namespace App\Http\Controllers;

use App\Models\Becario;
use App\Models\User;
use App\Models\Asistencia;

use App\Models\Ministerio;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $ministerios = Ministerio::all();
        $becarios = Becario::all();
        $usuarios = User::all();
        $asistencias = Asistencia::all();
        return view('index', ['ministerios' => $ministerios,'becarios' => $becarios,'usuarios' => $usuarios,'asistencias' => $asistencias]);
    }
}
