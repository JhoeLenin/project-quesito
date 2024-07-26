@extends('layouts.admin')



@section('content')
    <div class="content" style="margin-left: 20px">

        <h1 class="mb-3">Lista de Escuelas</h1>

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
                        <h2 class="card-title"><b>Escuelas Registradas</b></h2>
                        <div class="card-tools">
                            <a href="{{ url('/escuelas/create') }}" class="btn btn-primary">
                                <i class="bi bi-person-fill-add mr-2"></i>Agregar nueva Escuela
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="display: block;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>Nombres de la escuela</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $contador = 0; ?>
                                @foreach ($escuelas as $escuela)
                                    <tr>
                                        <td><?php echo $contador = $contador + 1; ?></td>
                                        <td>{{ $escuela->nombre_escuela }}</td>
                                        <td>{!!$escuela->descripcion!!}</td>
                                        <td>
                                            <center> <button class="btn btn-success btn-sm"
                                                    style="border-radius: 20px">Activo</button></center>
                                        </td>
                                        <td>{{ $escuela->fecha_ingreso }}</td>
                                        <td style="text-align: center">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="{{ url('escuelas', $escuela->id) }}" type="button"
                                                    class="btn btn-info"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ route('escuelas.edit', $escuela->id) }}" type="button"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <form action="{{ url('escuelas', $escuela->id) }}" method="POST">
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
                        $(function () {
                            $("#example1").DataTable({
                                "pageLength": 10,
                                "language": {
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Escuelas",
                                    "infoEmpty": "Mostrando 0 a 0 de 0 Escuelas",
                                    "infoFiltered": "(Filtrado de _MAX_ total Escuelas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Escuelas",
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
