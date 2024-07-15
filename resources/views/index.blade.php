@extends('layouts.admin')
@section('content')
    <div class="content" style="margin: 20px">

        <h1>Página principal</h1>
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">

                        <?php $contador_de_ministerio = 0; ?>
                        @foreach ($ministerios as $ministerio)
                            <?php $contador_de_ministerio = $contador_de_ministerio + 1; ?>
                        @endforeach

                        <h3><?= $contador_de_ministerio ?></h3>
                        <p>Ministerios</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-building"></i>
                    </div>
                    <a href="{{ url('ministerios') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">

                        <?php $contador_de_miembros = 0; ?>
                        @foreach ($miembros as $miembro)
                            <?php $contador_de_miembros = $contador_de_miembros + 1; ?>
                        @endforeach

                        <h3><?= $contador_de_miembros ?></h3>
                        <p>Miembros</p>
                    </div>
                    <div class="icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <a href="{{ url('miembros') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>

            </div>
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
                    <a href="{{ url('miembros') }}" class="small-box-footer">Más información <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>

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

    </div>
@endsection
