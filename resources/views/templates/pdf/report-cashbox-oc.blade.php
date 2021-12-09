{{-- @php

$establishment = $cash->user->establishment;

@endphp --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Reporte POS - {{ $cash->user->name }} - {{ $cash->date_opening }} {{ $cash->time_opening }}</title> --}}
    <title>Reporte de cierre - {{ $cashbox->description }}</title>
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
        <p align="center" class="title"><strong>Reporte de Cierre de caja</strong></p>
    </div>
    <div style="margin-top:20px; margin-bottom:20px;">
        <table style="padding-left:9em; border: 0">
            <tr>
                <td class="width-custom">
                    <p><strong>Empresa: </strong> {{ $company->name }}</p>
                </td>
                <td class="width-custom">
                    <p><strong>Fecha y hora apertura: </strong>{{ $occ->opening_date }}</p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Ruc: </strong>{{ $company->ruc }}</p>
                </td>
                <td class="td-custom">
                    <p><strong>Monto de apertura: </strong>{{ $occ->opening_amount }}</p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Nombre de Caja: </strong>{{ $occ->cashbox->description }}</p>
                </td>
                <td class="td-custom">
                    <p><strong>Fecha y hora cierre: </strong>{{ $occ->closing_date }}</p>
                </td>
            </tr>

            <tr>
                <td class="td-custom">
                    <p><strong>Cajero: </strong>{{ $occ->user->name }}</p>
                </td>
                <td colspan="2" class="td-custom">
                    <p><strong>Monto de cierre: </strong>{{ $occ->closing_amount }}</p>
                </td>
            </tr>


        </table>
    </div>
    @if (count($movements))
        <div class="">
            <div class=" ">
                <table class="">
                    <thead>
                        <tr>
                            <th>Descripcion</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="celda">1</td>
                            <td class="celda">Compras</td>
                            <td class="celda">{{ $purchases }}</td>
                        </tr> --}}

                        @foreach ($movements as $key => $item)
                            <tr>
                                <td class="celda">{{ $key }} </td>
                                <td class="celda">{{ $item }} </td>
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

    <br><br>

    <div class="">
        <div class=" ">
            <table class="">
                <thead>
                    <tr>
                        <th colspan="5">
                            VENTAS
                        </th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Serie</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($salesDetails as $item)
                        <tr>
                            <td class="celda">{{ $loop->iteration }}</td>
                            <td class="celda">{{ $item->created_at }}</td>
                            <td class="celda">{{ $item->description }}</td>
                            <td class="celda">{{ $item->serie }} - {{ $item->document_number }}</td>
                            <td class="celda">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <div class="">
        <div class=" ">
            <table class="">
                <thead>
                    <tr>
                        <th colspan="7">
                            COMPRAS
                        </th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Proveedor</th>
                        <th>Descripcion</th>
                        <th>Serie</th>
                        <th>Divisas</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($purchasesDetails as $item)
                        <tr>
                            <td class="celda">{{ $loop->iteration }}</td>
                            <td class="celda">{{ $item->created_at }}</td>
                            <td class="celda">{{ $item->provider->name }}</td>
                            <td class="celda">{{ $item->document_type }}</td>
                            <td class="celda">{{ $item->serie }} - {{ $item->document_number }}</td>
                            <td class="celda">
                                {{ $item->handles_exchange_rate ? 'USD' : 'PEN' }}
                                <br>
                                {{ $item->exchange_rate }}
                            </td>
                            <td class="celda">{{ $item->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <br><br>

    <div class="">
        <div class=" ">
            <table class="">
                <thead>
                    <tr>
                        <th colspan="4">
                            INGRESOS y EGRESOS
                        </th>
                    </tr>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cashboxMovements as $item)
                        <tr>
                            <td class="celda">{{ $loop->iteration }}</td>
                            <td class="celda">{{ $item->created_at }}</td>
                            <td class="celda">{{ $item->type }}</td>
                            <td class="celda">{{ $item->observation }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
