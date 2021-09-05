@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Proveedor</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('providers.update', $provider) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="name" class="font-weight-normal">Nombre Completo</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre Completo" value="{{ $provider->name }}" required>
                </div>
                <div class="form-group">
                    <label for="comercial_name" class="font-weight-normal">Nombre Comercial</label>
                    <input type="text" class="form-control" id="comercial_name" name="comercial_name" placeholder="Nombre Comercial" value="{{ $provider->comercial_name }}" required>
                </div>
                <div class="form-group">
                    <label for="identification_document_id" class="font-weight-normal">Tipo de Documento</label>
                    <select class="form-control identification_document" id="identification_document_id" name="identification_document_id">
                        @foreach ($identification_documents as $identification_document)
                            <option value="{{ $identification_document->id }}"
                                @if ($identification_document->id == $provider->identification_document_id)
                                    selected="selected"
                                @endif
                            >{{ $identification_document->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="document" class="font-weight-normal">Número de Documento</label>
                    <input type="text" class="form-control" id="document" name="document" placeholder="Número de Documento" value="{{ $provider->document }}" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="font-weight-normal">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono" value="{{ $provider->phone }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="font-weight-normal">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $provider->email }}" required>
                </div>
                <div class="form-group">
                    <label for="address" class="font-weight-normal">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Dirección" value="{{ $provider->address }}" required>
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
        $(document).ready(function() {
            $('.identification_document').select2();
        });
    </script>
@stop