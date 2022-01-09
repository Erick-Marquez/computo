<table class="">
    <thead>
        <tr>
            <th colspan="4">DATOS DE COMPROBANTE</th>
            <th colspan="3">INFORMACIÓN PROVEEDOR</th>
            <th colspan="5">IMPORTES DE LA OPERACIÓN</th>
        </tr>
        <tr>
            <th>F. DE EMISIÓN</th>
            <th>TIPO DOC</th>
            <th>SERIE</th>
            <th>NUMERO</th>

            <th>T. DOC</th>
            <th>NUMERO</th>
            <th>RAZON SOCIAL</th>

            <th>OP. GRAVADA</th>
            <th>IGV</th>
            <th>TOTAL</th>
            <th>MONEDA</th>
            <th>T.C</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchases as $purchase)
            <tr>
                <td class="celda">{{ $purchase->date_issue }}</td>
                <td class="celda">{{ $purchase->document_type }}</td>
                <td class="celda">{{ $purchase->serie }}</td>
                <td class="celda">{{ $purchase->document_number }}</td>

                <td class="celda">
                     {{ $purchase->provider_document_type }}
                </td>
                <td class="celda">{{ $purchase->provider_document }}</td>
                <td class="celda">{{ $purchase->provider_name }}</td>

                <td class="celda">{{ $purchase->subtotal }}</td>
                <td class="celda">{{ $purchase->total_igv }}</td>
                <td class="celda">{{ $purchase->total }}</td>
                <td class="celda">{{ $purchase->handles_exchange_rate ? 'USD' : 'PEN' }}</td>
                <td class="celda">{{ $purchase->exchange_rate }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
