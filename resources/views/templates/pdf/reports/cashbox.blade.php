<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de APERTURA Y CIERRE</title>
    <style>
        * {
            font-family: sans-serif;
        }

        .cabecera {
            margin-top: 1.5em;
        }

        .header {
            display: inline-block;
            width: 40%;
        }


        .header.left {
            margin-left: 1em;
            padding-left: 6.5em
        }

        .header p {
            font-size: 14px;
            margin: 0;
            margin-bottom: 2px;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;

        }

        .text-center {
            text-align: center;
        }

        table {
            font-size: 14px
        }

        table tfoot {
            border-top: .5px solid gray
        }

        .cuerpo {}

        h5 {
            margin: 0;
        }

    </style>
</head>

<body>

    <div class="cabecera">
        <div class="header">
            <h3>{{ $company->name }}</h3>
            <p>Reporte de apertura y cierre de: <strong> {{ $occ->cashbox->description }} </strong></p>
            <p>Fecha y Hora de apertura: <strong>{{ $occ->opening_date }}</strong> </p>
            <p>Monto de apertura: <strong>{{ $occ->opening_amount }}</strong> </p>
            <p>Fecha y Hora de cierre: <strong>{{ $occ->closing_date }}</strong> </p>
            <p>Monto de cierre: <strong>{{ $occ->closing_amount }}</strong> </p>
            <p>Cajero: <strong>{{ $occ->user->name }}</strong> </p>
        </div>
        <div class="header left">
            <table>
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Venta</th>
                    </tr>
                    <tr>
                        <th class="text-right">Medio de pago</th>
                        <th class="text-left">Importe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesPayment as $sp)
                        <tr>
                            <td class="text-right" style="padding: 2px">{{ $sp->description }}</td>
                            <td class="text-center" style="padding: 2px">{{ $sp->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="text-right"> TOTAL: </td>
                        <td class="text-center"> {{ $occ->sales()->sum('total') }} </td>
                    </tr>
                    <tr>
                        <td class="text-right"> SUBTOTAL: </td>
                        <td class="text-center"> {{ $occ->sales()->sum('subtotal') }} </td>
                    </tr>
                    <tr>
                        <td class="text-right"> IGV: </td>
                        <td class="text-center"> {{ $occ->sales()->sum('total_igv') }} </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="cuerpo">
        <h5>Ingresos: </h5>
        <table style="margin-bottom: 10px">
            <thead>
                <tr>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($incomes as $i)

                    <tr>
                        <td>{{ $i->observation }}</td>
                        <td>{{ $i->amount }}</td>
                    </tr>

                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td>Total: </td>
                    <td>{{ $total['incomes'] }}</td>
                </tr>
            </tfoot>
        </table>
        <h5>Egresos: </h5>
        <table style="margin-bottom: 10px">
            <thead>
                <tr>
                    <th class="text-center">Descripcion</th>
                    <th class="text-center">Importe</th>
                </tr>

            </thead>
            <tbody>
                @foreach ($expenses as $e)

                    <tr>
                        <td>{{ $e->observation }}</td>
                        <td>{{ $e->amount }}</td>
                    </tr>

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>Total: </td>
                    <td>{{ $total['account_to_pay'] + $total['expenses'] }}</td>
                </tr>
            </tfoot>
        </table>
        <h5>Anulados: </h5>
        <table style="margin-bottom: 10px">
            <thead>
                <tr>
                    <th class="text-center">Tipo</th>
                    <th class="text-center">Serie</th>
                    <th class="text-center">N° doc</th>
                    <th class="text-center">Importe</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td>Total: </td>
                    <td>{{ $total['account_to_pay'] + $total['expenses'] }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
