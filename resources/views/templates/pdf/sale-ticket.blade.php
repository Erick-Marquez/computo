@php
    $path_style = resource_path('views'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style-sale-ticket.css');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ $path_style }}" rel="stylesheet" />
    <title>{{ $head->serie->voucherType->description }} {{ $head->serie->serie }}-{{ str_pad($head->document_number, 4, '0', STR_PAD_LEFT) }}</title>
</head>
<style>
    @page { 
        margin:10px 4px;
        /* margin: 0; */
    }
</style>
<body>
  <div class="logo">
    <img src="storage/logo.jpg" alt="este es el logo del negocio">
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
                <th>{{ $head->serie->voucherType->description }}</th>
            </tr>
            <tr>
                <th>{{ $head->serie->serie }} - {{ str_pad($head->document_number, 4, '0', STR_PAD_LEFT) }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="bold">Fecha de Emisión: </span>{{ $head->created_at }}</td>
            </tr>
            <tr>
                <td><span class="bold">Cliente:  </span>{{ $head->customer->name }}</td>
            </tr>
            <tr>
                @if ($head->customer->identificationDocument->id == 1)
                    <td><span class="bold">DNI:  </span>{{ $head->customer->document }}</td>
                @elseif ($head->customer->identificationDocument->id == 6)
                    
                    <td><span class="bold">RUC:  </span>{{ $head->customer->document }}</td>
                @endif

            </tr>
            <tr>
                <td><span class="bold">Direc.: </span>{{ $head->customer->address }}</td>
            </tr>
            <tr>
                <td><span class="bold">Forma de Pago: </span>{{ $head->paymentType->description }}</td>
            </tr>
            <tr>
                <td><span class="bold">Fecha Vencimiento: </span>{{ $head->date_due }}</td>
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
        @foreach ($details as $detail)
            <tr>
                <td><span>[{{ $detail->quantity }}]</span> {{ $detail->branchProduct->product->name  }}</td>
                <td>S/. {{ round($detail->price, 3) }}</td>
                <td>S/. {{ round($detail->total, 3) }}</td>
            </tr>
            @php
                $discount += $detail->discount;
            @endphp
        @endforeach
    </tbody>
  </table>
  <div class="hr"></div>
  <table class="price">
    <tbody>
        @if ($head->discount > 0)
            <tr>
                <td><span class="bold">Descuento Global: </span> S/. {{ round($head->discount, 3) }}</td>
            </tr>
        @endif
        @if ($discount > 0)
            <tr>
                <td><span class="bold">Descuento por Item: </span> S/. {{ round($discount, 3) }}</td>
            </tr>
        @endif
        @if ($head->total_taxed > 0)
            <tr>
                <td><span class="bold">Gravado: </span> S/. {{ round($head->total_taxed, 3) }}</td>
            </tr>
        @endif
        @if ($head->total_exonerated > 0)
            <tr>
                <td><span class="bold">Exonerado: </span> S/. {{ round($head->total_exonerated, 3) }}</td>
            </tr>
        @endif
        @if ($head->total_unaffected > 0)
            <tr>
                <td><span class="bold">Inafecto: </span> S/. {{ round($head->total_unaffected, 3) }}</td>
            </tr>
        @endif
        @if ($head->total_free > 0)
            <tr>
                <td><span class="bold">Gratuita: </span> S/. {{ round($head->total_free, 3) }}</td>
            </tr>
        @endif
        @if ($head->total_igv > 0)
            <tr>
                <td><span class="bold">Igv (18%): </span> S/. {{ round($head->total_igv, 3) }}</td>
            </tr>
        @endif
        <tr>
            <td><span class="bold">Total: </span> S/. {{ round($head->total - $head->discount, 3) }}</td>
        </tr>
    </tbody>
  </table>
  <div class="hr"></div>
  <p><span class="bold">IMPORTE EN LETRAS: </span>{{ \App\Services\NumberLetterService::convert($head->total, 'SOLES') }}</p>
  <p><span class="bold">FORMA DE PAGO: </span>{{ $head->paymentType->description }} (Contado)</p>
    <div>
        <img src="data:image/png;base64, {{ $qr }}" class="qr"/>
    </div>
</body>
</html>