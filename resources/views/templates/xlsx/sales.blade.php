<table class="">
    <thead>
        <tr>
            <th colspan="4">DATOS DE COMPROBANTE</th>
            <th colspan="3">INFORMACIÓN DE CLIENTE</th>
            <th colspan="7">IMPORTES DE LA OPERACIÓN</th>
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
            <th>DESC.</th>
            <th>IGV</th>
            <th>OP. EXONERADA</th>
            <th>OP. INAFECTA</th>
            <th>TOTAL</th>
            <th>ESTADO</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $sale)
            <tr>
                <td class="celda">{{ $sale->date_issue }}</td>
                <td class="celda">{{ $sale->voucher_type }}</td>
                <td class="celda">{{ $sale->serie }}</td>
                <td class="celda">{{ $sale->document_number }}</td>
                <td class="celda">{{ $sale->customer_document_type }}</td>
                <td class="celda">{{ $sale->customer_document }}</td>
                <td class="celda">{{ $sale->customer_name }}</td>
                <td class="celda">{{ $sale->subtotal }}</td>
                <td class="celda">{{ $sale->total_discount }}</td>
                <td class="celda">{{ $sale->total_igv }}</td>
                <td class="celda">{{ $sale->total_exonerated }}</td>
                <td class="celda">{{ $sale->total_unaffected }}</td>
                <td class="celda">{{ $sale->total }}</td>
                <td class="celda">{{ $sale->state }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
