@extends('layouts.admin')

@section('content')
    <div class="content">

        <h1>Editar becario</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">

                    </div>
                    <div class="card-body" style="display: block;">

                        <form action="{{ route('becarios.update', $becario->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Código</label>
                                                <input type="text" name="codigo" value="{{ $becario->codigo }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">DNI</label>
                                                <input type="text" name="dni" value="{{ $becario->dni }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombres y Apellidos</label>
                                                <input type="text" name="nombre_apellido"
                                                    value="{{ $becario->nombre_apellido }}" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input type="email" name="email" value="{{ $becario->email }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Teléfono</label>
                                                <input type="number" name="telefono" value="{{ $becario->telefono }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha de nacimiento</label>
                                                <input type="date" name="fecha_nacimiento"
                                                    value="{{ $becario->fecha_nacimiento }}" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <input type="text" name="direccion" value="{{ $becario->direccion }}"
                                                    class="form-control" required>
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
                                                    <img src="{{ url('images/avatar-hombre.jpg') }}"
                                                        width="200px">
                                                @else
                                                    <img src="{{ url('images/avatar-mujer.jpg') }}"
                                                        width="200px">
                                                @endif
                                            @else
                                                <center><img src="{{ asset('storage') . '/' . $becario->fotografia }}"
                                                        width="150px">
                                                </center>
                                            @endif
                                            <input type="file" name="fotografia" class="form-control"><br>
                                        </div>
                                    </center>
                                </div>
                            </div>
                            {{-- linea --}}
                            <hr>
                            <div class="row">
                                <div class="col-md-3 ml-4">
                                    <div class="form-group">
                                        <a href="{{ route('becarios.index') }}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Actualizar Becario</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
