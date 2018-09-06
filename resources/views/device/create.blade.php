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
    {{ Form::open(['route' => 'devices.store']) }}
        <div class="form-group">
            {{ Form::label('name', 'Nombre', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Descripción', ['class' => 'control-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('role', 'Rol', ['class' => 'control-label']) }}
            {{ Form::select('role', array(
              'load' => 'Carga', 'sensor' => 'Sensor')
              ,'sensor', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('type', 'Tipo', ['class' => 'control-label']) }}
            {{ Form::select('type', array(
              'AC' => 'Corriente Alterna', 'DC' => 'Corriente Directa',
              'Digital' => 'Digital', 'Analogic' => 'Analogico'),'DC', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label>Habitación</label>
            <br>
            <select name="room_id" class="form-control">
                @foreach($rooms as $room)
                    <option value='{{$room->id}}'>{{ $room->name }}</option>
                @endforeach
            </select>
        </div>

        {{ Form::submit('Crear un nuevo dispositivo', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>

@stop
