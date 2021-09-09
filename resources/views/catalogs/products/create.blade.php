@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Producto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="form-group">
                    <label for="cod" class="font-weight-normal">Código</label>
                    <input type="text" class="form-control" id="cod" name="cod" placeholder="Código" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="name" class="font-weight-normal">Nombre del producto</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del producto" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="description" class="font-weight-normal">Descripción</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descripción" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="cost" class="font-weight-normal">Costo Referencial</label>
                    <input type="text" class="form-control" id="cost" name="cost" placeholder="Costo Referencial" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="price" class="font-weight-normal">Precio Referencial</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Precio Referencial" required autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="line_id" class="font-weight-normal">Linea</label>
                    <select class="form-control line" id="line_id" name="line_id">
                        @foreach ($lines as $line)
                            <option value="{{ $line->id }}">{{ $line->description }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id" class="font-weight-normal">Marca</label>
                    <select class="form-control brand" id="brand_id" name="brand_id">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->description }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="font-weight-normal">Maneja Series:</label>
                    <div class="custom-control custom-switch custom-switch-on-success">
                        <input class="custom-control-input" type="checkbox" id="manage_series" value="1" name="manage_series">
                        <label class="custom-control-label" for="manage_series">
                            Si
                        </label>
                    </div>              
                </div>

                <div class="form-group">
                    <label class="font-weight-normal">Sucursales:</label>
                    @foreach ($branches as $branch)
                        <div class="custom-control custom-switch custom-switch-on-success">
                            <input class="custom-control-input" type="checkbox" id="{{ $branch->description }}" value="{{ $branch->id }}" name="branches[]">
                            <label class="custom-control-label" for="{{ $branch->description }}">
                                {{ $branch->description }}
                            </label>
                        </div>      
                    @endforeach          
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
