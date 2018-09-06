        @if(Auth::user()->role == "admin" || Auth::user()->role == "userHouse")
        <div class="table-responsive">
          <p></p>
        <table class="table table-bordered">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Habitación</th>
            <th>Rol</th>
            <th>Tipo</th>
            <th>Reglas</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            @if(Auth::user()->role == "admin")
                @foreach ($devices as $device)
                  <tr>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->description }}</td>
                    <td>{{ $device->room->name }}</td>
                    <td>{{ $device->role }} </td>
                    <td>{{ $device->type }} </td>
                    <td>{{ $device->action }}</td>
                    <td> </td>
                    <td>
                        <a href="{{ route('devices.show', $device->id) }}" title="Ver Dispositivo"><i class="material-icons">account_box</i></a>
                        <a href="{{ route('devices.edit', $device->id) }}" title="Editar Dispositivo"><i class="material-icons">edit</i></a>

                        <a href="{{ route('home') }}" class="text-danger" title="Eliminar Dispositivo"
                          onclick="if(confirm('¿Desea eliminar el dispositivo {{ $device->name }}?'))
                          {document.getElementById('delete-device{{$device->id}}').submit();}"><i class="material-icons">delete_forever</i></a>
                        <form id="delete-device{{$device->id}}" method="POST" action="{{ route('devices.destroy', $device->id) }}" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    </td>
                  </tr>
                @endforeach
            @endif
            @if(Auth::user()->role == "userHouse")
                @foreach($user->houses as $house)
                  @foreach ($house->devices as $device)
                      <tr>
                        <td>{{ $device->name }}</td>
                        <td>{{ $device->description }}</td>
                        <td>{{ $device->room->name }}</td>
                        <td>{{ $device->role }} </td>
                        <td>{{ $device->type }} </td>
                        <td>{{ $device->action }}@if($device->room->user->id == Auth::user()->id) <a href="#" title="Añadir Regla..."><i class="material-icons">add_circle</i></a> @endif</td>
                        <td>{{ $device->status }} </td>
                        <td>
                            <a href="{{ route('devices.show', $device->id) }}" title="Ver Dispositivo"><i class="material-icons">account_box</i></a>
                        </td>
                      </tr>
                  @endforeach
                @endforeach
            @endif
        </tbody>
      </table>
    </div>
        @endif
        @if(Auth::user()->role == "userRoom")
        @foreach($user->rooms as $room)
          @foreach($room->devices as $device)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ $device->description }}</div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="bg-light text-muted">Habitación</td>
                            <td>{{ $device->room->name}}</td>
                          </tr>
                          <tr>
                            <td class="bg-light text-muted">Estado</td>
                            <td>{{ $device->status }}
                            @if($device->role == "load")<a href="#" title="Cambiar Estado..."
                            @if($device->status == "on") class="text-success" @else class="text-danger" @endif
                            onclick="if(confirm('¿Desea cambiar el estado del {{ $device->description }}?'))
                            {document.getElementById('status-form{{$device->id}}').submit();}"><i class="material-icons">cached</i></a></td>
                            <form id="status-form{{$device->id}}" method="POST" action="{{ route('devices.update', $device->id) }}" style="display: none;">
                                @method('PUT')
                                @csrf
                                <input id="status" name="status" @if($device->status == "on")value="off"@else value="on" @endif style="display: none"></input>
                            </form>
                          </tr>
                          <tr>
                            <td class="bg-light text-muted">Reglas</td>
                            <td>{{ $device->action }} <a href="{{ route('rules', $device->id) }}" title="Añadir Regla..."><i class="material-icons">add_circle</i></a></td>
                            @endif
                          </tr>
                          <tr>
                            <td  class="bg-light text-muted">Valor</td>
                            <td>{{ $device->value }}</td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          @endforeach
        @endforeach
        @endif
