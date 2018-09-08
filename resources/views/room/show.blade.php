@extends('layouts.app')

@section('content')

<div class="container justify-center table-responsive">
  <table class="table">
      <thead class="thead-light">
          <tr>
              <th colspan="2"><h3>{{ $room->name }}</h3></th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>Descripción:</td>
              <td>{{ $room->description }}</td>
          </tr>
          <tr>
              <td>Dispositivos:</td>
              <td>{{ $room->devicesNumber }}</td>
          </tr>
          <tr>
              <td>Usuario:</td>
              <td>{{ $room->user->name }} {{ $room->user->lastname }}</td>
          </tr>
          <tr>
              <td>Casa:</td>
              <td>@if($room->house_id != null) {{ $room->house->name }} @endif</td>
          </tr>
          @if(Auth::user()->role == "admin")
          <tr>
              <td>Id:</td>
              <td> {{ $room->id }} </td>
          </tr>
          <tr>
              <td>Token:</td>
              <td> {{ $room->token }} </td>
          </tr>
          @endif
          <tr>
              <td>Creada:</td>
              <td>{{ $room->created_at }}</td>
          </tr>
          <tr>
              <td>Actualizada:</td>
              <td>{{ $room->updated_at }}</td>
          </tr>
      </tbody>
  </table>

  <div class="btn-group">
      <a href="{{ route('home')}}" title="Volver" role="button" class="btn btn-primary"><i class="material-icons">arrow_back_ios</i>Volver</a>
      <a href="{{ route('houses.edit', $room->id) }}" title="Editar Habitación" role="button" class="btn btn-primary"><i class="material-icons">edit</i>Editar</a>
  </div>
  @if(Auth::user()->role=="admin")
    <div class="btn">
      <a href="#" class="btn btn-danger" title="Eliminar Habitación"
        onclick="if(confirm('¿Desea eliminar la habitación {{ $room->name }}?'))
        {document.getElementById('delete-form{{$room->id}}').submit();}"><i class="material-icons">delete_forever</i>Eliminar</a>
      <form id="delete-form{{$room->id}}" method="POST" action="{{ route('rooms.destroy', $room->id) }}" style="display: none;">
          @method('DELETE')
          @csrf
      </form>
    </div>
  @endif
</div>

@stop
