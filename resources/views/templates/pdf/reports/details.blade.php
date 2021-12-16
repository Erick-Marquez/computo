{{-- @php

$establishment = $cash->user->establishment;

@endphp --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Reporte POS - {{ $cash->user->name }} - {{ $cash->date_opening }} {{ $cash->time_opening }}</title> --}}
    <title>Reporte de ventas</title>
    <style>
        html {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-spacing: 0;
            border: 1px solid black;
        }

        .celda {
            text-align: center;
            padding: 5px;
            border: 0.1px solid black;
        }

        th {
            padding: 5px;
            text-align: center;
            border-color: #0088cc;
            border: 0.1px solid black;
        }

        .title {
            font-weight: bold;
            padding: 5px;
            font-size: 20px !important;
            text-decoration: underline;
        }

        p>strong {
            margin-left: 5px;
            font-size: 12px;
        }

        thead {
            font-weight: bold;
            background: #0088cc;
            color: white;
            text-align: center;
        }

    </style>
</head>

<body>
    <div>
        <p align="center" class="title"><strong>Reporte de Ventas</strong></p>
    </div>
    <div style="margin-top:20px; margin-bottom:20px;">
        <table style="padding-left:9em; border: 0">
            <tr>
                <td class="width-custom">
                    <p><strong>Desde: </strong> {{ $filters['fromDate'] }}</p>
                </td>
                <td class="width-custom">
                    <p><strong>Hasta: </strong>{{ $filters['untilDate'] }}</p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Sucursal:
                        </strong>{{ is_null($filters['branch_id']) ? 'TODOS' : $filters['branch_id'] }}</p>
                </td>
                <td class="td-custom">
                    <p><strong>Clientes:
                        </strong>{{ is_null($filters['customer_id']) ? 'TODOS' : $filters['customer_id'] }}</p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Producto:
                        </strong>{{ is_null($filters['product_id']) ? 'TODOS' : $filters['product_id'] }}</p>
                </td>
            </tr>

        </table>
    </div>
    @if (count($sales))
        <div class="">
            <div class=" ">
                <table class="">
                    <thead>
                        <tr>
                            <th>FECHA</th>
                            <th>COMPROBANTE</th>
                            <th>SERIE</th>
                            <th>COD</th>
                            <th>PRODUCTO</th>
                            <th>MARCA</th>
                            <th>LINEA</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>DESC.</th>
                            <th>IGV</th>
                            <th>OP. GRAVADA</th>
                            <th>TOTAL</th>
                            <th>SERIES</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="celda">1</td>
                            <td class="celda">Compras</td>
                            <td class="celda">{{ $purchases }}</td>
                        </tr> --}}

                        @foreach ($sales as $sale)
                            <tr>
                                <td class="celda">{{ $sale->date }}</td>
                                <td class="celda">{{ $sale->voucher_type }}</td>
                                <td class="celda">{{ $sale->serie }} - {{ $sale->document_number }}</td>
                                <td class="celda">{{ $sale->cod }}</td>
                                <td class="celda">{{ $sale->name }}</td>

                                <td class="celda">
                                    {{ $sale->brand }}
                                </td>
                                <td class="celda">{{ $sale->line }}</td>
                                <td class="celda">{{ $sale->price }}</td>

                                <td class="celda">{{ $sale->quantity }}</td>
                                <td class="celda">{{ $sale->discount }}</td>
                                <td class="celda">{{ $sale->total_igv }}</td>
                                <td class="celda">{{ $sale->subtotal }}</td>
                                <td class="celda">{{ $sale->total }}</td>
                                <td class="celda">{{ $sale->series }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="callout callout-info">
            <p>No se encontraron registros.</p>
        </div>
    @endif
</body>

</html>
