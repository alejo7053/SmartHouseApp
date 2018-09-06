<div class="table-responsive">
    <p></p>
    <table class="table table-bordered">
        @if(Auth::user()->role == "admin" || Auth::user()->role == "userHouse")
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Dirección</th>
            <th>Habitaciones</th>
            <th>Usuario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @if(Auth::user()->role == "admin")
            @foreach ($houses as $house)
              <tr>
                <td>{{ $house->name }}</td>
                <td>{{ $house->description }}</td>
                <td>{{ $house->address }}</td>
                <td>{{ $house->roomsNumber }}</td>
                <td>{{ $house->user->name }} {{ $house->user->lastname }}</td>
                <td>
                    <a href="{{ route('houses.show', $house->id) }}" title="Ver Casa"><i class="material-icons">account_box</i></a>
                    <a href="{{ route('houses.edit', $house->id) }}" title="Editar Casa"><i class="material-icons">edit</i></a>

                    <a href="#" class="text-danger" title="Eliminar Casa"
                      onclick="if(confirm('¿Desea eliminar la casa {{ $house->name }}?'))
                      {document.getElementById('delete-house{{$house->id}}').submit();}"><i class="material-icons">delete_forever</i></a>
                    <form id="delete-house{{$house->id}}" method="POST" action="{{ route('houses.destroy', $house->id) }}" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                </td>
              </tr>
            @endforeach
          @endif
          @if(Auth::user()->role == "userHouse")
            @foreach ($user->houses as $house)
              <tr>
                <td>{{ $house->name }}</td>
                <td>{{ $house->description }}</td>
                <td>{{ $house->address }}</td>
                <td>{{ $house->roomsNumber }}</td>
                <td>{{ $house->user->name }} {{ $house->user->lastname }}</td>
                <td>
                    <a href="{{ route('houses.show', $house->id) }}" title="Ver Casa"><i class="material-icons">account_box</i></a>
                    <a href="{{ route('houses.edit', $house->id) }}" title="Editar Casa"><i class="material-icons">edit</i></a>
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
        @endif
    </table>
</div>
