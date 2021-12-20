@php
    $path_style = resource_path('views'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'pdf'.DIRECTORY_SEPARATOR.'style-warranty.css');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="{{ $path_style }}" rel="stylesheet" />
    <title>Garantia {{ $head->serie->serie }}-{{ str_pad($head->document_number, 4, '0', STR_PAD_LEFT) }}</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/Logo.png" alt="este es el logo del negocio">
        </div>
        <div class="ruc">
            <p>R. U. C.: {{ $company->ruc }}</p>
            <p>Carta de Garantía</p>
            <p>{{ $head->serie->serie }} - {{ str_pad($head->document_number, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
    </header>
    <main>
        <p class="primer__parrafo">"{{ $company->name }}" empresa líder dedicada a la comercialización de equipos, suministros y accesorios de cómputo, garantiza sus productos en su
            procedencia, legalidad y confiabilidad de rendimiento. Dedicados a suministrar productos de alta calidad tecnológica, "{{ $company->name }}" garantiza el
            equipo entregado al Sr(a). {{ $head->customer->name }} , con DNI/RUC N° {{ $head->customer->document }}, N° {{ $head->serie->voucherType->description }} {{ $head->serie->serie }}-{{ str_pad($head->document_number, 4, '0', STR_PAD_LEFT) }}
        </p>
        <table class="productos">
            <thead>
                <tr>
                    <td>Cantidad</td>
                    <td>Tiempo</td>
                    <td>Fecha Máxima</td>
                    <td>Descripción</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $i => $detail)
                    <tr>
                        <td>{{ $detail->quantity }}</td>
                        @php
                            switch ($detail->branchProduct->product->type_of_time_for_warranty) {
                                case 'days':
                                    $time_of_warranty = $detail->branchProduct->product->time_of_warranty == 1 ? $detail->branchProduct->product->time_of_warranty . ' Día' : $detail->branchProduct->product->time_of_warranty . ' Días'; 
                                    break;
                                case 'weeks':
                                    $time_of_warranty = $detail->branchProduct->product->time_of_warranty == 1 ? $detail->branchProduct->product->time_of_warranty . ' Semana' : $detail->branchProduct->product->time_of_warranty . ' Semanas'; 
                                    break;
                                case 'months':
                                    $time_of_warranty = $detail->branchProduct->product->time_of_warranty == 1 ? $detail->branchProduct->product->time_of_warranty . ' Mes' : $detail->branchProduct->product->time_of_warranty . ' Meses'; 
                                    break;
                                case 'years':
                                    $time_of_warranty = $detail->branchProduct->product->time_of_warranty == 1 ? $detail->branchProduct->product->time_of_warranty . ' Año' : $detail->branchProduct->product->time_of_warranty . ' Años'; 
                                    break;
                                default:
                                    # code...
                                    break;
                            }
                        @endphp
                        <td>{{ $time_of_warranty }}</td>
                        <td>{{ $detail->date_due }}</td>
                        <td>{{ $detail->branchProduct->product->name  }} - Series: 
                            @foreach ($detail->series as $serie)
                                ({{ $serie }})
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>"{{ $company->name }}" otorga la garantía en las siguientes condiciones:</p>
        <p class="negrita">Primero:</p>
        <p>Se otorga una garantía total del tiempo especificado por producto: en la cual "{{ $company->name }}" cambiará cualquier componente que presente fallas de fabricación y por tal
            no brinde un adecuado rendimiento, siendo la pieza de reemplazo nueva y en las mismas características que la fallada.
        </p>
        <p class="negrita">Segundo:</p>
        <p>"{{ $company->name }}" garantiza solo y únicamente el hardware del equipo entregado, no haciéndose responsable por el software que en él se utilicen,
            precisando que nuestra empresa entrega el hardware en perfectas condiciones de funcionamiento. No cubre perdida de información en el caso se tenga que
            reemplazar el disco duro se sugiere hacer copias de seguridad periódicamente.            
        </p>
        <p class="negrita">Tercero:</p>
        <p>"{{ $company->name }}" No se hará responsable por los desperfectos en el equipo cuando.</p>
        <div class="desplazar">
            <p>- Este provenga del uso inadecuado del equipo o sus periféricos</p>
            <p>- Cuando la falla provenga de la instalación de software que cree fallas de conflicto en el sistema.
            </p>
            <p>- Cuando la falla tenga su origen en golpes al equipo</p>
            <p>- Cuando la falla provenga del ingreso de virus informáticos a la misma.</p>
            <p>- Cuando la falla provenga de una inadecuada instalación eléctrica y por fluctuaciones constantes en     el nivel de voltaje que exceda los estándares normales para un correcto funcionamiento.</p>
            <p class="negrita">- Cuando el sello de garantía se halle removido o roto. *</p>
        </div>
        <p>De demostrarse las condiciones antes mencionadas, el cliente pagara el monto correspondiente por el servicio recibido</p>
        <p>* En este caso el cliente perderá todo derecho por Garantía</p>
        <p>CONDICIONES DE SERVICIO TECNICO Y DIAGNOSTICO</p>
        <p class="negrita">Cuarto:</p>
        <p>Todo Servicio Técnico y diagnostico se realizará en las Oficinas de "{{ $company->name }}" para lo cual el cliente deberá traer su equipo o componente que presente fallas y el documento de compra correspondiente. <br>
        La Garantía NO cubre el Servicio Técnico, NO cubre piezas, partes y/o accesorios adicionales que presenten fallas consignadas en el Ítem N° Tercero.</p>
        
        @php
            $days = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado'];
            $months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
        @endphp

        <p>"{{ $days[date_format($head->created_at, 'w')] . ' ' . date_format($head->created_at, 'j') . ' de ' . $months[date_format($head->created_at, 'n') - 1] . ' del ' . date_format($head->created_at, 'Y') }}"</p>
        
        <div class="firma">
            <div class="linea"></div>
            <p class="negrita">El Cliente</p>
            <p>{{ $head->customer->name }}</p>
            <span>DNI / RUC:</span>
            <span>{{ $head->customer->document }}</span>
        </div>
        <p class="dir">Dirección: <span>"{{ $company->address }}"</span> Teléfonos: <span>"{{ $company->phone }}"</span></p>
    </main>
</body>
</html>