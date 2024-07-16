@extends('layouts.admin')

@section('content')
    <div class="content">

        <h1>Ver becario</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">

                    </div>
                    <div class="card-body" style="display: block;">


                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Código</label>
                                            <input type="text" name="codigo" value="{{ $becario->codigo }}"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">DNI</label>
                                            <input type="text" name="dni" class="form-control"
                                                value="{{ $becario->dni }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Nombres y Apellidos</label>
                                            <input type="text" name="nombre_apellido"
                                                value="{{ $becario->nombre_apellido }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $becario->email }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Teléfono</label>
                                            <input type="number" name="telefono" class="form-control"
                                                value="{{ $becario->telefono }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" class="form-control"
                                                value="{{ $becario->fecha_nacimiento }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">



                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" name="direccion" value="{{ $becario->direccion }}"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <center>
                                    <div class="form-group">
                                        <label for="">Fotografía</label>
                                        <br>
                                        @if ($becario->fotografia == '')
                                            @if ($becario->genero == 'masculino')
                                                <img src="{{ url('images/avatar-hombre.jpg') . '/' . $becario->fotografia }}"
                                                    width="200px">
                                            @else
                                                <img src="{{ url('images/avatar-mujer.jpg') . '/' . $becario->fotografia }}"
                                                    width="200px">
                                            @endif
                                        @else
                                            <center><img src="{{ asset('storage') . '/' . $becario->fotografia }}"
                                                    width="150px">
                                            </center>
                                        @endif
                                </center>


                            </div>
                        </div>
                    </div>
                    {{-- linea --}}
                    <hr>
                    <div class="row">
                        <div class="col-md-3 ml-4">
                            <div class="form-group">
                                <a href="{{ url('/becarios/') }}" class="btn btn-danger">Volver</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
