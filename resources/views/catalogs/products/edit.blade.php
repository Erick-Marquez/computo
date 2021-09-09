@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('products.update', $product) }}">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="cod" class="font-weight-normal">Código</label>
                    <input type="text" class="form-control" id="cod" name="cod" placeholder="Código" value="{{ $product->cod }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="name" class="font-weight-normal">Nombre del producto</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del producto" value="{{ $product->name }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="description" class="font-weight-normal">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" value="{{ $product->description }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="price" class="font-weight-normal">Precio Referencial</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Precio Referencial" value="{{ $product->price }}" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="line_id" class="font-weight-normal">Linea</label>
                    <select class="form-control line" id="line_id" name="line_id">
                        @foreach ($lines as $line)
                            <option value="{{ $line->id }}"
                                @if ($line->id == $product->brandLine->line->id)
                                    selected="selected"
                                @endif 
                            >{{ $line->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id" class="font-weight-normal">Marca</label>
                    <select class="form-control brand" id="brand_id" name="brand_id">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}"
                                @if ($brand->id == $product->brandLine->brand->id)
                                    selected="selected"
                                @endif    
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
            $('.line').select2();
        });

        $(document).ready(function() {
            $('.brand').select2();
        });
    </script>
@stop
