<?php

namespace App\Http\Controllers;

use App\Models\Escuela;
use Illuminate\Http\Request;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $escuelas = Escuela::all();
        return view('escuelas.index', ['escuelas' => $escuelas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('escuelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'nombre_escuela' => 'required',
            'fecha_ingreso' => 'required',


        ]);

        $escuela = new Escuela();
        $escuela->nombre_escuela = $request->nombre_escuela;
        $escuela->descripcion = $request->descripcion;
        $escuela->estado = '1';
        $escuela->fecha_ingreso = $request->fecha_ingreso;
        $escuela->save();

        return redirect()->route('escuelas.index')->with('mensaje', 'Escuela creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $escuela = Escuela::findOrFail($id);
        return view('escuelas.show', ['escuela' => $escuela]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $escuela = Escuela::findOrFail($id);
        return view('escuelas.edit', ['escuela' => $escuela]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([

            'nombre_escuela' => 'required',
            'fecha_ingreso' => 'required',
        ]);

        $escuela=Escuela::find($id);

        $escuela->nombre_escuela = $request->nombre_escuela;
        $escuela->descripcion = $request->descripcion;
        $escuela->fecha_ingreso = $request->fecha_ingreso;
        $escuela->save();

        return redirect()->route('escuelas.index')->with('mensaje', 'Escuela actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    Escuela::destroy($id);
    return redirect()->route('escuelas.index')->with('mensaje', 'Escuela eliminada exitosamente');
    }
}
