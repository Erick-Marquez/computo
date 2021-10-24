@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cajas y aperturas</h1>
    @if (session('status'))
        <input id="isCashboxOpening" type="hidden" name="" value="{{ session('status') }}">
    @endif
@stop

@section('content')
    <index-cashboxes />
@stop

@section('css')
@stop

@section('js')
    <script>
        let ico = document.getElementById('isCashboxOpening');
        if (ico !== null) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: ico.value,
            })
        }
    </script>
@stop
