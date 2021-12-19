<template>
    <form action="" @submit.prevent="generateKardex()">
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
                                    {{  `${option.name} - ${option.brand}${ option.cod ? ' - '+option.cod : ''}` }}
                                </template>

                                <template v-slot:selected-option="option">
                                    {{  `${option.name} - ${option.brand}${ option.cod ? ' - '+option.cod : ''}` }}
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
                <button v-if="!kardexLoading" type="submit" class="btn btn-block btn-sm btn-dark">
                    <i class="fas fa-search"></i>
                    Buscar
                </button>
                <button v-else class="btn btn-block btn-sm btn-dark" :disabled="kardexLoading">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </form>

    <div class="card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kardex de Productos</h3>
                <div class="card-tools">
                    <a
                        href="`../../reports/products/print/${filters.branch_id}`"
                        target="_blank"
                        class="btn btn-flat btn-danger mr-2 rounded-pill"
                    >
                        <i class="fas fa-file-excel"></i> PDF
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>FECHA</th>
                                <th>DOCUMENTO</th>
                                <th>SERIES</th>
                                <th>DESCRIPCIÓN</th>
                                <th>ENTRADA</th>
                                <th>SALIDA</th>
                                <th>STOCK</th>
                            </tr>
                        </thead>

                        <tbody v-if="kardex.length >= 1">
                            <tr v-for="kardexDetail in kardex" :key="kardexDetail.id">
                                <td>{{ getTimestamp(kardexDetail.created_at) }}</td>
                                <td>{{ kardexDetail.document ? kardexDetail.document : '-' }}</td>
                                <td>
                                    <Popper class="light" arrow>
                                        <button class="btn btn-block btn-sm btn-dark" :disabled="kardexDetail.series.length == 0">Series</button>
                                        
                                        <template v-slot:content>

                                            <b v-for="serie in kardexDetail.series" :key="serie">
                                                {{ serie }}
                                                <br>
                                            </b>
                                        </template>
                                    </Popper>
                                </td>
                                <td>{{ kardexDetail.description }}</td>
                                <td>{{ kardexDetail.movement_type == "INGRESO" ? kardexDetail.quantity : '-' }}</td>
                                <td>{{ kardexDetail.movement_type == "SALIDA" ? kardexDetail.quantity : '-' }}</td>
                                <td>{{ kardexDetail.stock }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr>
                                <td colspan="7">
                                <p class="lead">
                                    <b>No existen Registros.</b>
                                </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <!-- /.card-body -->
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
            stock: 0,

            kardex: [],
            kardexLoading: false,



            //Vue select 
            searching: null,
            search: null,
            selectLoading: null
        }
    },
    mounted(){

    },
    methods:{
        getTimestamp(date){
            return new Date(Date.parse(date)).toLocaleString('en-US', { timeZone: 'America/Lima' })
        },
        onProductSearch(search, loading) {
            this.search = search
            this.loading = loading

            clearTimeout(this.searching);

            if(search.length !== 0) {
                this.loading(true);
                console.log(this.searching)
                this.searching = setTimeout(this.searchProduct, 500)
            }
            else{
                clearTimeout(this.searching)
                this.products  = []
                this.loading(false)
            }
        },
        searchProduct() {

            BaseUrl.get(`api/kardex/search-products/${this.branchSelected}/${this.search}`).then((resp) => {

                this.products = resp.data.data

            })
            .finally(() => {
                this.loading(false)
            });

        },
        generateKardex(){

            this.kardexLoading = true

            BaseUrl.get(`api/kardex/${this.productSelected.id}`).then((resp) => {

                this.kardex = resp.data.data
                let stock = 0

                this.kardex.forEach((element, index) => {
                    
                    if (element.movement_type == 'SALIDA') {
                        stock -= element.quantity
                    }
                    if (element.movement_type == 'INGRESO') {
                        stock += element.quantity
                    }

                    this.kardex[index].stock = stock

                });

            })
            .finally(() => {
                this.kardexLoading = false
            });

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
