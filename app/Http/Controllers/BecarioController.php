<?php

namespace App\Http\Controllers;

use App\Models\Becario;
use App\Models\Escuela; // Importar el modelo Escuela
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BecarioController extends Controller
{
    public function index()
    {
        $becarios = Becario::all()->sortByDesc("id");

        return view('becarios.index', ['becarios' => $becarios]);
    }

    public function create()
    {
        $escuelas = Escuela::all(); // Obtener todas las escuelas
        return view('becarios.create', compact('escuelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:becarios,codigo|max:10',
            'dni' => 'required|unique:becarios,dni|max:8',
            'nombre_apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required|unique:becarios,email',
            'escuela_id' => 'required|exists:escuelas,id' // Validar que la escuela exista
        ]);

        $becario = new Becario();
        $becario->codigo = $request->codigo;
        $becario->dni = $request->dni;
        $becario->nombre_apellido = $request->nombre_apellido;
        $becario->direccion = $request->direccion;
        $becario->telefono = $request->telefono;
        $becario->fecha_nacimiento = $request->fecha_nacimiento;
        $becario->email = $request->email;
        $becario->estado = '1';
        $becario->escuela_id = $request->escuela_id; // Asignar escuela_id

        if ($request->hasFile('fotografia')) {
            $becario->fotografia = $request->file('fotografia')->store('fotografias_becarios', 'public');
        }

        $becario->fecha_ingreso = date('Y-m-d');
        $becario->save();

        return redirect()->route('becarios.index')->with('mensaje', 'Becario creado exitosamente');
    }

    public function show($id)
    {
        $becario = Becario::findOrFail($id);
        return view('becarios.show', ['becario' => $becario]);
    }

    public function edit($id)
    {
        $becario = Becario::findOrFail($id);
        $escuelas = Escuela::all(); // Obtener todas las escuelas
        return view('becarios.edit', ['becario' => $becario, 'escuelas' => $escuelas]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigo' => 'required|unique:becarios,codigo,'.$id.'|max:10',
            'dni' => 'required|unique:becarios,dni,'.$id.'|max:8',
            'nombre_apellido' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fecha_nacimiento' => 'required',
            'email' => 'required|unique:becarios,email,'.$id,
            'escuela_id' => 'required|exists:escuelas,id' // Validar que la escuela exista
        ]);

        $becario = Becario::find($id);
        $becario->codigo = $request->codigo;
        $becario->dni = $request->dni;
        $becario->nombre_apellido = $request->nombre_apellido;
        $becario->direccion = $request->direccion;
        $becario->telefono = $request->telefono;
        $becario->fecha_nacimiento = $request->fecha_nacimiento;
        $becario->email = $request->email;
        $becario->estado = '1';
        $becario->escuela_id = $request->escuela_id; // Asignar escuela_id

        if ($request->hasFile('fotografia')) {
            Storage::delete('public/' . $becario->fotografia);
            $becario->fotografia = $request->file('fotografia')->store('fotografias_becarios', 'public');
        }

        $becario->save();
        return redirect()->route('becarios.index')->with('mensaje', 'Becario actualizado exitosamente');
    }

    public function destroy($id)
    {
        $becario = Becario::find($id);
        Storage::delete('public/' . $becario->fotografia);
        $becario->delete();
        return redirect()->route('becarios.index')->with('mensaje', 'Becario eliminado exitosamente');
    }
}
