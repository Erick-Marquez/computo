<template>
    <div class="content-header">
        <div class="d-flex justify-content-between">
            <div>
                <h1>Productos de la sucursal - {{ branch.description }}</h1>
            </div>
            <div>
                <router-link class="btn btn-lg btn-block btn-dark" :to="{ name:'branch-list' }">
                    <i class="mr-2 fas fa-arrow-left"></i>
                    Atras
                </router-link>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <router-link class="btn btn-lg btn-block btn-dark my-2" :to="{ name:'add-product', params:{ id:this.$route.params.id } }">
            <span><i class="fas fa-plus"></i></span>
            Añadir Productos
        </router-link>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Productos</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px">
                                <input
                                    type="text"
                                    name="table_search"
                                    class="form-control float-right"
                                    placeholder="Search"
                                >

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
                                <th>ID</th>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Maneja Series</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product, index) in products" :key="product.id">
                                <td>{{ index+1 }}</td>
                                <td>{{ product.cod }}</td>
                                <td>{{ product.name }}</td>
                                <td>{{ product.brand }}</td>
                                <td>{{ product.manager_series ? 'SI' : 'NO' }}</td>
                                <td>{{ product.stock }}</td>
                                <td>
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
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                            <a class="dropdown-item" href="#" @click="showModal('#modal-edit', product)"><i class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
    components:{BaseUrl},
    async created(){
        this.showBranch()
        this.showProducts()
    },
    data(){
        return{
            branch: {},
            products: [],
        }
    },
    methods:{
        async showBranch(){
            await BaseUrl.get(`api/branches/${this.$route.params.id}`).then( resp => {
                this.branch = resp.data.data
            })
        },
        async showProducts(){
            await BaseUrl.get(`api/branches/products/${this.$route.params.id}`).then( resp => {
                this.products = resp.data.data
            })
        }
    }
}
</script>

<style scoped>

</style>
