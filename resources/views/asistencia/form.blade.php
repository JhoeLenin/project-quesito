<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('fecha') }}
            {{ Form::date('fecha', $asistencia->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
            {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Becarios') }}
            {{ Form::select('becario_id',$becarios, $asistencia->becario_id, ['class' => 'form-control' . ($errors->has('becario_id') ? ' is-invalid' : ''), 'placeholder' => 'Buscar becarios']) }}
            {!! $errors->first('becario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Guardar Asistencia') }}</button>
    </div>
</div>
