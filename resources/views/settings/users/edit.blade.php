@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-normal">Nombre Completo</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre Completo"
                        value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="font-weight-normal">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email"
                        value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-normal">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña"
                    >
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="font-weight-normal">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirmar Contraseña">
                </div>
                <h5>Lista de Roles</h5>
                @foreach ($roles as $role)
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-on-success">
                            <input class="custom-control-input" type="checkbox" id="{{ $role->name }}" value="{{ $role->id }}" name="roles[]" 
                                @foreach ($user->getRoleNames() as $item)  
                                    @if ($item==$role->name)
                                    checked
                                    @else 

                                    @endif
                                @endforeach
                            >
                            <label class="custom-control-label" for="{{ $role->name }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
