
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Reportes de Asistencias</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Becario</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
            <tr>
                <td>{{ $asistencia->becario->nombre_apellido }}</td>
                <td>{{ $asistencia->fecha }}</td>
                <td>{{ $asistencia->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
