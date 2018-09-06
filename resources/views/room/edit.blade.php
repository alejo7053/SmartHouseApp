@extends('layouts.app')

<script type="text/javascript">
    var housesId = new Array( {{count($users) }})
    var housesName = new Array( {{count($users) }})
    housesId["empty"] = ["e"];
    @foreach($users as $user)
        housesId[{{ $user->id }}] = [
        @if($user->user==null)
          @foreach($user->houses as $house)
              {{ $house->id }},
          @endforeach
        @else
          @foreach($user->user->houses as $house)
              {{ $house->id }},
          @endforeach
        @endif
        ];
    @endforeach
    housesName["empty"] = ["Seleccione..."];
    @foreach($users as $user)
        housesName[{{ $user->id }}] = [
        @if($user->user==null)
          @foreach($user->houses as $house)
              "{{ $house->name }}",
          @endforeach
        @else
          @foreach($user->user->houses as $house)
              "{{ $house->name }}",
          @endforeach
        @endif
        ];
    @endforeach

    function userChange(selectObj) {
        var idx = selectObj.selectedIndex;
        var which = selectObj.options[idx].value;
        hList = housesId[which];
        hName = housesName[which];
        var optSelect = document.getElementById("house");

        while(optSelect.options.length>0) {
            optSelect.remove(0);
        }
        var newOption;

        if(hList!=0){
            document.getElementById("houseDiv").style.display = "block";
            for(var i=0; i<hList.length; i++) {
                newOption = document.createElement("option");
                newOption.value = hList[i];
                newOption.text= hName[i];

                try {
                    optSelect.add(newOption);
                }
                catch (e) {
                    optSelect.appendChild(newOption);
                }
            }
        }else{
            document.getElementById("houseDiv").style.display = "none";
        }
    }
</script>

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
  {{ Form::model($room, [
        'method' => 'PUT',
        'route' => ['rooms.update', $room->id]
    ]) }}
        <div class="form-group">
            {{ Form::label('name', 'Nombre', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Descripcion', ['class' => 'control-label']) }}
            {{ Form::text('description', null, ['class' => 'form-control']) }}
        </div>
        @if(Auth::user()->role == "admin")
          <div class="form-group">
              <label for="user">Usuario</label>
              <br>
              <select id="user" name="user_id" class="form-control" onchange="userChange(this);">
                  <option value="empty" selected>Seleccione...</option>
                  @foreach($users as $user)
                      <option value="{{$user->id}}">{{ $user->name }} {{ $user->lastname }}</option>
                  @endforeach
              </select>
          </div>
          <div class="form-group" id="houseDiv">
              <label for="house">Casa</label>
              <br>
              <select id="house" name="house_id" class="form-control">
                  <option value="empty" selected>Seleccione...</option>

              </select>
          </div>
        @endif
        {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-primary']) }}
        <a href="{{ route('home')}}" title="Cancelar" role="button" class="btn btn-danger">Cancelar</a>
    {{ Form::close() }}
</div>

@stop
