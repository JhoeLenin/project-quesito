<?php

namespace App\Http\Controllers;

use App\Models\Becario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BecarioController extends Controller
{
    public function index()
    {
        $becarios = Becario::all()->sortByDesc("id");

        return view('becarios.index', ['becarios' => $becarios]);
    }

    public function create()
    {
        return view('becarios.create');
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

        if ($request->hasFile('fotografia')) {
            $becario->fotografia = $request->file('fotografia')->store('fotografias_becarios', 'public');
        }

        $becario->fecha_ingreso = date('Y-m-d');
        $becario->save();

        return redirect()->route('becarios.index')->with('mensaje', 'Se registró de manera correcta');
    }

    public function show($id)
    {
        $becario = Becario::findOrFail($id);
        return view('becarios.show', ['becario' => $becario]);
    }

    public function edit($id)
    {
        $becario = Becario::findOrFail($id);
        return view('becarios.edit', ['becario' => $becario]);
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

        if ($request->hasFile('fotografia')) {
            Storage::delete('public/' . $becario->fotografia);
            $becario->fotografia = $request->file('fotografia')->store('fotografias_becarios', 'public');
        }

        $becario->save();
        return redirect()->route('becarios.index')->with('mensaje', 'Becario actualizado con éxito');
    }

    public function destroy($id)
    {
        $becario = Becario::find($id);
        Storage::delete('public/' . $becario->fotografia);
        $becario->delete();
        return redirect()->route('becarios.index')->with('mensaje', 'Becario eliminado con éxito');
    }
}
