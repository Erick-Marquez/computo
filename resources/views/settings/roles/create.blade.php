@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nuevo Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-normal">Nombre del Rol</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del Rol" required>
                </div>
                <h5>Permisos</h5>
                @foreach ($permissions as $permission)
                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-on-success">
                            <input class="custom-control-input" type="checkbox" id="{{ $permission->name }}" value="{{ $permission->id }}" name="permissions[]">
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
    <script>
        console.log('Hi!');
    </script>
@stop
