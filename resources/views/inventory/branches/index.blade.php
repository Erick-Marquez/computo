@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Sucursales</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('branches.create') }}">Nuevo</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfono</th>
                        <th>Activo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($branches as $branch)
                        <tr>
                            <td>{{ $branch->id }}</td>
                            <td>{{ $branch->description }}</td>
                            <td>{{ $branch->direction }}</td>
                            <td>{{ $branch->phone }}</td>
                            <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-on-success">
                                        <input class="custom-control-input" type="checkbox" id="{{ $branch->id }}" value="{{ $branch->id }}" name="branch[]"
                                            @if ($branch->state)
                                                checked
                                            @else
                                                
                                            @endif
                                        >
                                        <label class="custom-control-label" for="{{ $branch->id }}">
                                        </label>
                                    </div>                
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                        <a class="dropdown-item" href="{{ route('branches.show', $branch) }}"><i
                                                class="col-1 mr-3 fas fa-eye"></i>Mostrar</a>

                                        @can('branches.products')
                                            <a class="dropdown-item" href="{{ route('branches.products', $branch) }}"><i
                                                    class="col-1 mr-3 fas fa-boxes"></i>Ver productos</a>
                                        @endcan

                                        @can('branches.edit')
                                            <a class="dropdown-item" href="{{ route('branches.edit', $branch) }}"><i
                                                    class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                                        @endcan

                                        @can('branches.destroy')
                                            <form action="{{ route('branches.destroy', $branch) }}" method="POST"
                                                class="delete-rol">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit"><i
                                                        class="col-1 mr-3 fas fa-trash"></i>Eliminar</button>
                                            </form>
                                        @endcan
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
    <script>
        console.log('Hi!');
    </script>
@stop
