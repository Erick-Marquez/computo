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
                <th>{{ mb_strtoupper($head->serie->voucherType->description, 'UTF-8') }}</th>
            </tr>
            <tr>
                <th>{{ $head->serie->serie }} - {{ str_pad($head->document_number, 4, '0', STR_PAD_LEFT) }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><span class="bold">Fecha de Emisión: </span>{{ date_format($head->created_at, 'd-m-Y H:i:s') }}</td>
            </tr>
            <tr>
                <td><span class="bold">Cliente:  </span>{{ $head->customer->name }}</td>
            </tr>
            <tr>
                <td><span class="bold">{{ $head->customer->identificationDocument->description }}:  </span>{{ $head->customer->document }}</td>
            </tr>
            <tr>
                <td><span class="bold">Direc.: </span>{{ $head->customer->address }}</td>
            </tr>
            <tr>
                @if (count($head->paymentTypes) == 1)
        
                    <td><span class="bold">Forma de Pago: </span>{{ $head->paymentTypes[0]->description }}</td>

                @else

                    <td>
                        <span class="bold">Formas de Pago: </span>

                        @foreach ($head->paymentTypes as $payment)
                                
                            @if ($loop->last)
                                {{ $payment->description }}
                            @else
                                {{ $payment->description }},
                            @endif

                        @endforeach
                    </td>
                @endif
                
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
            @if ($head->discount > 0)
                <tr>
                    <td><span class="bold">Descuento Global: </span> S/. {{ round($head->discount, 2) }}</td>
                </tr>
            @endif
            @if ($discount > 0)
                <tr>
                    <td><span class="bold">Descuento por Item: </span> S/. {{ round($discount, 2) }}</td>
                </tr>
            @endif
            @if ($head->total_taxed > 0)
                <tr>
                    <td><span class="bold">Gravado: </span> S/. {{ round($head->total_taxed, 2) }}</td>
                </tr>
            @endif
            @if ($head->total_exonerated > 0)
                <tr>
                    <td><span class="bold">Exonerado: </span> S/. {{ round($head->total_exonerated, 2) }}</td>
                </tr>
            @endif
            @if ($head->total_unaffected > 0)
                <tr>
                    <td><span class="bold">Inafecto: </span> S/. {{ round($head->total_unaffected, 2) }}</td>
                </tr>
            @endif
            @if ($head->total_free > 0)
                <tr>
                    <td><span class="bold">Gratuita: </span> S/. {{ round($head->total_free, 2) }}</td>
                </tr>
            @endif
            @if ($head->total_igv > 0)
                <tr>
                    <td><span class="bold">Igv (18%): </span> S/. {{ round($head->total_igv, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td><span class="bold">Total: </span> S/. {{ round($head->total - $head->discount, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="hr"></div>
    <p><span class="bold">IMPORTE EN LETRAS: </span>{{ \App\Services\NumberLetterService::convert(round($head->total - $head->discount, 2), 'SOLES') }}</p>

    @if (count($head->paymentTypes) == 1)
        
        <p><span class="bold">FORMA DE PAGO: </span>{{ $head->paymentTypes[0]->description }} (Contado)</p>

    @else

        <p><span class="bold">FORMAS DE PAGO (CONTADO):</span></p>

        @foreach ($head->paymentTypes as $payment)
            
            <p><span class="bold">{{ $payment->description }}: </span>S/. {{ round($payment->pivot->amount, 2) }}</p>

        @endforeach
        
    @endif
  
    <div>
        <img src="data:image/png;base64, {{ $qr }}" class="qr"/>
    </div>

    <p><span class="bold">HASH: </span>{{ $head->hash_cpe }}</p>
</body>
</html>