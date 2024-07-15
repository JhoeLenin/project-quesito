@extends('layouts.admin')

@section('content')
    <div class="content">

        <h1>Ver miembro</h1>

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
                                            <label for="">Nombres y Apellidos</label>
                                            <input type="text" name="nombre_apellido"
                                                value="{{ $miembro->nombre_apellido }}" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ $miembro->email }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Teléfono</label>
                                            <input type="number" name="telefono" class="form-control"
                                                value="{{ $miembro->telefono }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Fecha de nacimiento</label>
                                            <input type="date" name="fecha_nacimiento" class="form-control"
                                                value="{{ $miembro->fecha_nacimiento }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Género</label>
                                            <select name="genero" class="form-control" disabled>
                                                @if ($miembro->genero == 'masculino')
                                                    <option value="masculino">Masculino</option>
                                                    <option value="femenino">Femenino</option>
                                                @else
                                                    <option value="femenino">Femenino</option>
                                                    <option value="masculino">Masculino</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="">Ministerio</label>
                                            <input type="text" name="ministerio" value="{{ $miembro->ministerio }}"
                                                class="form-control" disabled>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Dirección</label>
                                            <input type="text" name="direccion" value="{{ $miembro->direccion }}"
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
                                        @if ($miembro->fotografia == '')
                                            @if ($miembro->genero == 'masculino')
                                                <img src="{{ url('images/avatar-hombre.jpg') . '/' . $miembro->fotografia }}"
                                                    width="200px">
                                            @else
                                                <img src="{{ url('images/avatar-mujer.jpg') . '/' . $miembro->fotografia }}"
                                                    width="200px">
                                            @endif
                                        @else
                                            <center><img src="{{ asset('storage') . '/' . $miembro->fotografia }}"
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
                                <a href="{{ url('/miembros/') }}" class="btn btn-danger">Volver</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
