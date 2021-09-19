@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Configuraciones de PC</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('assemblies.create') }}">Nuevo</a>
        </div>
        <div class="card-body">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assemblies as $assembly)
                        <tr>
                            <td>{{ $assembly->id }}</td>
                            <td>{{ $assembly->name }}</td>
                            <td>{{ $assembly->description }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('assemblies.show', $assembly) }}"><i
                                                class="col-1 mr-3 fas fa-eye"></i>Mostrar</a>
                                        @can('assemblies.edit')
                                            <a class="dropdown-item" href="{{ route('assemblies.edit', $assembly) }}"><i
                                                    class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                                        @endcan
                                        <form action="{{ route('assemblies.destroy', $assembly) }}" method="POST">
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
            <index-assemblies></index-assemblies>
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