<template>
    <div class="row">
        <div class="col-12 table-responsive mt-4 mb-4 table-product border rounded">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 36%">Descripción</th>
                        <th style="width: 20%">Tipo IGV</th>
                        <th style="width: 3%">Cantidad</th>
                        <th style="width: 9%">Descuento</th>
                        <th style="width: 9%">Precio</th>
                        <th style="width: 9%">Sub Total</th>
                        <th style="width: 9%">Total</th>
                        <th style="width: 5%">Series</th>
                        <th style="width: 3%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(detail, i) in details" :key="detail">
                        <td>
                            <input
                                :class="['form-control', 'rounded-pill', errors[`detail.${i}.product_id`] == null ? '' : 'is-invalid']"
                                type="text"
                                :value="`${detail.slug} - ${detail.cod}`"
                                disabled
                            >
                            <div class="invalid-feedback" v-if="errors[`detail.${i}.product_id`]">
                                {{ errors[`detail.${i}.product_id`][0] }}
                            </div>
                        </td>

                        <td>
                            <select
                                v-model="detail.igv_type_id"
                                :class="['form-control', 'rounded-pill', errors[`detail.${i}.igv_type_id`] == null ? '' : 'is-invalid']"
                                @change="$emit('getTotals')"
                            >
                                <option
                                    v-for="igvType in igvTypes"
                                    :key="igvType.id"
                                    :value="igvType.id"
                                >
                                    {{ igvType.description }}
                                </option>
                            </select>
                            <div class="invalid-feedback" v-if="errors[`detail.${i}.igv_type_id`]">
                                {{ errors[`detail.${i}.igv_type_id`][0] }}
                            </div>
                        </td>

                        <td>
                            <input
                                v-model="detail.quantity"
                                :class="['form-control', 'rounded-pill', errors[`detail.${i}.quantity`] == null ? '' : 'is-invalid']"
                                type="number"
                                min="1"
                                @change="addSeries(i)"
                                @input="$emit('getTotals')"
                            >
                            <div class="invalid-feedback" v-if="errors[`detail.${i}.quantity`]">
                                {{ errors[`detail.${i}.quantity`][0] }}
                            </div>
                        </td>

                        <td>
                            <input
                                v-model="detail.discount"
                                :class="['form-control', 'rounded-pill', errors[`detail.${i}.discount`] == null ? '' : 'is-invalid']"
                                type="number"
                                min="0"
                                step="0.01"
                                @change="$emit('activateOrDesactivateGlobalDiscount')"
                                :disabled="activateDetailDiscount"
                                @input="$emit('getTotals')"
                            >
                            <div class="invalid-feedback" v-if="errors[`detail.${i}.discount`]">
                                {{ errors[`detail.${i}.discount`][0] }}
                            </div>
                        </td>

                        <td>
                            <input
                                v-model="detail.sale_price" 
                                :class="['form-control', 'rounded-pill', errors[`detail.${i}.sale_price`] == null ? '' : 'is-invalid']"
                                type="text"
                                disabled
                            >
                            <div class="invalid-feedback" v-if="errors[`detail.${i}.sale_price`]">
                                {{ errors[`detail.${i}.sale_price`][0] }}
                            </div>
                        </td>

                        <td>
                            <input
                                class="form-control rounded-pill"
                                type="text"
                                disabled
                                :value="detail.subtotal"
                            >
                        </td>

                        <td>
                            <input
                                class="form-control rounded-pill"
                                type="text"
                                disabled
                                :value="detail.total"
                            >
                        </td>

                        <td>
                            <input
                                :disabled="!detail.manager_series"
                                type="button"
                                class="btn btn-dark btn-sm"
                                value="Series"
                                @click="showModalSeries(i)"
                            >
                        </td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-flat bg-light"
                                @click="deleteItem(i)"
                            >
                                <i class="text-danger fas fa-trash"></i>
                            </button>
                            <div class="invalid-feedback" v-if="errors[`detail.${i}.series`]"
                            >
                                {{ errors[`detail.${i}.series`][0] }}
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="image-without-products" v-if="details.length == 0">
                <img src="../../../../../img/add_product.png" alt="Agregue productos">
                <h1 class="display-4">Agregue productos</h1>
            </div>
        </div>
    </div>

    <!-- MODAL SERIES -->
    <div
        v-if="details.length !== 0"
        class="modal fade"
        id="modal-series"
        tabindex="-1"
        role="dialog"
        aria-labelledby="seriesModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="seriesModalLabel">
                        Registrar series para {{ details[index].description }} - {{ details[index].brand }} - {{ details[index].cod }}
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div
                        v-for="(serie, i) in details[index].series"
                        :key="serie"
                        class="form-group"
                    >
                        <v-select v-model="details[index].series[i]" :filterable="false" :reduce="serie => serie.serie" label="serie" :options="series" @search="onSerieSearch" @keydown.enter.prevent="">
                            <template v-slot:no-options="{ search, searching }">
                                <template v-if="searching">
                                    No se encontraron resultados para <b><em>{{ search }}</em></b>.
                                </template>
                                <em v-else style="opacity: 0.5">Escribe la serie del producto.</em>
                            </template>
                        </v-select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
    components: { BaseUrl },
    props: {
        igvTypes: Array,
        details: Array,
        errors: Object,
        activateDetailDiscount: Boolean
    },
    emits: ["getTotals", "activateOrDesactivateGlobalDiscount"],
    data() {
        return {
            index: 0,
            series: [],

            //Vue select 
            searching: null,
            search: null,
            selectLoading: null
        }
    },
    methods: {
        showModalSeries(i){
            this.index = i
            $('#modal-series').modal("show")
        },
        onSerieSearch(search, loading) {
            this.search = search
            this.selectLoading = loading

            clearTimeout(this.searching);

            if(search.length !== 0) {
                this.selectLoading(true);
                this.searching = setTimeout(this.searchSerie, 500)
            }
            else{
                clearTimeout(this.searching)
                this.series  = []
                this.selectLoading(false)
            }
        },
        searchSerie() {

            BaseUrl.get(`api/sales/products-series/${this.details[this.index].product_id}/${this.search}`).then((resp) => {

                this.series = resp.data.data

            })
            .finally(() => {
                this.selectLoading(false)
            });

        },
        addSeries(i){
            let dif = this.details[i].quantity - this.details[i].series.length
            if (dif > 0) {
                for (let j = 0; j < dif; j++) {
                    this.details[i].series.push('')
                }
            } else {
                for (let j = 0; j < -dif; j++) {
                    this.details[i].series.pop(1)
                }
            }
        },
        deleteItem(i) {
            this.details.splice(i, 1);
            this.$emit('getTotals')
        },
    }
}
</script>

<style scoped>
    .btn.btn-dark {
        border-top-right-radius: 23px;
        border-bottom-right-radius: 23px;
        background: #536976; /* fallback for old browsers */
        background: -webkit-linear-gradient(
            to right,
            #292e49,
            #536976
        ); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(
            to right,
            #292e49,
            #536976
        ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    label {
        color: rgba(48, 48, 48, 0.774);
        font-weight: 300;
    }
    .table-product {
        min-height: 250px;
    }
    .table-product table {
        min-width: 900px;
    }
    .image-without-products {
        display: flex;
        justify-content: center;
        align-items: center;
        align-content: center;
        opacity: 0.7;
        height: 150px;
        width: 100%;
        min-width: 850px;
    }
    .image-without-products img {
        margin-bottom: 0.5rem;
        margin-right: 0.5rem;
        max-height: 120px;
    }
</style>