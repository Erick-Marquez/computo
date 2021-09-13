@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Comprobante</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('vouchers.store') }}">
                @csrf
                <div class="row">
                    <div class="col form-group">
                        <label for="identification_document_id" class="font-weight-normal">Tipo de documento</label>
                        <select class="form-control select2" id="identification_document_id" name="identification_document_id">
                            @foreach ($identificationDocuments as $identificationDocument)
                                <option value="{{ $identificationDocument->id }}">{{ $identificationDocument->description }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="col form-group">
                        <label for="customer_id" class="font-weight-normal">Cliente</label>
                        <select class="form-control select2" id="customer_id" name="customer_id">
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->document }} - {{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col form-group">
                        <label for="date_issue" class="font-weight-normal">Fecha Emisión</label>
                        <input type="date" class="form-control" name="date_issue" id="date_issue" value="{{ date("Y-m-d") }}">
                    </div>

                    <div class="col form-group">
                        <label for="date_due" class="font-weight-normal">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" name="date_due" id="date_due" value="{{ date("Y-m-d") }}">
                    </div>
                </div>

                @livewire('product-search-voucher') 

                <button type="submit" class="btn btn-primary">Guardar</button>

                {{-- <div x-data="data()">
                    <label for="customer" class="font-weight-normal">Buscar Clientes</label>
                        <input type="text" class="form-control" placeholder="Buscar clientes" 
                        required autocomplete="off" id="customer" x-model="cliente" @keyup="myFunction()"
                        >
                    <ul>

                        <template x-for="customer in customers" :key="customer.id">
                            <li x-text="customer.name"></li>
                            <li x-text="customer.document"></li>
                        </template>
                    </ul>


                </div> --}}

            </form>
        </div>
    </div>
    <script>
    //     function data(){
    //         return {
    //             customers: {!! json_encode($customers) !!},
    //             customersBackup : {!! json_encode($customers) !!},
    //             cliente: null,
    //             myFunction: function (){
    //                 let customerFil = this.customersBackup.filter( customers =>
    //                     (customers.name.toLowerCase().indexOf(this.cliente) !== -1) ||
    //                     (customers.document.toLowerCase().indexOf(this.cliente) !== -1)
    //                 )
    //                 this.customers = customerFil  
    //             }
    //         }
    //     }
    // </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    
  
@stop

@section('js')
    <script>

        const customers = {!! json_encode($customers) !!}

        // const customers = {!! json_encode($customers) !!}

        // $(document).ready(function() {
        //     $('#example').DataTable();
        // } );

        $(document).ready(function() {
            $('.select2').select2();
        });
        
        // function myFunction() {
            
        //     let search = document.getElementById("customer").value.toLowerCase();

        //     let customerFil = customers.filter( customers =>
        //         (customers.name.toLowerCase().indexOf(search) !== -1) ||
        //         (customers.document.toLowerCase().indexOf(search) !== -1)
        //     )


        //     console.log(customerFil)
        // }
    </script>
@stop
