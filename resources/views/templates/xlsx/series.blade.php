<table class="">
    <thead>
    <tr>
        <th>Serie</th>
        <th>Producto</th>
        <th>Tipo de movimiento</th>
        <th>Descripción</th>
        <th>Documento</th>
        <th>Fecha</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($series as $serie)
        <tr>
            <td  class="celda">{{ $serie->serie }}</td>
            <td  class="celda">{{ $serie->product }}</td>
            <td  class="celda">{{ $serie->movement_type }}</td>
            <td  class="celda">{{ $serie->description }}</td>
            <td  class="celda">{{ $serie->document }}</td>
            <td  class="celda">{{ $serie->date }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
