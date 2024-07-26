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
                        <h2 class="card-title"><b>Registrar Becarios</b></h2>
                    </div>
                    <div class="card-body" style="display: block;">
                        <form action="{{ url('/becarios') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Código</label><b>*</b>
                                                <input type="text" name="codigo" value="{{ old('codigo') }}" class="form-control" maxlength="12" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">DNI</label><b>*</b>
                                                <input type="text" name="dni" value="{{ old('dni') }}" class="form-control" maxlength="8" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombres y Apellidos</label><b>*</b>
                                                <input type="text" name="nombre_apellido" value="{{ old('nombre_apellido') }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Email</label><b>*</b>
                                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="escuela_id">Escuela:</label>
                                            <select class="form-control" id="escuela_id" name="escuela_id" required>
                                                    <option value="" disabled selected>Buscar EP</option>
                                                    @foreach($escuelas as $escuela)
                                                        <option value="{{ $escuela->id }}">{{ $escuela->nombre_escuela }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Teléfono</label><b>*</b>
                                                <input type="number" name="telefono" value="{{ old('telefono') }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Fecha de nacimiento</label><b>*</b>
                                                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Dirección</label><b>*</b>
                                                <input type="text" name="direccion" value="{{ old('direccion') }}" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Fotografía</label>
                                        <input type="file" id="file" name="fotografia" class="form-control"><br>
                                        <center><output id="list"></output></center>
                                        <script>
                                            function archivo(evt) {
                                                var files = evt.target.files; // FileList object

                                                // Obtenemos la imagen del campo "file".
                                                for (var i = 0, f; f = files[i]; i++) {
                                                    // Solo admitimos imágenes.
                                                    if (!f.type.match('image.*')) {
                                                        continue;
                                                    }
                                                    var reader = new FileReader();

                                                    reader.onload = (function(theFile) {
                                                        return function(e) {
                                                            // Creamos la imagen.
                                                            document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result, '" width="60%" title="', escape(theFile.name), '"/>'].join('');
                                                        };
                                                    })(f);
                                                    reader.readAsDataURL(f);
                                                }
                                            }

                                            document.getElementById('file').addEventListener('change', archivo, false);
                                        </script>
                                    </div>
                                </div>
                            </div>
                            {{-- línea --}}
                            <hr>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar Becario</button>
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
