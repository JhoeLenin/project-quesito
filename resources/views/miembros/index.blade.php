@extends('layouts.admin')



@section('content')
    <div class="content" style="margin-left: 20px">

        <h1 class="mb-3">Listado de miembros</h1>

        @if ($message = Session::get('mensaje'))
            <script>
                Swal.fire({
                    title: "Buen trabajo",
                    text: "{{ $message }}",
                    icon: 'success',
                });
            </script>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h2 class="card-title"><b>Miembros Registrados</b></h2>
                        <div class="card-tools">
                            <a href="{{ url('/miembros/create') }}" class="btn btn-primary">
                                <i class="bi bi-person-fill-add mr-2"></i>Agregar nuevo miembro
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Agregado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($miembros as $miembro)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $miembro->nombre_apellido }}</td>
                                        <td>{{ $miembro->telefono }}</td>
                                        <td>{{ $miembro->email }}</td>
                                        <td>
                                            <center> <button class="btn btn-success btn-sm" style="border-radius: 20px">Activo</button></center>
                                        </td>
                                        <td>{{ $miembro->fecha_ingreso }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('miembros', $miembro->id) }}" type="button"
                                                    class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ route('miembros.edit', $miembro->id) }}" type="button"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <form action="{{ url('miembros', $miembro->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick="return confirm('¿Seguro que desea borrar este registro?')" class="btn btn-danger">
                                                        <i class="bi bi-trash3-fill"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                        <script>
                            $(function() {
                                $("#example1").DataTable({
                                    "responsive": true,
                                    "lengthChange": true,
                                    "autoWidth": false,
                                    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

                            });
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
