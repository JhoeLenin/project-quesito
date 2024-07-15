@extends('layouts.admin')

@section('content')
    <div class="content">

        <h1>Datos del usuario</h1>


        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h2 class="card-title"><b>Observe el Usuario</b></h2>

                    </div>
                    <div class="card-body">
                        <div class="card">

                            <div class="card-body">


                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Nombres y apellidos de
                                        usuario</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control"
                                            value="{{ $usuario->name }}" disabled>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row
                                            mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo
                                        Electrónico</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ $usuario->email }}" disabled autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Fecha de
                                        Ingreso</label>

                                    <div class="col-md-6">
                                        <input id="password" type="text"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            disabled autocomplete="new-password" value="{{ $usuario->fecha_ingreso }}">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>



                                <div class="row mb-0 mt-4">
                                    <a href="{{ url('/usuarios') }}" class="btn btn-danger">
                                        Volver
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
