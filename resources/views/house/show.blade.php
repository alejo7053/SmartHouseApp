@extends('layouts.app')

@section('content')
<div class="container justify-center table-responsive">
  <table class="table">
      <thead class="thead-light">
          <tr>
              <th colspan="2"><h3>{{ $house->name }}</h3></th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>Descripción:</td>
              <td>{{ $house->description }}</td>
          </tr>
          <tr>
              <td>Dirección:</td>
              <td>{{ $house->address }}</td>
          </tr>
          <tr>
              <td>Habitaciones:</td>
              <td>{{ $house->roomsNumber }}</td>
          </tr>
          <tr>
              <td>Usuario:</td>
              <td>{{ $house->user->name }} {{ $house->user->lastname }}</td>
          </tr>
          <tr>
              <td>Creada:</td>
              <td>{{ $house->created_at }}</td>
          </tr>
          <tr>
              <td>Actualizada:</td>
              <td>{{ $house->updated_at }}</td>
          </tr>
      </tbody>
  </table>

  <div class="btn-group">
      <a href="{{ route('home')}}" title="Volver" role="button" class="btn btn-primary"><i class="material-icons">arrow_back_ios</i>Volver</a>
      <a href="{{ route('houses.edit', $house->id) }}" title="Editar Casa" role="button" class="btn btn-primary"><i class="material-icons">edit</i>Editar</a>
  </div>
  @if(Auth::user()->role=="admin")
  <div class="btn">
    <a href="#" class="btn btn-danger" title="Eliminar Casa"
      onclick="if(confirm('¿Desea eliminar la casa {{ $house->name }}?'))
      {document.getElementById('delete-form{{$house->id}}').submit();}"><i class="material-icons">delete_forever</i>Eliminar</a>
    <form id="delete-form{{$house->id}}" method="POST" action="{{ route('houses.destroy', $house->id) }}" style="display: none;">
        @method('DELETE')
        @csrf
    </form>
  </div>
  @endif
</div>
@stop
