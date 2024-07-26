@extends('layouts.admin')
@section('content')
    <div class="content" style="margin: 20px">

        <h1>Página principal</h1>
        <div class="row">
        @can('escuelas')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        
                        <?php $contador_de_escuelas = 0; ?>
                        @foreach ($escuelas as $escuela)
                            <?php $contador_de_escuelas = $contador_de_escuelas + 1; ?>
                        @endforeach

                        <h3><?= $contador_de_escuelas ?></h3>
                        <p>Escuelas</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <a href="{{ url('escuelas') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
        @endcan

        @can('becarios')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">

                        <?php $contador_de_becarios = 0; ?>
                        @foreach ($becarios as $becario)
                            <?php $contador_de_becarios = $contador_de_becarios + 1; ?>
                        @endforeach

                        <h3><?= $contador_de_becarios ?></h3>
                        <p>Becarios</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <a href="{{ url('becarios') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
        @endcan

        @can('usuarios')
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">

                        <?php $contador_de_usuarios = 0; ?>
                        @foreach ($usuarios as $usuario)
                            <?php $contador_de_usuarios = $contador_de_usuarios + 1; ?>
                        @endforeach

                        <h3><?= $contador_de_usuarios ?></h3>
                        <p>Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-fill-check"></i>
                    </div>
                    <a href="{{ url('usuarios') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
        @endcan


        @can('asistencias')
        </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">

                        <?php $contador_de_asistencias = 0; ?>
                        @foreach ($asistencias as $asistencia)
                            <?php $contador_de_asistencias = $contador_de_asistencias + 1; ?>
                        @endforeach

                        <h3><?= $contador_de_asistencias ?></h3>
                        <p>Asistencias</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-person-raised-hand"></i>
                    </div>
                    <a href="{{ url('asistencias') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
        </div>
        @endcan 

    </div>
@endsection
