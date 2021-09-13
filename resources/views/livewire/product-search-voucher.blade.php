<div>

    <div class="row">
        <div class="col form-group">
            <label for="branch_id" class="font-weight-normal">Sucursal</label>
            <select class="form-control" id="branch_id" name="branch_id" wire:model="selectBranch">
                <option value="">Selecciona una sucursal</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->description }}</option>
                @endforeach
            </select>
        </div>

        <div class="col form-group">
            <label for="voucher_type_id" class="font-weight-normal">Tipo de comprobante</label>
            <select class="form-control" id="voucher_type_id" name="voucher_type_id" wire:model="selectVoucherType">
                @if (!is_null($voucherTypes))
                    <option value="">Selecciona un tipo de comprobante</option>
                    @foreach ($voucherTypes as $voucherType)
                        <option value="{{ $voucherType->id }}">{{ $voucherType->description }}</option>
                    @endforeach
                @else
                    <option value="">Selecciona una sucursal</option>
                @endif
                
            </select>
        </div>

        <div class="col form-group">
            <label for="serie_id" class="font-weight-normal">Serie</label>
            <select class="form-control" id="serie_id" name="serie_id">
                @if (!is_null($series))
                    @foreach ($series as $serie)
                        <option value="{{ $serie->id }}">{{ $serie->serie }}</option>
                    @endforeach
                @else
                    <option value="">Selecciona un tipo de comprobante</option>
                @endif
                
            </select>
        </div>

    </div>

    <div class="">
        <label for="search" class="font-weight-normal">Buscar Productos</label>
        <input type="text" class="form-control" 
            placeholder="Escribe el nombre o el codigo del producto" autocomplete="off" 
            wire:model="searchProduct" 
            wire:keydown.arrow-up="decrementHighlight"
            wire:keydown.arrow-down="incrementHighlight"
            wire:keydown.escape="selectProduct('sale_price')">
    </div>

    
    @if (!empty($searchProduct))
        <div>
            @if (!empty($products))
                <div class="position-relative">
                    <table width="100%" class="table table-sm table-bordered table-hover position-absolute bg-white shadow-lg" style="z-index:1">
                        <thead class="thead-dark text-center">
                           <th>Descripción</th>
                           <th>Marca</th>
                           <th>Precio 1</th>
                           <th>Precio 2</th>
                           <th>Precio 3</th>
                           <th>Stock</th>
                        </thead>
                        <tbody>
                        @foreach ($products as $i => $product)
                            <tr>
                                <td class=" {{ $highlightIndex === $i ? 'text-primary' : '' }}">{{ $product['name'] }}</td>
                                <td class="text-center {{ $highlightIndex === $i ? 'text-primary' : '' }}">{{ $product['description'] }}</td>
                                <td class="col-2 text-center {{ $highlightIndex === $i ? 'text-primary' : '' }}">
                                    <input class="btn btn-sm btn-success w-50" type="button" value="{{ $product['sale_price'] }}"
                                    wire:click="priceOne({{$i}})">
                                </td>
                                <td class="col-2 text-center {{ $highlightIndex === $i ? 'text-primary' : '' }}">
                                    <input class="btn btn-sm btn-warning w-50" type="button" value="{{ $product['referential_sale_price_one'] }}"
                                    wire:click="priceTwo({{$i}})">
                                </td>
                                <td class="col-2 text-center {{ $highlightIndex === $i ? 'text-primary' : '' }}">
                                    <input class="btn btn-sm btn-info w-50" type="button" value="{{ $product['referential_sale_price_two'] }}"
                                    wire:click="priceThree({{$i}})">
                                </td>
                                <td class="col-1 text-center {{ $highlightIndex === $i ? 'text-primary' : '' }}">{{ $product['stock'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Sin resultados</p>
            @endif 
        </div>
    @endif
    
    <div class="border rounded mt-5 mb-3 pb-3">
        <div class="row m-3">
            <h5 class="col-md-5">Descripción</h5>
            <h5 class="col">Cantidad</h5>
            <h5 class="col">Precio</h5>
            <h5 class="col">Sub Total</h5>
            <h5 class="col">Total</h5>
            <h5 class="col">Series</h5>
        </div>
    
        @foreach ($selectProducts as $i => $selectProduct)

            <div class="row m-3" >
                <input type="text" name="branch_product_id[]" id="" value="{{ $selectProduct['id'] }}" hidden>
                <div class="col-md-5">
                    <input type="text" class="form-control" name="" id="" value="{{ $selectProduct['name'] }}" disabled>
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="quantity[]" id="" placeholder="Cantidad" autocomplete="off"
                    value="{{ $selectProduct['quantity'] }}"
                    onkeyup="saveQuantity(this,{{$i}})">
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="price[]" id="" placeholder="Precio" autocomplete="off"
                    value="{{ $selectProduct['price'] }}"
                    onkeyup="savePrice(this,{{$i}})"> 
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="" id="subtotal{{ $i }}" placeholder="Sub Total" disabled
                    value="{{ $selectProduct['subtotal'] }}"
                    >
                </div>
                <div class="col">
                    <input type="text" class="form-control" name="" id="total{{ $i }}" placeholder="Total" disabled
                    value="{{ $selectProduct['total'] }}"
                    >
                </div>
                <div class="col">
                    <input class="btn btn-info form-control" type="button" value="Series" data-toggle="modal" data-target="#modalSerie{{ $selectProduct['id'] }}">
                </div>
            </div>

            <div class="modal fade" id="modalSerie{{ $selectProduct['id'] }}" tabindex="-1" aria-labelledby="modalSerieLabel{{ $selectProduct['id'] }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalSerieLabel{{ $selectProduct['id'] }}">Registrar series para {{ $selectProduct['name'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @for ($j = 0; $j < $selectProduct['quantity']; $j++)
                                <div class="row m-3">
                                    <input type="text" class="form-control" name="serie[{{ $i }}][]" id="" placeholder="Serie" value=""
                                    >
                                </div>
                            @endfor
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-7">
            <label for="observation" class="font-weight-normal">Observación</label>
            <textarea class="form-control" id="observation" name="observation" placeholder="Observación"></textarea>
        </div>
        <div class="col-1">
            
        </div>
        <div class="col-4">
            <h4>Resumen</h4>
            <table class="table">
                @if ($subtotal != 0)
                    <tr>
                        <td>Sub Total:</td>
                        <td class="text-right">S/. {{ $subtotal }}</td>
                    </tr>
                @endif
                
                @if ($taxed != 0)
                    <tr>
                        <td>Gravado:</td>
                        <td class="text-right">S/. {{ $taxed }}</td>
                    </tr>
                @endif
                
                @if ($exonerated != 0)
                    <tr>
                        <td>Exonerado:</td>
                        <td class="text-right">S/. {{ $exonerated }}</td>
                    </tr>
                @endif
                
                <tr>
                    <td>Descuento:</td>
                    <td class="text-right">S/. {{ $discount }}</td>
                </tr>
                
                <tr>
                    <td>IGV (18%):</td>
                    <td class="text-right">S/. {{ $totalIgv }}</td>
                </tr>
                
                <tr>
                    <td>Total:</td>
                    <td class="text-right">S/. {{ $total }}</td>
                </tr>
            </table>
        </div>
    </div>

    


    <script>
        function saveQuantity(e , i) {
            setTimeout(function(){
                if (!isNaN(e.value) && e.value.length > 0) {
                    var quantity = e.value;
                    @this.saveQuantity(i, quantity);
                }
            },800);
            
        }

        function savePrice(e , i) {
            setTimeout(function(){
                if (!isNaN(e.value) && e.value.length > 0) {
                    var price = e.value;
                    @this.savePrice(i, price);
                }
            },800);
        }

    </script>
</div>
