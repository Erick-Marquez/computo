@php
    $path_style = resource_path('views'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'cashbox-movements'.DIRECTORY_SEPARATOR.'style-cashbox-movements-ticket.css');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ $path_style }}" rel="stylesheet" />
    <title></title>
</head>
<style>
    @page {
        margin:10px 4px;
        /* margin: 0; */
    }
</style>
<body>
    <div class="logo">
        <img src="images/Logo.png" alt="este es el logo del negocio">
    </div>
    <table class="header">
        <tr>
            <td>{{ $company->name }}</td>
        </tr>
        <tr>
            <td>R.U.C.: {{ $company->ruc }}</td>
        </tr>
        <tr class="header--size-little">
            <td>{{ $company->address }}</td>
        </tr>
        <tr class="header--size-little">
            <td>Huanuco, Huanuco, Huanuco</td>
        </tr>
        <tr class="header--size-little">
        <i class="fab fa-accessible-icon"></i>
            <td>Telf.: {{ $company->phone }}</td>
        </tr>
        <tr class="header--size-little">
            <td>Email: {{ $company->email }}</td>
        </tr>
    </table>

    <table class="invoice">
        <thead>
            <tr>
                <th>
                    <div class="tittle">
                        <div>RECIBO INTERNO DE {{ $detail->type }}</div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="bold">Cajero: </span>{{ $detail->openClosedCashbox->user->name }}</td>
            </tr>
            <tr>
                <td><span class="bold">Fecha: </span>{{ date_format($detail->created_at, 'd-m-Y / H:i:s') }}</td>
            </tr>

            @if ($detail->type == 'REMUNERACION')
            <tr>
                <td><span class="bold">Motivo:  </span>{{ substr($detail->observation,strpos($detail->observation, '-') + 1) }}</td>
            </tr>
            <tr>
                <td><span class="bold">Personal:  </span>{{ $detail->user->name }}</td>
            </tr>
            @else
            <tr>
                <td><span class="bold">Motivo:  </span>{{ $detail->observation }}</td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="hr"></div>

    <table class="sale">
        <thead>
            <tr>
                <th>Precio</th>
                <th>Tipo de pago</th>
            </tr>
        </thead>
        <tbody>

            <td>{{ $detail->amount }}</td>
            <td>{{ $detail->paymentType->description }}</td>

        </tbody>
    </table>

    <div class="hr"></div>

    <table class="price">
        <tbody>
            <tr>
                <td>
                    <span class="bold">Total: </span> S/. {{ round($detail->amount, 2) }}
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
