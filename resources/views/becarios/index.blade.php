@extends('layouts.admin')

@section('content')
    <div class="content" style="margin-left: 20px">

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
                        <h2 class="card-title"><b>Becarios Registrados</b></h2>
                        <div class="card-tools">
                            <a href="{{ url('/becarios/create') }}" class="btn btn-primary">
                                <i class="bi bi-person-fill-add mr-2"></i>Agregar nuevo becario
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Código</th>
                                    <th>DNI</th>
                                    <th>Nombres y Apellidos</th>
                                    <th>E.P.</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Estado</th>
                                    <th>Agregado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($becarios as $becario)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $becario->codigo }}</td>
                                        <td>{{ $becario->dni }}</td>
                                        <td>{{ $becario->nombre_apellido }}</td>
                                        <td>{{ $becario->escuela->nombre_escuela }}</td>
                                        <td>{{ $becario->telefono }}</td>
                                        <td>{{ $becario->email }}</td>
                                        <td>
                                            <center><button class="btn btn-success btn-sm"
                                                    style="border-radius: 20px">Activo</button></center>
                                        </td>
                                        <td>{{ $becario->fecha_ingreso }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('becarios', $becario->id) }}" type="button"
                                                    class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ route('becarios.edit', $becario->id) }}" type="button"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <form action="{{ url('becarios', $becario->id) }}" method="POST">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit"
                                                        onclick="return confirm('¿Seguro que desea borrar este registro?')"
                                                        class="btn btn-danger">
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
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 20,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Becarios",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Becarios",
                                    "infoFiltered": "(Filtrado de _MAX_ total Becarios)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Becarios",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscador:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                },
                                "responsive": true, "lengthChange": true, "autoWidth": false,
                                buttons: [{
                                    extend: 'collection',
                                    text: 'Reportes',
                                    orientation: 'landscape',
                                    buttons: [{
                                        text: 'Copiar',
                                        extend: 'copy',
                                    }, {
                                        extend: 'pdf'
                                    },{
                                        extend: 'csv'
                                    },{
                                        extend: 'excel'
                                    },{
                                        text: 'Imprimir',
                                        extend: 'print'
                                    }
                                    ]
                                },
                                    {
                                        extend: 'colvis',
                                        text: 'Visor de columnas',
                                        collectionLayout: 'fixed three-column'
                                    }
                                ],
                            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                        });
                    </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
