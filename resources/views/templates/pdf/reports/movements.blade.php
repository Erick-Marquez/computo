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
    <title>Reporte de Movimientos</title>
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
        <p align="center" class="title"><strong>Reporte de Movimientos</strong></p>
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

            {{-- <tr>
                <td class="td-custom">
                    <p><strong>Sucursal: </strong>{{ is_null($filters['branch_id']) ? 'TODOS' : $filters['branch_id'] }}</p>
                </td>
                <td class="td-custom">
                    <p><strong>Clientes: </strong>{{ is_null($filters['cashbox_id']) ? 'TODOS' : $filters['cashbox_id'] }}</p>
                </td>
            </tr> --}}

            <tr>
                <td class="td-custom">
                    <p><strong>Tipo de movimiento:
                        </strong>{{ is_null($filters['movement_type']) ? 'TODOS' : $filters['movement_type'] }}</p>
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
                            <th>Fecha y Hora</th>
                            <th>Concepto</th>
                            <th>Tipo de pago</th>
                            <th>Observación</th>
                            <th>Monto</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($movements as $mov)
                            <tr>
                                <td class="celda">{{ $mov->created_at }}</td>
                                <td class="celda">{{ $mov->type }}

                                    <br>
                                    {{ $mov->user_name }}</td>
                                <td class="celda">{{ $mov->payment_type }}</td>
                                <td class="celda">
                                    {{ $mov->observation }}
                                </td>
                                <td class="celda">S/.{{ $mov->amount }}</td>
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
