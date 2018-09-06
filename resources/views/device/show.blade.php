@extends('layouts.app')

@section('content')
<div class="container justify-center table-responsive">
  <table class="table">
      <thead class="thead-light">
          <tr>
              <th colspan="2"><h3>{{ $device->name }}</h3></th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>Ultimo Valor:</td>
              <td>{{ $device->value }}</td>
          </tr>
          <tr>
              <td>Descripción:</td>
              <td>{{ $device->description }}</td>
          </tr>
          <tr>
              <td>Rol:</td>
              <td>{{ $device->role }}</td>
          </tr>
          <tr>
              <td>Tipo:</td>
              <td>{{ $device->type }}</td>
          </tr>
          <tr>
              <td>Reglas:</td>
              <td>{{ $device->action }}</td>
          </tr>
          <tr>
              <td>Creado:</td>
              <td>{{ $device->created_at }}</td>
          </tr>
          <tr>
              <td>Actualizado:</td>
              <td>{{ $device->updated_at }}</td>
          </tr>
      </tbody>
  </table>

  <div class="btn-group">
      <a href="{{ route('home')}}" title="Volver" role="button" class="btn btn-primary"><i class="material-icons">arrow_back_ios</i>Volver</a>
      <a href="{{ route('rules', $device->id) }}" title="Añadir Regla..." role="button" class="btn btn-primary"><i class="material-icons">edit</i>Activar Reglas</a>
  @if(Auth::user()->role=="admin")
      <a href="{{ route('devices.edit', $device->id) }}" title="Editar Dispositivo" role="button" class="btn btn-primary"><i class="material-icons">edit</i>Editar</a>
  </div>
    <div class="btn">
      <a href="#" class="btn btn-danger" title="Eliminar Dispositivo"
        onclick="if(confirm('¿Desea eliminar el dispositivo {{ $device->name }}?'))
        {document.getElementById('delete-form{{$device->id}}').submit();}"><i class="material-icons">delete_forever</i>Eliminar</a>
      <form id="delete-form{{$device->id}}" method="POST" action="{{ route('devices.destroy', $device->id) }}" style="display: none;">
          @method('DELETE')
          @csrf
      </form>
  @endif
    </div>
</div>
@stop
