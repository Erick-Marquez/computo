@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Cotización</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('quotations.store') }}">
                @csrf
                <div class="form-group">
                    <label for="customer_id" class="font-weight-normal">Cliente</label>
                    <select class="form-control customer" id="customer_id" name="customer_id">
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->document }} - {{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="observation" class="font-weight-normal">Observación</label>
                    <input type="text" class="form-control" id="observation" name="observation" placeholder="Observación" required autocomplete="off">
                </div>

                

                @livewire('product-search-quotation') 


                <button type="submit" class="btn btn-primary">Guardar</button>

                {{-- <div x-data="data()">
                    <label for="customer" class="font-weight-normal">Buscar Clientes</label>
                        <input type="text" class="form-control" placeholder="Buscar clientes" 
                        required autocomplete="off" id="customer" x-model="cliente" @keyup="myFunction()"
                        >
                    <ul >

                        <template x-for="customer in customers" :key="customer.id">
                            <li x-text="customer.name"></li>
                            <li x-text="customer.document"></li>
                        </template>
                    </ul>


                </div> --}}

            </form>
        </div>
    </div>
    {{-- <script>
        function data(){
            return {
                customers: {!! json_encode($customers) !!},
                customersBackup : {!! json_encode($customers) !!},
                cliente: null,
                myFunction: function (){

                    let customerFil = this.customersBackup.filter( customers =>
                        (customers.name.toLowerCase().indexOf(this.cliente) !== -1) ||
                        (customers.document.toLowerCase().indexOf(this.cliente) !== -1)
                    )
                    this.customers = customerFil
                    
                }

            }
        }
    </script> --}}
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
            $('.customer').select2({
                placeholder: "Selecciona un cliente",
            });
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
