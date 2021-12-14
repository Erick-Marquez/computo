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
    <title>Reporte de Productos</title>
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
        <p align="center" class="title"><strong>Reporte de Productos</strong></p>
    </div>
    <div style="margin-top:20px; margin-bottom:20px;">
        <p><strong>Sucursal: </strong>{{ is_null($filters['branch_id']) ? 'TODOS' : $filters['branch_id'] }}</p>
    </div>
    @if (count($products))
        <div class="">
            <div class=" ">
                <table class="">
                    <thead>
                        <tr>
                            <th>COD</th>
                            <th>PRODUCTO</th>
                            <th>LINEA</th>
                            <th>MARCA</th>
                            <th>STOCK</th>
                            <th>PRECIO COMPRA</th>
                            <th>PRECIO 1</th>
                            <th>PRECIO 2</th>
                            <th>PRECIO 3</th>
                            <th>ACTIVO</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($products as $product)
                            <tr>
                                <td class="celda">{{ $product->cod }}</td>
                                <td class="celda">{{ $product->name }}</td>
                                <td class="celda">{{ $product->line }}</td>
                                <td class="celda">{{ $product->brand }}</td>
                                <td class="celda">{{ $product->stock }}</td>
                                <td class="celda">{{ $product->referential_purchase_price }}</td>
                                <td class="celda">{{ $product->sale_price }}</td>
                                <td class="celda">{{ $product->referential_sale_price_one }}</td>
                                <td class="celda">{{ $product->referential_sale_price_two }}</td>
                                <td class="celda">{{ $product->active ? 'SI' : 'NO' }}</td>
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
