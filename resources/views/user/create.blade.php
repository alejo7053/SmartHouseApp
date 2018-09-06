@extends('layouts.app')

<script type="text/javascript">
    var usersRole = new Array( {{count($users) }})
    var usersName = new Array( {{count($users) }})
    usersRole["empty"] = ["e"];
    usersRole["admin"] = [];
    usersRole["userHouse"] = [];
    usersRole["userRoom"] = ["",
    @foreach($users as $user)
            {{ $user->id }},
    @endforeach];
    usersName["empty"] = ["Seleccione..."];
    usersRole["admin"] = [];
    usersRole["userHouse"] = [];
    usersName["userRoom"] = ["Sin Usuario Casa",
    @foreach($users as $user)
            "{{ $user->name }} {{ $user->lastname }}",
    @endforeach];

    function roleChange(selectObj) {
        var idx = selectObj.selectedIndex;
        var which = selectObj.options[idx].value;
        uList = usersRole[which];
        uName = usersName[which];
        var optSelect = document.getElementById("parent_id");

        while(optSelect.options.length>0) {
            optSelect.remove(0);
        }
        var newOption;

        if(uList!=0){
            document.getElementById("userDiv").style.display = "block";
            for(var i=0; i<uList.length; i++) {
                newOption = document.createElement("option");
                newOption.value = uList[i];
                newOption.text= uName[i];

                try {
                    optSelect.add(newOption);
                }
                catch (e) {
                    optSelect.appendChild(newOption);
                }
            }
        }else{
            document.getElementById("userDiv").style.display = "none";
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
    {{ Form::open(['route' => 'users.store']) }}
        <div class="form-group">
            {{ Form::label('name', 'Nombre', ['class' => 'control-label']) }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('lastname', 'Apellido', ['class' => 'control-label']) }}
            {{ Form::text('lastname', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
            {{ Form::text('email', null, ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <br>
            <select id="role" name="role" class="form-control" onchange="roleChange(this);">
                <option value="empty" selected>Seleccione...</option>
                <option value="admin">Administrador</option>
                <option value="userHouse">Usuario Casa</option>
                <option value="userRoom">Usuario Habitación</option>
            </select>
        </div>
        <div class="form-group" id="userDiv">
            <label for="parent_id">Usuario Casa</label>
            <br>
            <select id="parent_id" name="parent_id" class="form-control">
                <option value="" selected>Seleccione...</option>

            </select>
        </div>

        {{ Form::submit('Crear un nuevo usuario', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}
</div>

@stop
