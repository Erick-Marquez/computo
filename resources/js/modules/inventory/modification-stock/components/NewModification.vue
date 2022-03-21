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
                                v-model="modification.type"
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
                                v-model="modification.type"
                                @change="modification.series = []"
                            />
                            <label for="incomes" class="custom-control-label">SALIDA</label>
                        </div>
                    </div>
                    <div
                        class="invalid-feedback ml-3"
                        v-if="$errorsExists(errors['type'])"
                    >{{ $errorsPrint(errors["type"]) }}</div>

                    <div class="form-group">
                        <label for>Local</label>
                        <select class="form-control" name id v-model="modification.branch_id">
                            <option value></option>
                            <option value></option>
                            <option value></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for>Producto</label>
                        <v-select
                            v-model="modification.product"
                            :filterable="false"
                            label="product"
                            :reduce="(product) => product.name"
                            :options="products"
                            @search="onProductsSearch"
                            @keydown.enter.prevent
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se encontraron resultados para
                                    <b>
                                        <em>{{ search }}</em>
                                    </b>.
                                </template>
                                <em v-else style="opacity: 0.5">Escribe el nombre del Producto.</em>
                            </template>
                        </v-select>
                    </div>
                    <div v-if="modification.type == 'REMUNERACION'" class="form-group">
                        <label for>Personal:</label>
                        <v-select
                            class="style-chooser"
                            v-model="modification.user_id"
                            label="name"
                            :reduce="(seller) => seller.id"
                            :options="sellers"
                        >
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se encontraron resultados para
                                    <b>
                                        <em>{{ search }}</em>
                                    </b>.
                                </template>
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
                        <div class="col">
                            <div class="form-group">
                                <label for>Costo</label>
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
                        </div>
                    </div>

                    <button
                        v-if="modification.manage_series && modification.quantity > 0"
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
                    v-if="modification.type == 'ENTRADA' && modification.quantity != null && modification.stock != null"
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
                    v-else-if="modification.type == 'SALIDA' && modification.quantity != null && modification.stock != null"
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
                        <div v-if="modification.type == 'ENTRADA'" class="form-group">
                            <input v-model="modification.series[index - 1]" class="form-control" type="text" :key="index"/>
                        </div>
                        <div v-if="modification.type == 'SALIDA'" class="form-group ">
                            <v-select
                                v-model="modification.series[index - 1] "
                                :key="index"
                                :filterable="false"
                                label="series"
                                :reduce="(series) => series.serie"
                                :options="series"
                                @search="onPseriesSearch"
                                @keydown.enter.prevent
                            >
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        No se encontraron resultados para
                                        <b>
                                            <em>{{ search }}</em>
                                        </b>.
                                    </template>
                                    <em v-else style="opacity: 0.5">Escribe la serie.</em>
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

            product: {
                manage_serie: false,
            },

            searchProduct: null,
            searchSeries: null,

            //Vue select
            searching: null,
            selectLoading: null,
        };
    },
    props: {
        modification: Object,
        errors: Object,
        disabled: Boolean,
    },
    created() {
    },
    methods: {
        onProductsSearch(search, loading) {
            this.searchProduct = searchProduct;
            this.selectLoading = loading;

            clearTimeout(this.searching);

            if (search.length !== 0) {
                this.selectLoading(true);
                this.searching = setTimeout(this.searchProduct, 500);
            } else {
                clearTimeout(this.searching);
                this.products = [];
                this.selectLoading(false);
            }
        },

        onSeriesSearch(search, loading) {
            this.searchSeries = searchSeries;
            this.selectLoading = loading;

            clearTimeout(this.searching);

            if (search.length !== 0) {
                this.selectLoading(true);
                this.searching = setTimeout(this.searchSeries, 500);
            } else {
                clearTimeout(this.searching);
                this.series = [];
                this.selectLoading(false);
            }
        },

        async searchProduct() {
            await BaseUrl.get(
                `/api/products_url/${this.search}`
            )
            .then((resp) => {
                this.products = resp.data.data;
            })
            .finally(() => {
                this.selectLoading(false);
            });
        },

        async searchSeries() {
            await BaseUrl.get(
                `/api/series_url/`
            )
            .then((resp) => {
                this.series = resp.data.data;
            })
            .finally(() => {
                this.selectLoading(false);
            });
        },

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
