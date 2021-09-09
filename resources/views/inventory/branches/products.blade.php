@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Productos de la Sucursal "{{ $branch->description }}"</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('branches.products.add', $branch) }}">Agregar Productos</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branchProducts as $branchProduct)
                        <tr>
                            <td>{{ $branchProduct->product->id }}</td>
                            <td>{{ $branchProduct->product->cod }}</td>
                            <td>{{ $branchProduct->product->name }}</td>
                            <td>{{ $branchProduct->product->description }}</td>
                            <td>{{ $branchProduct->stock }}</td>
                            <td>{{ $branchProduct->price }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">                                       
                                        <form action="{{ route('branches.products.destroy', $branchProduct) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item" type="submit"><i
                                                    class="col-1 mr-3 fas fa-trash"></i>Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop