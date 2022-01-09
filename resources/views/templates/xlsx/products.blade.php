<table>
    <thead>
        <tr>
            <th>COD</th>
            <th>PRODUCTO</th>
            <th>LINEA</th>
            <th>MARCA</th>
            <th>STOCK</th>
            <th>PRECIO COMPRA</th>
            <th>PRECIO 1</th>
            <th>PRECIO 2</th>
            <th>PRECIO 3</th>
            <th>ACTIVO</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($products as $product)
            <tr>
                <td>{{ $product->cod }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->line }}</td>
                <td>{{ $product->brand }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->referential_purchase_price }}</td>
                <td>{{ round((($product->sale_gain_one + 100) * $product->referential_purchase_price ) / 100, 2) }}</td>
                <td>{{ round((($product->sale_gain_two + 100) * $product->referential_purchase_price ) / 100, 2) }}</td>
                <td>{{ round((($product->sale_gain_three + 100) * $product->referential_purchase_price ) / 100, 2) }}</td>
                <td>{{ $product->active ? 'SI' : 'NO' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
