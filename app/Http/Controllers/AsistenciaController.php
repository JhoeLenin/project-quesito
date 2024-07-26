<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Asistencia;
use App\Models\Becario;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Class AsistenciaController
 * @package App\Http\Controllers
 */
class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencias = Asistencia::paginate();

        return view('asistencia.index', compact('asistencias'))
            ->with('i', (request()->input('page', 1) - 1) * $asistencias->perPage());
    }


    public function reportes()
    {
        return view('asistencia.reportes');
    }
    public function pdf()
    {
        $asistencias = Asistencia::paginate();

        $pdf = Pdf::loadView('asistencia.pdf', ['asistencias' => $asistencias]);
        return $pdf->stream();
    }
    public function pdf_fechas(Request $request)
    {
        $fi = $request->fi;
        $ff = $request->ff;

        $asistencias = Asistencia::where('fecha','>=',$fi)->where('fecha','<=',$ff)->get();

        $pdf = Pdf::loadView('asistencia.pdf_fechas', ['asistencias' => $asistencias, 'fi' => $fi, 'ff' => $ff]);
        return $pdf->stream();
    }
    public function create()
    {
        $asistencia = new Asistencia();
        $becarios = Becario::pluck('nombre_apellido', 'id');
        return view('asistencia.create', compact('asistencia', 'becarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validar los datos de entrada
    request()->validate(Asistencia::$rules);

    // Añadir el valor de estado antes de crear la asistencia
    $data = $request->all();
    $data['estado'] = 1; // Establecer el estado en 1

    // Crear la asistencia con los datos modificados
    $asistencia = Asistencia::create($data);

    // Redirigir con un mensaje de éxito
    return redirect()->route('asistencias.index')
        ->with('success', 'Asistencia creada exitosamente');
}
    public function registrarAsistencia(Request $request)
{
    $becario_id = $request->input('becario_id');
    $fecha = Carbon::now()->toDateString();

    $asistencia = Asistencia::where('becario_id', $becario_id)
                            ->where('fecha', $fecha)
                            ->first();

    if ($asistencia) {
        $asistencia->estado = 1;
        $asistencia->save();
        dd('Asistencia actualizada:', $asistencia->toArray()); // Verifica el estado antes de guardar
    } else {
        $asistencia = Asistencia::create([
            'becario_id' => $becario_id,
            'fecha' => $fecha,
            'estado' => 1,
        ]);
        dd('Asistencia creada:', $asistencia->toArray()); // Verifica el estado después de crear
    }

    return response()->json(['message' => 'Asistencia registrada con éxito.']);
}


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asistencia = Asistencia::find($id);

        return view('asistencia.show', compact('asistencia'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asistencia = Asistencia::find($id);
        $becarios = Becario::pluck('nombre_apellido', 'id');
        return view('asistencia.edit', compact('asistencia', 'becarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Asistencia $asistencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        request()->validate(Asistencia::$rules);

        $asistencia->update($request->all());

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia actualizada exitosamente');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $asistencia = Asistencia::find($id)->delete();

        return redirect()->route('asistencias.index')
            ->with('success', 'Asistencia eliminada exitosanente');
    }
}
