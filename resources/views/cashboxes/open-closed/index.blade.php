@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cajas y aperturas</h1>
    @if (session('status'))
        <div class="alert bg-danger">
            {{ session('status') }}
        </div>
    @endif
@stop

@section('content')
    <index-cashboxes />
@stop

@section('css')
@stop

@section('js')
    <script>
    </script>
@stop
