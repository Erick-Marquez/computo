@php
    $path_style = resource_path('views'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <title>{{ $purchase }} {{ $head->serie->serie }}-{{ str_pad($head->document_number, 4, '0', STR_PAD_LEFT) }}</title> --}}
    <title>{{ $purchase->document_number }}</title>
    <link href="{{ $path_style }}" rel="stylesheet" />
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="storage/logo.jpg" alt="este es el logo del negocio">
        </div>
        <div class="titular">
            <h1>{{ $company->name }}</h1>
            <p class="titular__distrito">{{ $company->address }}</p>
            <p class="titular__ciudad"></p>
            <div class="titular__elemento">
                {{-- <img src="img/phone-call.svg" alt="telefono"> --}}
                <p class="telefono__numero"> Tel: {{ $company->phone }}</p>
            </div>
            <a href="#" class="correo titular__elemento">
                {{-- <img src="img/email.svg" alt="correo"> --}}
                <p class="correo__dir">{{ $company->email }}</p>
            </a>
        </div>
        <div class="ruc">
            <p class="ruc__primero">R.U.C. {{ $company->ruc }}</p>
            <p class="ruc__segundo">{{ $purchase->document_type }}</p>
            <p class="ruc__numero">{{ $purchase->serie }}-{{ str_pad($purchase->document_number, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
    </header>
    <main>
        <div class="cliente">
            <p>Proveedor <span class="cliente__puntos">:</span>{{ $purchase->provider->name }}</p>
            <p>Num.Doc:<span class="cliente__puntos">:</span>{{ $purchase->provider->document }}</p>
            <p>Direccion<span class="cliente__puntos">:</span>{{ $purchase->provider->address }}</p>
        </div>
        <table class="descripcion">
            <thead>
                <tr>
                    <td>FECHA DE EMISIÓN</td>
                    <td>CONDICIÓN DE PAGO</td>
                    <td>TIPO DE MONEDA</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $purchase->date_issue }}</td>
                    <td>EFECTIVO</td>
                    <td>Soles</td>
                </tr>
            </tbody>
        </table>
        <table class="pagar">
            <thead>
                <tr>
                    <td>CANT.</td>
                    <td>DESCRIPCIÓN</td>
                    <td>PRECIO</td>
                    <td>UNID/MED</td>
                    <td>AFECT.IGV</td>
                    <td>IMPORTE</td>
                </tr>
            </thead>
            <tbody class="detalle">
                @foreach ($purchase->purchaseDetails as $detail)
                    <tr>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->branchProduct->product->name }} - Series:
                            @foreach ($detail->series as $serie)
                                ({{ $serie }})
                            @endforeach
                        </td>
                        <td>{{ $purchase->handles_exchange_rate ? '$' : 'S/'}} {{ $detail->price }}</td>
                        <td>UNIDADES</td>
                        <td>Exonerado</td>
                        <td>{{ $purchase->handles_exchange_rate ? '$' : 'S/'}} {{ $detail->total }}</td>
                    </tr>
                @endforeach
                <tr class="tfood">
                    <td colspan="6"> SON {{ \App\Services\NumberLetterService::convert($purchase->total, 'SOLES') }}</td>
                </tr>
            </tbody>
        </table>
        <table class="transaccion">
            <tr>
                <td>
                    <div class="resumen">
                        <p>RESUMEN:</p>
                        <div class="resumen__elemento">
                            <p>IGV (18.00%):</p>
                            <p class="igv__precio">{{ $purchase->handles_exchange_rate ? '$' : 'S/'}} {{ $purchase->total_igv }}</p>
                        </div>
                        <div class="resumen__elemento">
                            <p>Total:</p>
                            <p class="total__precio">{{ $purchase->handles_exchange_rate ? '$' : 'S/'}} {{ $purchase->total }}</p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="observacion">
                <td colspan="3">
                    <p><span>Observación: </span>{{$purchase->observation }}</p>
                </td>
            </tr>
        </table>
    </main>
</body>
</html>
