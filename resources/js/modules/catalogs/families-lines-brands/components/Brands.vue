<template>
    <button class="btn btn-lg btn-block btn-dark my-2" data-toggle="modal" data-target="#modal-brand-create">
        <span><i class="fas fa-plus"></i></span>
        Nueva Marca
    </button>
    
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Lista de Marcas</h3>

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
                        <th>Codigo</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(brand, index) in brands" :key="brand.id">
                        <td>{{ index+1 }}</td>
                        <td>{{ brand.cod }}</td>
                        <td>{{ brand.description }}</td>
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
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" @click="showModal('#modal-brand-edit', brand)">
                                        <i class="col-1 mr-3 fas fa-edit"></i>Editar
                                    </a>
                                    <a class="dropdown-item" href="#" @click="deleteBrand(brand.id)">
                                        <i class="col-1 mr-3 fas fa-trash"></i>Eliminar
                                    </a>
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

    <!-- Modal Nueva Marca -->
    <div class="modal fade" id="modal-brand-create" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Nueva Marca</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form @submit.prevent="createBrand()">
            <div class="modal-body">
            
                <div class="form-group">
                <label for="name">Código</label>
                <input type="text" class="form-control" v-model="brand.cod">
                </div>

                <div class="form-group">
                <label for="name">Descripción</label>
                <input type="text" class="form-control" v-model="brand.description" required>
                </div>

            </div>

            <div class="modal-footer justify-content-between">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">

                <button v-if="!loading" type="submit" class="btn btn-primary">Guardar</button>
                <button v-else class="btn btn-primary" :disabled="loading">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                </button>

            </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Editar Marca -->
    <div class="modal fade" id="modal-brand-edit" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Editar Marca</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form @submit.prevent="editBrand()">
            <div class="modal-body">
            
                <div class="form-group">
                <label for="name">Código</label>
                <input type="text" class="form-control" v-model="brandEdit.cod">
                </div>

                <div class="form-group">
                <label for="name">Descripción</label>
                <input type="text" class="form-control" v-model="brandEdit.description" required>
                </div>

            </div>

            <div class="modal-footer justify-content-between">
                <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">

                <button v-if="!loading" type="submit" class="btn btn-primary">Guardar</button>
                <button v-else class="btn btn-primary" :disabled="loading">
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
import BaseUrl from "../../../../api/BaseUrl";

export default {
    data() {
        return {

            loading: false,

            brands: [],
            brand: {
                cod: '',
                description: '',
            },
            brandEdit: {
                id: '',
                cod: '',
                description: '',
            },

        };
    },
    async created() {
        this.showBrands()
    },
    methods: {
        async showBrands(){
            await BaseUrl.get(`api/brands`).then( resp => {
                this.brands=resp.data.data
            })
        },

        showModal(modal, data = null) {
      
            if (data !== null) {

                this.brandEdit = data
            
            }
            $(modal).modal("show");
        },

        /* --------------------CRUD Marcas----------------------------- */
        createBrand(){
            this.loading = true
            BaseUrl.post(`api/brands`, this.brand).then( resp => {
                
                $("#modal-brand-create").modal("hide")
                this.showBrands()
                this.brand = {
                    cod: '',
                    description: '',
                },
                Swal.fire("Creado", "La marca ha sido creada", "success");
            })
            .catch((error) => {
                console.log(error);
            }).finally(() => {
                this.loading = false;
            });
        },
        editBrand(){
            this.loading = true
            BaseUrl.put(`api/brands/${this.brandEdit.id}`, this.brandEdit).then( resp => {
                
                $("#modal-brand-edit").modal("hide")
                this.showBrands()
                this.brandEdit = {}

                Swal.fire("Actualizado", "La marca ha sido actualizada", "success");
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                this.loading = false;
            });
        },
        deleteBrand(id) {

            Swal.fire({
                title: "¿Estas Seguro?",
                text: "Esta acción no puede revertirse",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, adelante",
                cancelButtonText: "Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: async () => {

                    try {
                        const resp=await BaseUrl.delete(`api/brands/${id}`)
                        this.showBrands()
                        Swal.fire("Eliminado", "La marca ha sido eliminada", "success")
                    } catch(error) {
                        console.log(error.response.data.error)
                        Swal.fire("Cancelado", "La marca no se puede eliminar", "error")
                    }

                },
            });

        },
    },
};
</script>

<style scoped>
</style>