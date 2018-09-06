@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
          @if(Auth::user()->role == "admin")
          <label class="navbar-brand">Crear</label>
          <nav class="navbar">
            <!-- <ul class="nav flex-column"> -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('users/create') }}"><i class="material-icons">add_circle</i>
                      Usuario</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('houses/create') }}"><i class="material-icons">add_circle</i>
                      {{ __('Casa') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('rooms/create') }}"><i class="material-icons">add_circle</i>
                      {{ __('Habitación') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('devices/create') }}"><i class="material-icons">add_circle</i>
                      Dispositivo</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li> -->
              </ul>
            <!-- </ul> -->
          </nav>
          @endif
        </div>
        <div @if(Auth::user()->role == "admin") class="col-md-10" @else class="col-md-12" @endif>
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->role == "userRoom")
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                  Mi Perfil
                                  <a href="{{ route('users.show', $user->id) }}" title="Ver"><i class="material-icons">account_box</i></a>
                                  <a href="{{ route('users.edit', $user->id) }}" title="Editar"><i class="material-icons">edit</i></a>
                                </div>
                                <div class="card-body">
                                    <h3>{{ $user->name }} {{ $user->lastname }}</h3>
                                    <h4>{{ $user->email}}</h4>
                                    {{ $user->created_at }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">Mi Habitación</div>
                                <div class="card-body">
                                  @include('room.index')
                                </div>
                            </div>
                        </div>
                        @include('device.index')
                    </div>
                    @endif

                    @if(Auth::user()->role == "admin" || Auth::user()->role == "userHouse")
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#users">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#houses">Casas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rooms">Habitaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#devices">Dispositivos</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane container active" id="users">@include('user.index')</div>
                        <div class="tab-pane container fade" id="houses">@include('house.index')</div>
                        <div class="tab-pane container fade" id="rooms">@include('room.index')</div>
                        <div class="tab-pane container fade" id="devices">@include('device.index')</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
