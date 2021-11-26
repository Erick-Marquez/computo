@extends('adminlte::page')

@section('content')
    <div id="app">
        @yield('content-vue')
    </div>
@endsection

@section('css')
@stop

@section('js')

    <script src="{{ mix('js/app.js') }}"></script>

    <script>
        @auth
            window.Permissions = {!! json_encode(Auth::user()->allPermissions, true) !!};
        @else
            window.Permissions = [];
        @endauth
    </script>
@stop