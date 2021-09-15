@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de Comprobantes</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('vouchers.create') }}">Nuevo</a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo de documento</th>
                        <th>Número de documento</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vouchers as $voucher)
                        <tr>
                            <td>{{ $voucher->date_issue }}</td>
                            <td>{{ $voucher->serie->voucherType->description }}</td>
                            <td>{{ $voucher->serie->serie }}-{{ $voucher->document_number }}</td>
                            <td>{{ $voucher->customer->name }}</td>
                            <td>{{ $voucher->total }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Acciones
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        {{-- <a class="dropdown-item" href="{{ route('vouchers.show', $voucher) }}"><i
                                                class="col-1 mr-3 fas fa-eye"></i>Mostrar</a>
                                        @can('vouchers.edit')
                                            <a class="dropdown-item" href="{{ route('vouchers.edit', $voucher) }}"><i
                                                    class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                                        @endcan --}}

                                            <a class="dropdown-item" href="{{ route('vouchers.print', ['A4' , $voucher]) }}" target="_blank">
                                                <i class="col-1 mr-3 far fa-file-pdf"></i>PDF</a>

                                            <a class="dropdown-item" href="{{ route('vouchers.print', ['TICKET' , $voucher]) }}" target="_blank">
                                                <i class="col-1 mr-3 fas fa-receipt"></i>TICKET</a>
                                            
                                            <a class="dropdown-item" href="{{ route('vouchers.print', ['WARRANTY' , $voucher]) }}" target="_blank">
                                                <i class="col-1 mr-3 fas fa-receipt"></i>Garantia</a>

                                        <form action="{{ route('vouchers.destroy', $voucher) }}" method="POST">
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