
<table class="">
    <thead>
        <tr>
            <th>Fecha y Hora</th>
            <th>Concepto</th>
            <th>Tipo de pago</th>
            <th>Observación</th>
            <th>Monto</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($movements as $mov)
            <tr>
                <td class="celda">{{ $mov->created_at }}</td>
                <td class="celda">
                    {{ $mov->type }}
                    <br>
                    {{ $mov->user_name }}
                </td>
                <td class="celda">{{ $mov->payment_type }}</td>
                <td class="celda">
                    {{ $mov->observation }}
                </td>
                <td class="celda">S/.{{ $mov->amount }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
