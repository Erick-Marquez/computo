@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Configuracion de PC</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('assemblies.update', $assembly) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-normal">Nombre de la Configuración</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de la configuración" value="{{ $assembly->name }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="description" class="font-weight-normal">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="{{ $assembly->description }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="price" class="font-weight-normal">Precio Referencial</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Precio Referencial" value="{{ $assembly->price }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="discount" class="font-weight-normal">Descuento</label>
                    <input type="text" class="form-control" id="discount" name="discount" placeholder="Descuento" value="{{ $assembly->discount }}" required autocomplete="off">
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="2">Productos</th>
                        </tr>
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assemblyProducts as $assemblyProduct)
                            <tr>
                                <td>{{ $assemblyProduct->name }}</td>
                                <td>{{ $assemblyProduct->pivot->quantity }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        
    </script>
@stop
