@extends('layouts.admin')

@section('content')
    <div class="content">

        <div class="card card-outline card-warning " style="text-align: center">
            <div class="card-header">
                <h2 class="card-title">
                    <h1>Actualización del Ministerio: {{ $ministerio->nombre_ministerio }}</h1>
                </h2>

            </div>
        </div>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
        @endforeach

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-warning">
                    <div class="card-header">
                        <h2 class="card-title"><b>Actualizar Ministerio</b></h2>

                    </div>
                    <div class="card-body" style="display: block;">

                        <form action="{{ url('/ministerios', $ministerio->id) }}" method="post">
                            @csrf
                            {{ method_field('PATCH') }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">Nombres del ministerio</label><b>*</b>
                                                <input type="text" name="nombre_ministerio"
                                                    value="{{ $ministerio->nombre_ministerio }}" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso</label><b>*</b>
                                                <input type="date" name="fecha_ingreso"
                                                    value="{{ $ministerio->fecha_ingreso }}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Descripción</label><b>*</b>
                                                <textarea class="form-control" name="descripcion" id="" cols="30" rows="10">{!! $ministerio->descripcion !!} </textarea>
                                                <script>
                                                    CKEDITOR.replace('descripcion')
                                                </script>
                                            </div>
                                        </div>
                                    </div>




                                    {{-- linea --}}
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <a href="{{ url('/ministerios') }}" class="btn btn-danger">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">Actualizar Miembro</button>
                                            </div>
                                        </div>
                                    </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
