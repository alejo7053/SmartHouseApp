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
  {{ Form::model($house, [
        'method' => 'PUT',
        'route' => ['houses.update', $house->id]
    ]) }}
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
        @if(Auth::user()->role == "admin")
          <div class="form-group">
              <label>Usuario</label>
              <br>
              <select name="user_id" class="form-control">
                  @foreach($users as $user)
                      <option value='{{$user->id}}'>{{ $user->name }} {{ $user->lastname }}</option>
                  @endforeach
              </select>
          </div>
        @endif
        {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-primary']) }}
        <a href="{{ route('home')}}" title="Cancelar" role="button" class="btn btn-danger">Cancelar</a>
    {{ Form::close() }}
</div>

@stop
