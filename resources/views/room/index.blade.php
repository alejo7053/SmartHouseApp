<div class="table-responsive">
    <p></p>
    <table class="table table-bordered">
        @if(Auth::user()->role == "admin" || Auth::user()->role == "userHouse")
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Usuario</th>
            <th>Casa</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @if(Auth::user()->role == "admin")
            @foreach ($rooms as $room)
              <tr>
                <td>{{ $room->name }}</td>
                <td>{{ $room->description }}</td>
                <td>{{ $room->user->name }} {{ $room->user->lastname }}</td>
                <td>@if($room->house_id != null) {{ $room->house->name }} @endif</td>
                <td>
                    <a href="{{ route('rooms.show', $room->id) }}" title="Ver Habitación"><i class="material-icons">account_box</i></a>
                    @if(Auth::user()->role == "admin")
                        <a href="{{ route('rooms.edit', $room->id) }}" title="Editar Habitación"><i class="material-icons">edit</i></a>

                        <a href="{{ route('home') }}" class="text-danger" title="Eliminar Habitación"
                          onclick="if(confirm('¿Desea eliminar la habitación {{ $room->name }}?'))
                          {document.getElementById('delete-room{{$room->id}}').submit();}"><i class="material-icons">delete_forever</i></a>
                        <form id="delete-room{{$room->id}}" method="POST" action="{{ route('rooms.destroy', $room->id) }}" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endif
                </td>
              </tr>
            @endforeach
          @endif
          @if(Auth::user()->role == "userHouse")
              @foreach($user->houses as $house)
                @foreach ($house->rooms as $room)
                  <tr>
                    <td>{{ $room->name }}</td>
                    <td>{{ $room->description }}</td>
                    <td>{{ $room->user->name }} {{ $room->user->lastname }}</td>
                    <td>@if($room->house_id != null) {{ $room->house->name }} @endif</td>
                    <td>
                        <a href="{{ route('rooms.show', $room->id) }}" title="Ver Habitación"><i class="material-icons">account_box</i></a>
                        @if(Auth::user()->id == $room->user->id)
                          <a href="{{ route('rooms.edit', $room->id) }}" title="Editar Habitación"><i class="material-icons">edit</i></a>
                        @endif
                    </td>
                  </tr>
                @endforeach
              @endforeach
          @endif
        </tbody>
        @endif
        @if(Auth::user()->role == "userRoom")
        <thead class="thead-light">
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Casa</th>
            <th>Editar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->rooms as $room)
            <tr>
              <td>{{ $room->name }}</td>
              <td>{{ $room->description }}</td>
              <td>{{ $room->house->name }}</td>
              <td><a href="{{ route('rooms.edit', $room->id) }}" title="Editar Habitación"><i class="material-icons">edit</i></a></td>
            </tr>
          @endforeach
        </tbody>
        @endif
    </table>
</div>
