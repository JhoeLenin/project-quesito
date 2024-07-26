
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Reporte de Asistencias de {{ $becario->nombre }}</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
            <tr>
                <td>{{ $asistencia->fecha }}</td>
                <td>{{ $asistencia->estado }}</td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
