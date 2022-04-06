<template>
    <button
        class="btn btn-dark btn-block btn-lg mb-4"
        data-toggle="modal"
        data-target="#new-modification"
    >
        <i class="fas fa-plus"></i>
        Nueva modificacion
    </button>

    <form @submit.prevent="createModification()">
        <new-modification-vue :modification="modification" :errors="errors"></new-modification-vue>
    </form>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Modificaciones de Stock</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px">
                    <input
                        type="text"
                        name="table_search"
                        class="form-control float-right"
                        placeholder="Search"
                        v-model.trim="searchModification"
                        @keyup.prevent="searchTable"
                    />

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Costo</th>
                        <th>Stock</th>
                        <th>Observación</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="modification in modifications" :key="modification.id">
                        <td>{{ datetime(modification.date) }}</td>
                        <td>{{ modification.product_name }}</td>
                        <td>{{ modification.quantity }}</td>
                        <td>{{ modification.price }}</td>
                        <td>{{ modification.stock }}</td>
                        <td>{{ modification.observation }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <Paginator :links="links" v-on:getDataPaginate="getModifications" />
        </div>
    </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import Paginator from "../../../../compositions/Paginator.vue";
import NewModificationVue from "../components/NewModification.vue";

export default {
    components: { BaseUrl, NewModificationVue, Paginator },
    data() {
        return {
            modification: {
                type: 'ENTRADA',
                branch_id: null, // tal vez lo necesites idk
                product_id: null,
                stock: 0,
                manager_series: true,
                series: [],
                quantity: null,
                referential_purchase_price: null
            },
            modifications: [],
            errors: [],
            links: {},
            searchingTable: [],
            searchModification: "",
        };
    },
    created() {
        this.getModifications();
    },
    methods: {
        async getModifications() {
            await BaseUrl.get(
                `api/url?sort=-id&perPage=10&page=${this.$route.query.page}`
            )
                .then((response) => {
                    this.modifications = response.data.data;
                    this.links = response.data.meta.links;
                })
                .catch((error) => {
                    console.log(error.response.data);
                });
        },

        async createModification() {

            console.log(this.modification)
            await BaseUrl.post("/api/stock-modification", this.modification)
                .then((response) => {
                    this.getModifications();
                    this.errors = [];
                    this.modification = { type: "ENTRADA"};
                    $("#new-modification").modal("hide");
                    Swal.fire("Registrado!", response.data.message, "success");

                    console.log(response)
                })
                .catch((error) => {
                    error.response.data.errors != undefined
                        ? (this.errors = error.response.data.errors)
                        : console.log(error.response);
                });
        },

        async searchTable() {
            clearTimeout(this.searchingTable);
            this.searchingTable = setTimeout(this.getModifications, 300);
        },
        datetime(date) {
            return moment(date).format('YYYY-MM-DD, h:mm:ss a')
        }

    },
};
</script>

<style>
.modal:nth-of-type(even) {
    z-index: 1052 !important;
}
.modal-backdrop.show:nth-of-type(even) {
    z-index: 1051 !important;
}
</style>
