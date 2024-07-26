@php
    $contador = 1;
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de asistencias</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        table th {
            background-color: #f2f2f2;
        }

        .presente {
            color: green;
            font-weight: bold;
        }

        .falta {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2 class="mb-4" style="text-align: center">Reporte de asistencias</h2>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Nro</th>
                <th>Fecha</th>
                <th>Código</th>
                <th>Nombres y apellidos</th>
                <th>E.P.</th>
                <th>Estado</th> <!-- Nueva columna para estado -->
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $contador++ }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->becario->codigo }}</td>
                    <td>{{ $asistencia->becario->nombre_apellido }}</td>
                    <td>{{ $asistencia->becario->escuela->nombre_escuela }}</td>
                    <td>
                        @if ($asistencia->estado == 1)
                            <span class="presente">PRESENTE</span> <!-- Texto para estado 1 -->
                        @else
                            <span class="falta">FALTA</span> <!-- Texto para estado 0 -->
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
