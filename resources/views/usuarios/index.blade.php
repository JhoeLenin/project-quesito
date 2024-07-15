@extends('layouts.admin')



@section('content')
    <div class="content" style="margin-left: 20px">

        <h1 class="mb-3">Listado de Usuarios</h1>

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
                        <h2 class="card-title"><b>Usuarios Registrados</b></h2>
                        <div class="card-tools">
                            <a href="{{ url('/usuarios/create') }}" class="btn btn-primary">
                                <i class="bi bi-person-fill-add mr-2"></i>Agregar nuevo Usuario
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres del usuario</th>
                                    <th>Correo</th>
                                    <th>Fecha de ingreso</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->fecha_ingreso }}</td>
                                        <td>
                                            <center> <button class="btn btn-success btn-sm"
                                                    style="border-radius: 20px">Activo</button></center>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('usuarios', $usuario->id) }}" type="button"
                                                    class="btn btn-info"><i class="bi bi-eye-fill"></i></a>

                                                <a href="{{ route('usuarios.edit', $usuario->id) }}" type="button"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                                <form action="{{ url('usuarios', $usuario->id) }}" method="POST">
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
                            // $(function() {
                            //     $("#example1").DataTable({
                            //         "pageLength": 10,
                            //         "language": {
                            //             "emptyTable": "No hay informacion",
                            //             "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                            //             "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                            //             "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                            //             "infoPostFix": "",
                            //             "thousands": ",",
                            //             "lengthMenu": "Mostrar _MENU_ Usuarios",
                            //             "loadingRecords": "Cargando...",
                            //             "processing": "procesando...",
                            //             "search": "Buscador:",
                            //             "zeroRecords": "Sin resultados encontrados",
                            //             "paginate": {
                            //                 "first": "Primero",
                            //                 "last": "Ultimo",
                            //                 "next": "siguiente",
                            //                 "previous": "Anterior"
                            //             }
                            //         },
                            //         "responsive": true,
                            //         "lengthChange": true,
                            //         "autoWidth": false,
                            //         buttons: [{
                            //                 extend: 'collection',
                            //                 text: 'Reportes',
                            //                 orientation: 'landscape'
                            //                 buttons: [{
                            //                         text: 'copiar',
                            //                         extend: 'copy'
                            //                     },
                            //                     {
                            //                         extend: 'pdf'
                            //                     }, {
                            //                         extend: 'csv'

                            //                     }. {
                            //                         extend: 'excel'

                            //                     }, {
                            //                         text: 'Imprimir',
                            //                         extend: 'print'
                            //                     }
                            //                 ]
                            //             },
                            //             {
                            //                 extend: 'colvis',
                            //                 text: 'visor de columnas',
                            //                 collectionLayout: 'fixed three-column'
                            //             }
                            //         ],
                            //     }) buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                            // });
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
