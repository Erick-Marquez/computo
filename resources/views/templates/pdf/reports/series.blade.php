{{-- @php

$establishment = $cash->user->establishment;

@endphp --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <title>Reporte POS - {{ $cash->user->name }} - {{ $cash->date_opening }} {{ $cash->time_opening }}</title> --}}
    <title>Reporte de Serie</title>
    <style>
        html {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-spacing: 0;
            border: 1px solid black;
        }

        .celda {
            text-align: center;
            padding: 5px;
            border: 0.1px solid black;
        }

        th {
            padding: 5px;
            text-align: center;
            border-color: #0088cc;
            border: 0.1px solid black;
        }

        .title {
            font-weight: bold;
            padding: 5px;
            font-size: 20px !important;
            text-decoration: underline;
        }

        p>strong {
            margin-left: 5px;
            font-size: 12px;
        }

        thead {
            font-weight: bold;
            background: #0088cc;
            color: white;
            text-align: center;
        }

    </style>
</head>

<body>
    <div>
        <p align="center" class="title"><strong>Reporte de Serie</strong></p>
    </div>
    @if (count($series))
        <div class="">
            <div class=" ">
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
            </div>
        </div>
    @else
        <div class="callout callout-info">
            <p>No se encontraron registros.</p>
        </div>
    @endif
</body>

</html>
