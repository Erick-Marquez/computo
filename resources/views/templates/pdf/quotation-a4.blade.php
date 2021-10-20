@php
    $path_style = resource_path('views'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cotizacion {{ $head->document_number }}</title>
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
            <p class="ruc__segundo">COTIZACIÓN</p>
            <p class="ruc__numero">{{ str_pad($head->document_number, 8, '0', STR_PAD_LEFT) }}</p>
        </div>
    </header>
    <main>
        <div class="cliente">
            <p>Cliente <span class="cliente__puntos">:</span>{{ $head->customer->name }}</p>
            <p>Num.Doc:<span class="cliente__puntos">:</span>{{ $head->customer->document }}</p>
            <p>Direccion<span class="cliente__puntos">:</span>{{ $head->customer->address }}</p>
        </div>
        <table class="descripcion">
            <thead>
                <tr>
                    <td>FECHA DE EMISIÓN</td>
                    <td>CONDICIÓN DE PAGO</td>
                    <td>TIPO DE MONEDA</td>
                    <td>VALIDO HASTA</td>
                    {{-- <td>ORDEN DE COMPRA</td> --}}
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $head->created_at }}</td>
                    <td>EFECTIVO</td>
                    <td>Soles</td>
                    <td></td>
                    {{-- <td></td> --}}
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
                @foreach ($details as $detail)
                    <tr>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->branchProduct->product->name  }}</td>
                        <td>S/ {{ $detail->price }}</td>
                        <td>UNIDADES</td>
                        <td>Exonerado</td>
                        <td>S/ {{ $detail->total }}</td>
                    </tr>
                @endforeach
                <tr class="tfood">
                    <td colspan="6">SON {{ \App\Services\NumberLetterService::convert($head->total, 'SOLES') }}</td>
                </tr>
            </tbody>
        </table>
        <table class="transaccion">
            <tr>
                <td>
                    <div class="escaner">
                        <div class="escaner__img">
                            <img src="data:image/png;base64, {{ $qr }}"/>
                        </div>
                    </div>  
                </td>
                <td>
                    <div class="compra__texto">
                        <p class="compra__vendedor">VENDEDOR: {{ $head->user->name }}</p>
                    </div>
                </td>
                <td>
                    <div class="resumen">
                        <p>RESUMEN:</p>
                        <div class="resumen__elemento">
                            <p>Gravada:</p>
                            <p class="gravada__precio">S/ 0.000</p>
                        </div>
                        <div class="resumen__elemento">
                            <p>Exonerado:</p>
                            <p class="exonerado__precio">S/ 0.000</p>
                        </div>
                        <div class="resumen__elemento">
                            <p>IGV (18.00%):</p>
                            <p class="igv__precio">S/ 0.000</p>
                        </div>
                        <div class="resumen__elemento">
                            <p>Descuento Total:</p>
                            <p class="descuento__precio">S/ {{ $head->discount }}</p>
                        </div>
                        <div class="resumen__elemento">
                            <p>Total:</p>
                            <p class="total__precio">S/ {{ $head->total }}</p>
                        </div>
                    </div>
                </td>
            </tr>
            <tr class="observacion">
                <td colspan="3">
                    <p><span>Observación: </span>{{$head->observation }}</p>
                </td>
            </tr>
        </table>
    </main>
</html>