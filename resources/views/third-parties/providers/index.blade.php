@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Proveedores</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('providers.create') }}">Nuevo</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Numero de Documento</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($providers as $provider)
                        <tr>
                            <td>{{ $provider->id }}</td>
                            <td>{{ $provider->name }}</td>
                            <td>{{ $provider->document }}</td>
                            <td>{{ $provider->email }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('providers.show', $provider) }}"><i
                                                class="col-1 mr-3 fas fa-eye"></i>Mostrar</a>
                                        @can('providers.edit')
                                            <a class="dropdown-item" href="{{ route('providers.edit', $provider) }}"><i
                                                    class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                                        @endcan
                                        <form action="{{ route('providers.destroy', $provider) }}" method="POST">
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
    <script>
        console.log('Hi!');
    </script>
@stop