@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Linea</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('lines.update', $line) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="cod" class="font-weight-normal">Código</label>
                    <input type="text" class="form-control" id="cod" name="cod" placeholder="Código" value="{{ $line->cod }}" required>
                </div>
                <div class="form-group">
                    <label for="description" class="font-weight-normal">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="{{ $line->description }}" required>
                </div>
                <div class="form-group">
                    <label for="family_id" class="font-weight-normal">Familia</label>
                    <select class="form-control family" id="family_id" name="family_id">
                        @foreach ($families as $family)
                            <option value="{{ $family->id }}" 
                                @if ($family->id == $line->family_id)
                                    selected="selected"
                                @endif
                            >{{ $family->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id" class="font-weight-normal">Marcas</label>
                    <select class="form-control brand" id="brand_id" name="brand_id[]" multiple="multiple">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" 
                                @foreach ($line->brands as $item)
                                    @if ($item->id == $brand->id)
                                        selected="selected"
                                    @else
                                        
                                    @endif
                                @endforeach
                            >{{ $brand->description }}</option>
                        @endforeach
                    </select>
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
            $('.family').select2();
        });

        $(document).ready(function() {
            $('.brand').select2();
        });
    </script>
@stop