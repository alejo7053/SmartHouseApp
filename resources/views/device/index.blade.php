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
          @foreach($room->devices->sortByDesc(function ($product, $key) {
              return $product['role'].$product['id'];
          }) as $device)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header" id="t{{$device->id}}"><a href="#t{{$device->id}}" class="card-link">{{ $device->description }}</a></div>
                    <div class="card-body">
                      <table class="table table-bordered">
                        <tbody>
                          <tr>
                            <td class="bg-light text-muted">Habitación</td>
                            <td>{{ $device->room->name}}</td>
                          </tr>
                          @if($device->role == "load")
                          <tr>
                            <td class="bg-light text-muted">Estado</td>
                            <td>{{ $device->status }}
                              <a href="#t{{$device->id}}" title="Cambiar Estado..."
                            @if($device->status == "on") class="text-success" @else class="text-danger" @endif
                            onclick="if(confirm('¿Desea cambiar el estado del {{ $device->description }}?'))
                            {document.getElementById('status-form{{$device->id}}').submit();}"><i class="material-icons">cached</i></a></td>
                            <form id="status-form{{$device->id}}" method="POST" action="{{ route('devices.update', $device->id) }}" style="display: none;">
                                @method('PUT')
                                @csrf
                                <input id="status" name="status" @if($device->status == "on")value="off"@else value="on" @endif style="display: none"></input>
                            </form>
                          </tr>
                            @if($device->name != "Control AC" && $device->name != "Control DC")
                              <tr>
                                <td class="bg-light text-muted">Reglas</td>
                                <td>{{ $device->action }} <a href="{{ route('rules', $device->id) }}" title="Añadir Regla..."><i class="material-icons">add_circle</i></a></td>
                              </tr>
                            @endif
                          @endif
                          @if($device->name == "Control AC")
                            <tr>
                              <td  class="bg-light text-muted">Valor</td>
                              <td><div id="v{{$device->id}}">{{ $device->value }}</div>
                                <div class="slidecontainer">
                                  <a href="#t{{$device->id}}" title="Cambiar Valor..."
                                  onchange="{document.getElementById('value-form{{$device->id}}').submit();}">
                                  <form id="value-form{{$device->id}}" method="POST" action="{{ route('devices.update', $device->id) }}">
                                      @method('PUT')
                                      @csrf
                                      <input type="range" min="20" max="100" value="{{$device->value}}" step="20" class="slider" id="vR{{$device->id}}" name="value">
                                  </form>
                                </div>
                              </td>
                            </tr>
                            <script>
                                var slider{{$device->id}} = document.getElementById("vR{{$device->id}}");
                                var output{{$device->id}} = document.getElementById("v{{$device->id}}");
                                output{{$device->id}}.innerHTML = slider{{$device->id}}.value; // Display the default slider value
                                // Update the current slider value (each time you drag the slider handle)
                                slider{{$device->id}}.oninput = function() {
                                output{{$device->id}}.innerHTML = this.value;
                              };
                            </script>
                          @elseif($device->name == "Control DC")
                            <tr>
                              <td  class="bg-light text-muted">Valor</td>
                              <td><div id="v{{$device->id}}">{{ $device->value }}</div>
                                <div class="slidecontainer">
                                  <a href="#t{{$device->id}}" title="Cambiar Valor..."
                                  onchange="{document.getElementById('value-form{{$device->id}}').submit();}">
                                  <form id="value-form{{$device->id}}" method="POST" action="{{ route('devices.update', $device->id) }}">
                                      @method('PUT')
                                      @csrf
                                      <input type="range" min="-100" max="100" value="{{$device->value}}" step="10" class="slider" id="vR{{$device->id}}" name="value">
                                  </form>
                                </div>
                              </td>
                            </tr>
                            <script>
                                var slider{{$device->id}} = document.getElementById("vR{{$device->id}}");
                                var output{{$device->id}} = document.getElementById("v{{$device->id}}");
                                output{{$device->id}}.innerHTML = slider{{$device->id}}.value; // Display the default slider value
                                // Update the current slider value (each time you drag the slider handle)
                                slider{{$device->id}}.oninput = function() {
                                output{{$device->id}}.innerHTML = this.value;
                              };
                            </script>
                          @elseif($device->name == "Simple DC")
                              <tr>
                                <td  class="bg-light text-muted">Valor</td>
                                <td><div id="v{{$device->id}}">{{ $device->value }}</div>
                                  <div class="slidecontainer">
                                    <a href="#t{{$device->id}}" title="Cambiar Valor..."
                                    onchange="{document.getElementById('value-form{{$device->id}}').submit();}">
                                    <form id="value-form{{$device->id}}" method="POST" action="{{ route('devices.update', $device->id) }}">
                                        @method('PUT')
                                        @csrf
                                        <input type="range" min="10" max="100" value="{{$device->value}}" step="10" class="slider" id="vR{{$device->id}}" name="value">
                                    </form>
                                  </div>
                                </td>
                              </tr>
                              <script>
                                  var slider{{$device->id}} = document.getElementById("vR{{$device->id}}");
                                  var output{{$device->id}} = document.getElementById("v{{$device->id}}");
                                  output{{$device->id}}.innerHTML = slider{{$device->id}}.value; // Display the default slider value
                                  // Update the current slider value (each time you drag the slider handle)
                                  slider{{$device->id}}.oninput = function() {
                                  output{{$device->id}}.innerHTML = this.value;
                                };
                              </script>
                          @elseif($device->role == "sensor")
                              @if($device->name != "Lluvia" && $device->name != "Movimiento")
                                <tr>
                                  <td  class="bg-light text-muted">Valor</td>
                                  <td id="v{{$device->id}}">{{ $device->value }}</td>
                                </tr>
                                @if($device->name == "Air")
                                    <script>
                                      var air{{$device->id}} = document.getElementById("v{{$device->id}}");
                                      if(air{{$device->id}}.innerHTML > 2500)
                                      {
                                        air{{$device->id}}.innerHTML = "Peligro"
                                      }
                                      else if (air{{$device->id}}.innerHTML > 1700) {
                                        air{{$device->id}}.innerHTML = "Alerta"
                                      }
                                      else
                                      {
                                        air{{$device->id}}.innerHTML = "Normal"
                                      }
                                    </script>
                                @endif
                              @elseif($device->name == "Lluvia")
                                <tr>
                                  <td  class="bg-light text-muted">Ultimo: </td>
                                  <td id="vt{{$device->id}}">{{ $device->updated_at->setTimezone('America/Bogota') }}</td>
                                </tr>
                                <tr>
                                  <td  class="bg-light text-muted">Valor: </td>
                                  <td id="v{{$device->id}}">{{ $device->value }}</td>
                                </tr>
                                <script>
                                  var rain{{$device->id}} = document.getElementById("v{{$device->id}}");
                                  if(rain{{$device->id}}.innerHTML == 1){
                                    rain{{$device->id}}.innerHTML = "Llueve";
                                  }else{
                                    rain{{$device->id}}.innerHTML = "No Llueve";
                                  }
                                </script>
                              @else
                                <tr>
                                  <td  class="bg-light text-muted">Ultimo: </td>
                                  <td id="v{{$device->id}}">{{ $device->updated_at->setTimezone('America/Bogota') }}</td>
                                </tr>
                              @endif
                          @endif
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <script>
                setInterval(function() {  window.location.reload() }, 10000);
            </script>
          @endforeach
        @endforeach
        @endif
