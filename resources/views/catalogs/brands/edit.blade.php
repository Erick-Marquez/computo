@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Marca</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('brands.update', $brand) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="cod" class="font-weight-normal">Código</label>
                    <input type="text" class="form-control" id="cod" name="cod" placeholder="Código" value="{{ $brand->cod }}" required>
                </div>
                <div class="form-group">
                    <label for="description" class="font-weight-normal">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="{{ $brand->description }}" required>
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