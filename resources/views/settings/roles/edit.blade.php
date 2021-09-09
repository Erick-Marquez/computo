@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('roles.update', $role) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-normal">Nombre del Rol</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Rol" value="{{ $role->name }}" required>
                </div>
                <label class="font-weight-normal">Permisos</label>
                @foreach ($permissions as $permission)
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-on-success">
                            <input class="custom-control-input" type="checkbox" id="{{ $permission->name }}" value="{{ $permission->id }}" name="permissions[]"
                            @foreach ($role->getPermissionNames() as $item)
                                @if ($item == $permission->name)
                                    checked
                                @else
                                    
                                @endif
                            @endforeach
                            >
                            <label class="custom-control-label" for="{{ $permission->name }}">
                                {{ $permission->description }}
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
    <script> console.log('Hi!'); </script>
@stop