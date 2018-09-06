@extends('layouts.app')

@section('content')
<div class="container justify-center table-responsive">
  <table class="table">
      <thead class="thead-light">
          <tr>
              <th colspan="2"><h3>{{ $user->name }} {{ $user->lastname }}</h3></th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>Email:</td>
              <td>{{ $user->email }}</td>
          </tr>
          <tr>
              <td>Rol:</td>
              <td>{{ $user->role }}</td>
          </tr>
          <tr>
              <td>Creado:</td>
              <td>{{ $user->created_at }}</td>
          </tr>
          <tr>
              <td>Actualizado:</td>
              <td>{{ $user->updated_at }}</td>
          </tr>
      </tbody>
  </table>

  <div class="btn-group">
      <a href="{{ route('home')}}" title="Volver" role="button" class="btn btn-primary"><i class="material-icons">arrow_back_ios</i>Volver</a>
      <a href="{{ route('users.edit', $user->id) }}" title="Editar Usuario" role="button" class="btn btn-primary"><i class="material-icons">edit</i>Editar</a>
  </div>
  @if(Auth::user()->role == "admin")
      <div class="btn">
        <a href="#" class="btn btn-danger" title="Eliminar Usuario"
          onclick="if(confirm('¿Desea eliminar el usuario {{ $user->name }} {{ $user->lastname }}?'))
          {document.getElementById('delete-form{{$user->id}}').submit();}"><i class="material-icons">delete_forever</i>Eliminar</a>
        <form id="delete-form{{$user->id}}" method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: none;">
            @method('DELETE')
            @csrf
        </form>
      </div>
  @endif
</div>
@stop
