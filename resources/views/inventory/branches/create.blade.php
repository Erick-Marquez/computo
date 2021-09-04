@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Sucursal</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('branches.store') }}">
                @csrf
                <div class="form-group">
                    <label for="description" class="font-weight-normal">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="font-weight-normal">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono" required>
                </div>
                <div class="form-group">
                    <label for="direction" class="font-weight-normal">Dirección</label>
                    <input type="text" class="form-control" id="direction" name="direction" placeholder="Dirección" required>
                </div>
                <div class="form-group">
                    <label for="ubigeo" class="font-weight-normal">Ubigeo</label>
                    <input type="text" class="form-control" id="ubigeo" name="ubigeo" placeholder="Ubigeo" required>
                </div>
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