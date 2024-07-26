@extends('layouts.admin')

@section('content')
    <div class="content">

        <div class="card card-outline card-primary " style="text-align: center">
            <div class="card-header">
                <h2 class="card-title">
                    <h1>Escuela: {{ $escuela->nombre_escuela }}</h1>
                </h2>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h2 class="card-title"><b>Datos de la Escuela</b></h2>

                    </div>
                    <div class="card-body" style="display: block;">


                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="">Nombre de la escuela</label>
                                            <input type="text" name="nombre_escuela"
                                                value="{{ $escuela->nombre_escuela }}" class="form-control" required
                                                disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Fecha de ingreso</label>
                                            <input type="date" name="fecha_ingreso" value="{{ $escuela->fecha_ingreso }}"
                                                class="form-control" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Descripción</label>
                                            <p>{!! $escuela->descripcion !!}</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- linea --}}
                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <a href="{{ url('/escuelas') }}" class="btn btn-danger">Volver</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
