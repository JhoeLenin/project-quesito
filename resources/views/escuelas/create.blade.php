@extends('layouts.admin')

@section('content')
    <div class="content">

        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <li>{{ $error }}</li>
            </div>
        @endforeach

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h2 class="card-title"><b>Registrar Escuela</b></h2>

                    </div>
                    <div class="card-body" style="display: block;">

                        <form action="{{ url('/escuelas') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="">Nombre de la escuela</label><b>*</b>
                                                <input type="text" name="nombre_escuela"
                                                    value="{{ old('nombre_escuela') }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Fecha de ingreso</label><b>*</b>
                                                <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Descripción</label><b>*</b>
                                                <textarea class="form-control" name="descripcion" id="" cols="30" rows="10"></textarea>
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
                                                <a href="" class="btn btn-danger">Cancelar</a>
                                                <button type="submit" class="btn btn-primary">Guardar Escuela</button>
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
