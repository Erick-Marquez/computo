<div>
    <div class="form-group">
        <label for="search" class="font-weight-normal">Buscar Productos</label>
        <input type="text" class="form-control" 
            placeholder="Escribe el nombre o el codigo del producto" autocomplete="off" 
            wire:model="searchProduct" 
            wire:keydown.arrow-up="decrementHighlight"
            wire:keydown.arrow-down="incrementHighlight"
            wire:keydown.escape="selectProduct">
    </div>

    
    @if (!empty($searchProduct))
        <div class="">

            @if (!empty($products))
                <div class="text_container">
                    @foreach ($products as $i => $product)
                    <div>
                        <p class="list-item {{ $highlightIndex === $i ? 'text-primary' : '' }}" >
                            {{ $product['name'] }}
                        </p>
                    </div>
                    @endforeach
                </div>
            @else
                <p>Sin resultados</p>
            @endif 
        </div>
    @endif
    

    <div class="row mb-3">
        <h5 class="col-md-5">Descripción</h5>
        <h5 class="col">Cantidad</h5>
        <h5 class="col">Precio</h5>
        <h5 class="col">Total</h5>
    </div>

    @foreach ($selectProducts as $selectProduct)
    <div class="row mb-3">
        <input type="text" name="product_id[]" id="" value="{{ $selectProduct['id'] }}" hidden>
        <div class="col-md-5">
            <input type="text" class="form-control" name="" id="" value="{{ $selectProduct['name'] }}" disabled>
        </div>
        <div class="col">
            <input type="text" class="form-control" name="quantity[]" id="" placeholder="Cantidad" autocomplete="off">
        </div>
        <div class="col">
            <input type="text" class="form-control" name="price[]" id="" value="{{ $selectProduct['referential_sale_price'] }}" autocomplete="off"> 
        </div>
        <div class="col">
            <input type="text" class="form-control" name="" id="" placeholder="Total" disabled>
        </div>
    </div>
    @endforeach
</div>
