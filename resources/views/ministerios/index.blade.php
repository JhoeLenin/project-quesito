@extends('layouts.admin')



@section('content')
    <div class="content" style="margin-left: 20px">

        <h1 class="mb-3">Listado de Ministerios</h1>

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
                        <h2 class="card-title"><b>Ministerios Registrados</b></h2>
                        <div class="card-tools">
                            <a href="{{ url('/ministerios/create') }}" class="btn btn-primary">
                                <i class="bi bi-person-fill-add mr-2"></i>Agregar nuevo Ministerio
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres del Ministerio</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($ministerios as $ministerio)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $ministerio->nombre_ministerio }}</td>
                                        <td>{!!$ministerio->descripcion!!}</td>
                                        <td>
                                            <center> <button class="btn btn-success btn-sm"
                                                    style="border-radius: 20px">Activo</button></center>
                                        </td>
                                        <td>{{ $ministerio->fecha_ingreso }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('ministerios', $ministerio->id) }}" type="button"
                                                    class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ route('ministerios.edit', $ministerio->id) }}" type="button"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <form action="{{ url('ministerios', $ministerio->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" onclick="return confirm('¿Está seguro que desea borrar este registro?')" class="btn btn-danger">
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
