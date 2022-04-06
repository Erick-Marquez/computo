<template>
    <!-- MODAL PARA AGREGAR NUEVO MOVIMIENTO -->
    <div class="modal fade" id="new-modification" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Nuevo movimiento
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-around mb-2">
                        <div class="custom-control custom-radio">
                            <input
                                class="custom-control-input custom-control-input-danger"
                                type="radio"
                                id="expenses"
                                name="modifications"
                                value="ENTRADA"
                                v-model="modification.operation"
                                checked="true"
                                @change="modification.series = []"
                            />
                            <label for="expenses" class="custom-control-label">ENTRADA</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input
                                class="custom-control-input custom-control-input-danger"
                                type="radio"
                                id="incomes"
                                name="modifications"
                                value="SALIDA"
                                v-model="modification.operation"
                                @change="modification.series = []"
                            />
                            <label for="incomes" class="custom-control-label">SALIDA</label>
                        </div>
                    </div>
                    <div
                        class="invalid-feedback ml-3"
                        v-if="$errorsExists(errors['operation'])"
                    >{{ $errorsPrint(errors["operation"]) }}</div>

                    <div class="form-group">
                        <label for="" class="lead">Sucursal</label>
                        <v-select v-model="modification.branch_id" label="description" :reduce="branch => branch.id" :options="branches">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se encontraron resultados para <b><em>{{ search }}</em></b>.
                                </template>
                            </template>
                        </v-select>
                    </div>

                    <div class="form-group">
                        <label for="" class="lead">Producto</label>
                        <v-select v-model="modification.product" :filterable="false" label="name" :options="products" @search="onProductSearch" @option:selected="selectProduct">
                            
                            <template v-slot:option="option">
                                {{  `${option.slug}${ option.cod ? ' - '+option.cod : ''}` }}
                            </template>

                            <template v-slot:selected-option="option">
                                {{  `${option.slug}${ option.cod ? ' - '+option.cod : ''}` }}
                            </template>
                            
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se encontraron resultados para <b><em>{{ search }}</em></b>.
                                </template>
                                <em v-else-if="modification.branch_id == null" style="opacity: 0.5"><b>Seleccione una sucursal.</b></em>
                                <em v-else style="opacity: 0.5">Escribe el nombre de un producto.</em>
                            </template>
                        </v-select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for>Stock actual</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="modification.stock"
                                        disabled="true"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for>Cantidad</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Und.</span>
                                    </div>
                                    <input
                                        type="text"
                                        :class="$errorsClassSquare(errors['quantity'])"
                                        v-model.number="modification.quantity"
                                    />
                                    <div
                                        class="invalid-feedback ml-3"
                                        v-if="$errorsExists(errors['quantity'])"
                                    >{{ $errorsPrint(errors["quantity"]) }}</div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="form-group">
                                <label for>Costo $</label>
                                <input
                                    type="number"
                                    step="0.0001"
                                    :class="$errorsClassSquare(errors['referential_purchase_price'])"
                                    v-model.number="modification.referential_purchase_price"
                                />
                                <div
                                    class="invalid-feedback ml-3"
                                    v-if="$errorsExists(errors['referential_purchase_price'])"
                                >{{ $errorsPrint(errors["referential_purchase_price"]) }}</div>
                            </div>
                        </div> -->
                    </div>

                    <button
                        v-if="modification.manager_series && modification.quantity > 0"
                        type="button"
                        class="btn btn-dark btn-block"
                        data-toggle="modal"
                        data-target="#staticBackdrop"
                    >
                        <i class="fas fa-plus"></i>
                        Agregar Series
                    </button>

                    <div class="form-group">
                        <label for>Observación</label>
                        <textarea
                            name
                            id
                            cols="30"
                            rows="5"
                            :class="$errorsClassSquare(errors['observation'])"
                            v-model="modification.observation"
                        ></textarea>
                        <div
                            class="invalid-feedback ml-3"
                            v-if="$errorsExists(errors['observation'])"
                        >{{ $errorsPrint(errors["observation"]) }}</div>
                    </div>
                </div>

                <div
                    v-if="modification.operation == 'ENTRADA' && modification.quantity != null && modification.stock != null"
                    class="alert alert-success alert-dismissible fade show mx-3"
                    role="alert"
                >
                    <strong>
                        <i class="fas fa-exclamation-circle"></i>
                    </strong>
                    Se agregará {{ modification.quantity }} unidades dando un total de: {{ parseInt(modification.stock) + parseInt(modification.quantity) }} Und.
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div
                    v-else-if="modification.operation == 'SALIDA' && modification.quantity != null && modification.stock != null"
                    class="alert alert-danger alert-dismissible fade show mx-3"
                    role="alert"
                >
                    <strong>
                        <i class="fas fa-exclamation-circle"></i>
                    </strong>
                    Se restara {{ modification.quantity }} unidades dando un total de: {{ parseInt(modification.stock) - parseInt(modification.quantity) }} Und.
                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark" :disabled="disabled">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Modal Series -->
    <div
        class="modal fade"
        id="staticBackdrop"
        data-backdrop="static"
        data-keyboard="false"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Serie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div v-for="(index, q) in modification.quantity" :key="q.id">
                        <div v-if="modification.operation == 'ENTRADA'" class="form-group">
                            <input v-model="modification.series[index - 1]" class="form-control" type="text" :key="index" @keydown.enter.prevent/>
                        </div>
                        <div v-if="modification.operation == 'SALIDA'" class="form-group ">

                            <v-select v-model="modification.series[index - 1]" label="serie" :reduce="serie => serie.serie" :options="modification.allSeries" @keydown.enter.prevent>
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                    No se encontraron resultados para <b><em>{{ search }}</em></b>.
                                    </template>
                                    <em v-else style="opacity: 0.5">Escribe la serie del producto.</em>
                                </template>
                            </v-select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-dark">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
    data() {
        return {
            products: [],
            series: [],
            branches: [],

            product: {
                manage_serie: false,
            },

            //Vue select Product
            searchingProduct: null,
            searchProduct: null,
            selectLoadingProduct: null

        };
    },
    props: {
        modification: Object,
        errors: Object,
        disabled: Boolean,
    },
    async created() {

        await BaseUrl.get(`/api/branches`).then( resp=>{
            this.branches = resp.data.data
        })  

    },
    methods: {
        onProductSearch(search, loading) {
            this.searchProduct = search
            this.selectLoadingProduct = loading

            clearTimeout(this.searchingProduct);

            if(search.length !== 0) {
                this.selectLoadingProduct(true);
                this.searchingProduct = setTimeout(this.searchProducts, 500)
            }
            else{
                clearTimeout(this.searchingProduct)
                this.products  = []
                this.selectLoadingProduct(false)
            }
        },
        searchProducts() {

            BaseUrl.get(`api/stock-modification/search-products/${this.modification.branch_id}/${this.searchProduct}`).then((resp) => {

                this.products = resp.data.data

            })
            .finally(() => {
                this.selectLoadingProduct(false)
            });

        },
        selectProduct(selectedOption){
            this.modification.branch_product_id = selectedOption.id
            this.modification.stock = selectedOption.stock
            this.modification.manager_series = Boolean(selectedOption.manager_series)
            this.modification.referential_purchase_price = selectedOption.referential_purchase_price

            BaseUrl.get(`api/stock-modification/branch-product-series/${selectedOption.id}`).then((resp) => {

                this.modification.allSeries = resp.data.data

            })
            .finally(() => {
                console.log(this.modification)
            });

        },

        getProductSeries(){
            
        }

    },
};
</script>

<style>
.style-chooser .vs__dropdown-toggle {
    border-radius: 50px;
    width: 100%;
    height: calc(2.25rem + 2px);
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border-color: #ced4da;
    box-shadow: inset 0 0 0 transparent;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
    fill: #394066;
}
</style>
