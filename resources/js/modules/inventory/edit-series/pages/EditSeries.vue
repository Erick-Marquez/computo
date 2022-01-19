<template>
    <form action="" @submit.prevent="getBranchProductSeries()">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="lead">Sucursal</label>
                            <v-select v-model="branchSelected" label="description" :reduce="branch => branch.id" :options="branches">
                                <template v-slot:no-options="{ search, searching }">
                                    <template v-if="searching">
                                        No se encontraron resultados para <b><em>{{ search }}</em></b>.
                                    </template>
                                </template>
                            </v-select>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="" class="lead">Producto</label>
                            <v-select v-model="productSelected" :filterable="false" label="name" :options="products" @search="onProductSearch">
                                
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
                                    <em v-else-if="branchSelected == null" style="opacity: 0.5"><b>Seleccione una sucursal.</b></em>
                                    <em v-else style="opacity: 0.5">Escribe el nombre de un producto.</em>
                                </template>
                            </v-select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button v-if="!branchProductSeriesLoading" type="submit" class="btn btn-block btn-sm btn-dark">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>
                <button v-else class="btn btn-block btn-sm btn-dark" :disabled="branchProductSeriesLoading">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de series del producto</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px">
                <input
                    type="text"
                    name="table_search"
                    class="form-control float-right"
                    placeholder="Search"
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
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Serie</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="serie in series" :key="serie.id">
                            <td class="align-middle">
                                {{ serie.serie }}
                            </td>
                            <td class="align-middle text-center">
                                <div class="dropdown">
                                    <button
                                        class="btn btn-danger dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        Acciones
                                    </button>
                                    <div
                                        class="dropdown-menu"
                                        aria-labelledby="dropdownMenuButton"
                                        style=""
                                    >
                                        <a
                                        class="dropdown-item"
                                        href="#"
                                        @click="showModal('#modal-edit', serie)"
                                        ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                                        >
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        <ul class="pagination pagination-sm m-0 float-right">
            <li v-for="(link, index) in meta.links" :key="link.index"
            :class="link.url == null ? 'page-item disabled' : link.active ? 'page-item active' : 'page-item'">
            <button type="button"
                class="page-link"
                @click="(link.url == null || link.active) ? null : showPaginateBranchProductSeries(link.url)"
            >
                {{ index == 0 ? 'Anterior' : index == meta.links.length - 1 ? 'Siguiente' : link.label }}
            </button>
            </li>
        </ul>
        </div>

    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modal-edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Serie</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form @submit.prevent="editBranchProductSerie()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Serie Anterior</label>
                            <input type="text" class="form-control" :value="serieEdit.oldSerie" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Serie Nueva</label>
                            <input type="text" class="form-control" v-model="serieEdit.newSerie">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                        Cerrar
                        </button>

                        <button v-if="!editBranchProductSeriesLoading" type="submit" class="btn btn-primary">Actualizar</button>
                        <button v-else class="btn btn-primary" :disabled="editBranchProductSeriesLoading">
                            <div class="spinner-border spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl'
import Popper from "vue3-popper"
export default {
    components:{BaseUrl, Popper},
    async created(){
       
        await BaseUrl.get(`/api/branches`).then( resp=>{
            this.branches = resp.data.data
        })  
        
    },
    data(){
        return{

            branches: [],
            products: [],

            branchSelected: null,
            productSelected: null,

            meta: {},
            perPage: 10,

            series: [],
            branchProductSeriesLoading: false,

            serieEdit: {
                id: null,
                oldSerie: null,
                newSerie: null
            },
            editBranchProductSeriesLoading: false,



            //Vue select 
            searching: null,
            search: null,
            selectLoading: null
        }
    },
    mounted(){

    },
    methods:{
        onProductSearch(search, loading) {
            this.search = search
            this.selectLoading = loading

            clearTimeout(this.searching);

            if(search.length !== 0) {
                this.selectLoading(true);
                this.searching = setTimeout(this.searchProduct, 500)
            }
            else{
                clearTimeout(this.searching)
                this.products  = []
                this.selectLoading(false)
            }
        },
        searchProduct() {

            BaseUrl.get(`api/kardex/search-products/${this.branchSelected}/${this.search}`).then((resp) => {

                this.products = resp.data.data

            })
            .finally(() => {
                this.selectLoading(false)
            });

        },
        getBranchProductSeries(){

            this.branchProductSeriesLoading = true

            BaseUrl.get(`api/edit-series/${this.productSelected.id}?page=1&perPage=${this.perPage}`).then((resp) => {

                this.series = resp.data.data
                this.meta = resp.data.meta

            })
            .finally(() => {
                this.branchProductSeriesLoading = false
            });

        },
        async showPaginateBranchProductSeries(url){
            await axios.get(`${url}&perPage=${this.perPage}`)
            .then( resp => {
                this.series = resp.data.data
                this.meta = resp.data.meta
            })
        },

        showModal(modal, serie = null) {
            if (serie !== null) {
                this.serieEdit.id = serie.id
                this.serieEdit.oldSerie = serie.serie
                this.serieEdit.newSerie = null
            }
            $(modal).modal("show");
        },
        editBranchProductSerie(){

            this.editBranchProductSeriesLoading = true

            BaseUrl.put(`api/edit-series/${this.serieEdit.id}`, this.serieEdit).then( resp => {
        
                console.log(resp)
                $("#modal-edit").modal("hide")
                this.getBranchProductSeries()
                this.serieEdit = {}

                Swal.fire("Actualizado", "La serie ha sido actualizada", "success");
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                this.editBranchProductSeriesLoading = false
            })
        }
    }
}
</script>

<style scoped>
    .light {
        --popper-theme-background-color: #ffffff;
        --popper-theme-background-color-hover: #ffffff;
        --popper-theme-text-color: #333333;
        --popper-theme-border-width: 1px;
        --popper-theme-border-style: solid;
        --popper-theme-border-color: #eeeeee;
        --popper-theme-border-radius: 6px;
        --popper-theme-padding: 20px;
        --popper-theme-box-shadow: 0 6px 30px -6px rgba(0, 0, 0, 0.25);
    }
</style>