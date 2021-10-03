@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <index-branches></index-branches>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
