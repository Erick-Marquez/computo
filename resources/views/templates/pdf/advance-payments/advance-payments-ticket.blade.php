@php
    $path_style = resource_path('views'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'advance-payments'.DIRECTORY_SEPARATOR.'style-advance-payment-ticket.css');
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
                        <div>RECIBO INTERNO DE INGRESO</div>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="bold">Cotización: </span>{{ $advancePayment->quotation->serie->serie }} - {{ str_pad($advancePayment->quotation->document_number, 4, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td><span class="bold">Fecha: </span>{{ date_format($advancePayment->created_at, 'd-m-Y / H:i:s') }}</td>
            </tr>
            <tr>
                <td><span class="bold">Cliente:  </span>{{ $advancePayment->quotation->customer->name }}</td>
            </tr>
            <tr>
                <td><span class="bold">{{ $advancePayment->quotation->customer->identificationDocument->description }}:  </span>{{ $advancePayment->quotation->customer->document }}</td>
            </tr>
            <tr>
                <td><span class="bold">Direc.: </span>{{ $advancePayment->quotation->customer->address }}</td>
            </tr>
        </tbody>
    </table>

    <div class="hr"></div>

    <table class="sale">
        <thead>
            <tr>
                <th>[Cant] Descripción </th>
                <th>Precio</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
    
            @php
                $discount = 0;
            @endphp
    
            @foreach ($advancePayment->quotation->quotationDetails as $detail)
    
                @if ($detail->discount > 0)
                    <tr>
                        <td>
                            <span style="font-size: 0.6rem; vertical-align: middle">[{{ $detail->quantity }}]</span> {{ $detail->branchProduct->product->name  }}
                            <br>
                            <span style="font-size: 0.6rem; vertical-align: middle; color: white;">[{{ $detail->quantity }}]</span> Descuento</span>
                        </td>
                        <td>
                            S/. {{ round($detail->price, 2) }}
                            <br>
                            S/. {{ round($detail->discount, 2) }}
                        </td>
                        <td>
                            S/. {{ round($detail->total, 2) }}
                            <br>
                            &nbsp;
                        </td>
                    </tr> 
                @else
                    
                    <tr>
                        <td>
                            <span style="font-size: 0.6rem; vertical-align: middle">[{{ $detail->quantity }}]</span> {{ $detail->branchProduct->product->name  }}
                        </td>
                        <td>S/. {{ round($detail->price, 2) }}</td>
                        <td>S/. {{ round($detail->total, 2) }}</td>
                    </tr>
    
                @endif
    
                @php
                    $discount += $detail->discount;
                @endphp
    
            @endforeach
    
        </tbody>
    </table>

    <div class="hr"></div>

    <table class="price">
        <tbody>
            <tr>
                <td><span class="bold">Adelanto: </span> S/. {{ round($advancePayment->amount, 2) }}</td>
            </tr>
            <tr>
                <td><span class="bold">Total: </span> S/. {{ round($advancePayment->quotation->total - $advancePayment->quotation->discount, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>