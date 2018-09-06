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
    {{ Form::open(['route' => 'houses.store']) }}
        <div class="form-group">
            {{ Form::label('name', 'Nombre', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Descripcion', ['class' => 'control-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('address', 'Direccion', ['class' => 'control-label']) }}
            {{ Form::text('address', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('roomsNumber', 'Numero de Habitaciones', ['class' => 'control-label']) }}
            {{ Form::number('roomsNumber', null,['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label>Usuario</label>
            <br>
            <select name="user_id" class="form-control">
                @foreach($users as $user)
                    <option value='{{$user->id}}'>{{ $user->name }} {{ $user->lastname }}</option>
                @endforeach
            </select>
        </div>
        {{ Form::submit('Crear una nueva casa', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>

@stop
