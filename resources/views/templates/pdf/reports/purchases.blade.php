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
                        </strong>{{ is_null($filters['provider_id']) ? 'TODOS' : $filters['provider_id'] }}</p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Tipo de comprobante:
                        </strong>{{ is_null($filters['document_type']) ? 'TODOS' : $filters['document_type'] }}
                    </p>
                </td>
            </tr>

        </table>
    </div>
    @if (count($purchases))
        <div class="">
            <div class=" ">
                <table class="">
                    <thead>
                        <tr>
                            <th colspan="4">DATOS DE COMPROBANTE</th>
                            <th colspan="3">INFORMACIÓN PROVEEDOR</th>
                            <th colspan="5">IMPORTES DE LA OPERACIÓN</th>
                        </tr>
                        <tr>
                            <th>F. DE EMISIÓN</th>
                            <th>TIPO DOC</th>
                            <th>SERIE</th>
                            <th>NUMERO</th>

                            <th>T. DOC</th>
                            <th>NUMERO</th>
                            <th>RAZON SOCIAL</th>

                            <th>OP. GRAVADA</th>
                            <th>IGV</th>
                            <th>TOTAL</th>
                            <th>MONEDA</th>
                            <th>T.C</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="celda">1</td>
                            <td class="celda">Compras</td>
                            <td class="celda">{{ $purchases }}</td>
                        </tr> --}}

                        @foreach ($purchases as $purchase)
                            <tr>
                                <td class="celda">{{ $purchase->date_issue }}</td>
                                <td class="celda">{{ $purchase->document_type }}</td>
                                <td class="celda">{{ $purchase->serie }}</td>
                                <td class="celda">{{ $purchase->document_number }}</td>

                                <td class="celda">
                                     {{ $purchase->provider_document_type }}
                                </td>
                                <td class="celda">{{ $purchase->provider_document }}</td>
                                <td class="celda">{{ $purchase->provider_name }}</td>

                                <td class="celda">{{ $purchase->subtotal }}</td>
                                <td class="celda">{{ $purchase->total_igv }}</td>
                                <td class="celda">{{ $purchase->total }}</td>
                                <td class="celda">{{ $purchase->handles_exchange_rate ? 'USD' : 'PEN' }}</td>
                                <td class="celda">{{ $purchase->exchange_rate }}</td>
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
