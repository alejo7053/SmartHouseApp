<div class="table-responsive">
  <p></p>
  <table class="table table-bordered">
      @if(Auth::user()->role == "admin" || Auth::user()->role == "userHouse")
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Email</th>
          <th>Rol</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @if(Auth::user()->role == "admin")
          @foreach ($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->lastname }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role }}</td>
              <td>
                <a href="{{ route('users.show', $user->id) }}" title="Ver Usuario"><i class="material-icons">account_box</i></a>
                <a href="{{ route('users.edit', $user->id) }}" title="Editar Usuario"><i class="material-icons">edit</i></a>

                <a href="#" class="text-danger" title="Eliminar Usuario"
                  onclick="if(confirm('¿Desea eliminar el usuario {{ $user->name }} {{ $user->lastname }}?'))
                  {document.getElementById('delete-user{{$user->id}}').submit();}"><i class="material-icons">delete_forever</i></a>
                <form id="delete-user{{$user->id}}" method="POST" action="{{ route('users.destroy', $user->id) }}" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>

              </td>
            </tr>
          @endforeach
        @endif
        @if(Auth::user()->role == "userHouse")
          @foreach ($user->users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->lastname }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->role }}</td>
              <td>
                <a href="{{ route('users.show', $user->id) }}" title="Ver Usuario"><i class="material-icons">account_box</i></a>
              </td>
            </tr>
          @endforeach
        @endif
      </tbody>
      @endif
  </table>
</div>
