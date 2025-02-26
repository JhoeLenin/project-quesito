@extends('layouts.admin')

@section('template_title')
    Asistencia
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="" style="display: flex; justify-content: space-between; align-items: center;">
                            <h2 class="card-title"><b>Asistencias registradas</b></h2>
                            <div class="float-right">
                                <a href="{{ route('asistencias.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    <h2 class="card-title">Nueva asistencia</h2>
                                </a>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>Nro</th>
                                        <th>Fecha</th>
                                        <th>Código</th>
                                        <th>Estado</th>
                                        <th>Miembro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asistencias as $asistencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $asistencia->fecha }}</td>
                                            <td>{{ $asistencia->becario->codigo }}</td>
                                            <td>
                                                @if ($asistencia->estado == 1)
                                                    <i class="fa fa-check" style="color: green;"></i> <!-- Check para estado 1 -->
                                                @else
                                                    <i class="fa fa-times" style="color: red;"></i> <!-- Aspa para estado 0 -->
                                                @endif
                                            </td>
                                            <td>{{ $asistencia->becario->nombre_apellido }}</td>
                                            <center>
                                                <td>
                                                    <form action="{{ route('asistencias.destroy', $asistencia->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary" href="{{ route('asistencias.show', $asistencia->id) }}">
                                                            <i class="fa fa-fw fa-eye"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-warning" href="{{ route('asistencias.edit', $asistencia->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('¿Está seguro que desea borrar este registro?')" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-fw fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </center>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $asistencias->links() !!}
            </div>
        </div>
    </div>

    <script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 20,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Asistencias",
                "infoEmpty": "Mostrando 0 a 0 de 0 Asistencias",
                "infoFiltered": "(Filtrado de _MAX_ total Asistencias)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Asistencias",
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
                }]
            }, {
                extend: 'colvis',
                text: 'Visor de columnas',
                collectionLayout: 'fixed three-column'
            }],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
    </script>
@endsection
