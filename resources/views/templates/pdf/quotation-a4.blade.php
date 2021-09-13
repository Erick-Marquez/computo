@php
    $path_style = resource_path('views'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style.css');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Quotation {{ $head->document_number }}</title>
    <link href="{{ $path_style }}" rel="stylesheet" />
</head>
<body>
    <div>
        <div class="azul">
            <div >
                Logo
            </div>
            <div>
                Datos de la empresa
            </div>
            <div>
                <p>R.U.C. de la empresa</p>
                <p>COTIZACIÓN</p>
                <p>{{ str_pad($head->document_number, 8, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>
        <div>
            <p>Cliente : {{ $head->customer->name }}</p>
            <p>Num. Doc.: {{ $head->customer->document }}</p>
            <p>Dirección: {{ $head->customer->address }}</p>
        </div>
    </div>
    <div>
        <table>
            <tr>
                <th>CANTIDAD</th>
                <th>DESCRIPCIÓN</th>
                <th>PRECIO</th>
                <th>UNID/MED</th>
                <th>IMPORTE</th>
            </tr>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->product->name }}</td>
                    <td>{{ $detail->price }}</td>
                    <td>Unidades</td>
                    <td>{{ $detail->total }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div>
        <p>Total: {{ $head->total }}</p>
        <p>Vendedor: {{ $head->user->name }}</p>
    </div>
</body>
</html>