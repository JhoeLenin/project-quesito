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
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Listado de Asistencia') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('asistencias.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Nueva asistencia') }}
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
                                        <th>Miembro</th>

                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($asistencias as $asistencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $asistencia->fecha }}</td>
                                            <td>{{ $asistencia->miembro->nombre_apellido }}</td>
                                            <center>
                                                <td>
                                                    <form action="{{ route('asistencias.destroy', $asistencia->id) }}"
                                                        method="POST">
                                                        <a class="btn btn-sm btn-primary "
                                                            href="{{ route('asistencias.show', $asistencia->id) }}"><i
                                                                class="fa fa-fw fa-eye"></i> </a>
                                                        <a class="btn btn-sm btn-warning"
                                                            href="{{ route('asistencias.edit', $asistencia->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i></a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('¿Está seguro que desea borrar este registro?')" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i> </button>
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
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>
@endsection
