@extends('layouts.app')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-md-4 container-fluid">
    {{ Form::model($device, [
          'method' => 'PUT',
          'route' => ['rules.update', $device->id]
      ]) }}
      <div class="form-group">
          {{ Form::label('action','Encender' , ['class' => 'control-label']) }}
          {{ Form::radio('action', 'on') }}
      </div>

      <div class="form-group">
          {{ Form::label('action','Apagar' , ['class' => 'control-label']) }}
          {{ Form::radio('action', 'off') }}
      </div>

      <div class="form-group">
          {{ Form::label('action','Desactivar Regla' , ['class' => 'control-label']) }}
          {{ Form::radio('action', '0') }}
      </div>

      <label for="example" class="form-group">Ej: 2018-09-25 18:00:00</label>

      <div class="nativeDateTimePicker form-group">
        <label for="rule-start">Inicio: </label>
        <input type="datetime-local" id="start" name="start" value="{{$device->start}}">
        <span class="validity"></span>
      </div>

      <div class="nativeDateTimePicker form-group">
        <label for="rule-end">Fin: </label>
        <input type="datetime-local" id="end" name="end" value="{{$device->end}}">
        <span class="validity"></span>
      </div>

      {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-primary']) }}
      <a href="{{ route('home')}}" title="Cancelar" role="button" class="btn btn-danger">Cancelar</a>

    {{ Form::close() }}
</div>
@stop
