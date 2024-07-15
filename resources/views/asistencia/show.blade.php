@extends('layouts.admin')

@section('template_title')
    {{ $asistencia->name ?? "{{ __('Show') Asistencia" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Detalle de la asistencia') }} Asistencia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('asistencias.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $asistencia->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Miembro Id:</strong>
                            {{ $asistencia->miembro->nombre_apellido }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
