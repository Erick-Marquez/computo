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

        .description p {
            margin-top: 1px;
            margin-bottom: 0
        }

        .description h3 {
            margin-top: 0;
        }

        #content {
            width: 100%;
        }

        #left,
        #right {
            width: 45%;
            padding: .5em;
            background: white;
        }

        #left {
            float: left;
        }

        #right {
            float: right;
        }

        tbody {
            border-top: 1px solid gray;
            border-bottom: 1px solid gray;
        }

    </style>
</head>

<body>

    <div id="content">
        <div id="left">
            <div class="description">
                <h3>{{ $company->name }}</h3>
                <p>Reporte de apertura y cierre de: <strong> {{ $occ->cashbox->description }} </strong></p>
                <p>Fecha y Hora de apertura: <strong>{{ $occ->opening_date }}</strong> </p>
                <p>Monto de apertura: <strong>{{ $occ->opening_amount }}</strong> </p>
                <p>Fecha y Hora de cierre: <strong>{{ $occ->closing_date }}</strong> </p>
                <p>Monto de cierre: <strong>{{ $occ->closing_amount }}</strong> </p>
                <p>Cajero: <strong>{{ $occ->user->name }}</strong> </p>
            </div>

            <h5>Ingresos: </h5>
            <table style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Importe</th>
                        <th class="text-center">Tipo de pago</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($incomes))

                        @foreach ($incomes as $i)

                            <tr>
                                <td>{{ $i->observation }}</td>
                                <td>{{ $i->amount }}</td>
                                <td>{{ $i->payment_type ? $i->payment_type : 'Efectivo' }}</td>
                            </tr>

                        @endforeach
                    @else

                        <tr>
                            <td colspan="3" style="text-align:center">No hay Ingresos</td>
                        </tr>
                    @endif
                </tbody>

                <tfoot>
                    <tr>
                        <td>Total: </td>
                        <td>{{ $total['incomes'] + $total['quotations'] }}</td>
                    </tr>
                </tfoot>
            </table>
            <h5>Egresos: </h5>
            <table style="margin-bottom: 10px">
                <thead>
                    <tr>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Importe</th>
                        <th class="text-center">Tipo de pago</th>
                    </tr>

                </thead>
                <tbody>
                    @if (count($expenses))
                        @foreach ($expenses as $e)

                            <tr>
                                <td>{{ $e->observation }}</td>
                                <td>{{ $e->amount }}</td>
                                <td>{{ $e->payment_type ? $e->payment_type : 'Efectivo' }}</td>
                            </tr>

                        @endforeach
                    @else

                        <tr>
                            <td colspan="3" style="text-align:center">No hay Egresos</td>
                        </tr>
                    @endif
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
                    @if (count($salesNull))
                        @foreach ($salesNull as $sn)

                            <tr>
                                <td>{{ $sn->description }}</td>
                                <td>{{ $sn->serie }}</td>
                                <td>{{ $sn->document_number }}</td>
                                <td>{{ $sn->total }}</td>
                            </tr>

                        @endforeach
                    @else

                        <tr>
                            <td colspan="4" style="text-align:center">No hay anulaciones</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total: </td>
                        <td>{{ $total['account_to_pay'] + $total['expenses'] }}</td>
                    </tr>
                </tfoot>
            </table>
            <h5>Totales: </h5>
            <table style="margin-bottom: 10px">
                <tfoot>
                    <tr>
                        <td>Total de ingresos:</td>
                        <td>{{ $total['sales'] + $total['incomes'] + $total['quotations'] }}</td>
                    </tr>
                    <tr>
                        <td>Total de Egresos:</td>
                        <td>{{ $total['purchases'] + $total['expenses'] + $total['account_to_pay'] }}</td>
                    </tr>
                    <tr>
                        <td>Total de Efectivo:</td>
                        <td>{{ $moneyCash['sales'] + $moneyCash['incomes'] + $moneyCash['quotations'] - $moneyCash['purchases'] - $moneyCash['expenses'] - $moneyCash['account_to_pay'] }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div id="right" style="">
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
            <table style="margin-top: 1em">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">Compras</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Total:</td>
                        <td>{{ $occ->purchases()->where('is_credit', false)->sum('total') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
