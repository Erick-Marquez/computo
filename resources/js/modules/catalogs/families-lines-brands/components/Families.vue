<template>
    <button class="btn btn-lg btn-block btn-dark my-2 mb-4" data-toggle="modal" data-target="#modal-family-create">
        <span><i class="fas fa-plus"></i></span>
        Nueva Familia
    </button>

    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Lista de Familias</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px">
                <input
                    type="text"
                    name="table_search"
                    class="form-control float-right"
                    placeholder="Search"
                    v-model.trim="search"
                    @keydown.enter.prevent=""
                    @keyup="searchFamilies"
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
                    <th>N°</th>
                    <th>Codigo</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <tr v-if="loadingTable">
                        <td colspan="4">
                            <div style="height: 400px;" class="d-flex justify-content-center align-items-center">
                                <h3 style="font-weight: 300;" class="d-flex align-items-center">
                                    <div class="spinner-border text-danger mr-2" role="status" style="font-size: 0.8rem">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    Cargando...
                                </h3>
                            </div>
                        </td>
                    </tr>

                    <tr v-else-if="familiesNotFound">
                        <td colspan="4">
                            <div style="height: 400px;" class="d-flex justify-content-center align-items-center">
                                <h3 style="font-weight: 300;" class="d-flex align-items-center">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    No se encontraron Familias
                                </h3>
                            </div>
                        </td>
                    </tr>

                    <tr v-else v-for="(family, index) in families" :key="family.id">
                    <td>{{ index + meta.from }}</td>
                    <td>{{ family.cod == null ? 'SIN CODIGO' : family.cod }}</td>
                    <td>{{ family.description }}</td>
                    <td>
                        <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" @click="showModal('#modal-family-edit', family)">
                                <i class="col-1 mr-3 fas fa-edit"></i>Editar
                            </a>
                            <a class="dropdown-item" href="#" @click="deleteFamily(family.id)">
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

            <div class="card-footer">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li v-for="(link, index) in meta.links" :key="link.index" 
                    :class="link.url == null ? 'page-item disabled' : link.active ? 'page-item active' : 'page-item'">
                        <button type="button"
                            class="page-link"
                            @click="(link.url == null || link.active) ? null : showPaginateFamilies(link.url)" 
                        >
                            {{ index == 0 ? 'Anterior' : index == meta.links.length - 1 ? 'Siguiente' : link.label }}
                        </button>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /.card -->
        </div>
    </div>


    <!-- Modal Nueva Familia -->
    <div class="modal fade" id="modal-family-create" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Nueva Familia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form @submit.prevent="createFamily()">
            <div class="modal-body">
            
                <div class="form-group">
                <label for="name">Código</label>
                <input type="text" class="form-control" v-model="family.cod">
                </div>

                <div class="form-group">
                    <label for="name">Descripción</label>
                    <input type="text" :class="'form-control' + (errors['description'] == null ? '' : ' is-invalid')" v-model="family.description" required>
                    <div class="invalid-feedback" v-if="errors['description']">
                        {{ errors["description"][0] }}
                    </div>
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

    <!-- Modal Editar Familia -->
    <div class="modal fade" id="modal-family-edit" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Editar Familia</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form @submit.prevent="editFamily()">
            <div class="modal-body">
            
                <div class="form-group">
                <label for="name">Código</label>
                <input type="text" class="form-control" v-model="familyEdit.cod">
                </div>

                <div class="form-group">
                <label for="name">Descripción</label>
                <input type="text" class="form-control" v-model="familyEdit.description" required>
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

        meta: {},
        perPage: 10,
        search: '',
        loadingTable: false,
        searching: null,
        familiesNotFound: false,

        families: [],
        family: {
            cod: '',
            description: '',
        },
        errors: {},
        familyEdit: {
            id: '',
            cod: '',
            description: '',
        },
        };
    },
    async created() {
        this.showFamilies()
    },
    emits: ["getFamilies"],
    methods: {
        async showFamilies(){
            await BaseUrl.get(`api/families?page=1&perPage=${this.perPage}`).then( resp => {
                this.families = resp.data.data
                this.meta = resp.data.meta
            })
        },

        async showPaginateFamilies(url){
            await axios.get(`${url}&perPage=${this.perPage}`)
            .then( resp => {
                this.families = resp.data.data
                this.meta = resp.data.meta
            })
        },

        searchFamilies(){

            this.loadingTable = true
            this.brandsNotFound = false
            clearTimeout(this.searching)

            this.searching = setTimeout(this.showSearchFamilies, 400)

            
        },
        showSearchFamilies(){
            BaseUrl.get(`api/families?page=1&perPage=${this.perPage}&search[description]=${this.search}&search[cod]=${this.search}`).then( resp=>{
                this.families = resp.data.data
                this.meta = resp.data.meta

                if (this.families.length == 0) {
                    this.familiesNotFound = true
                }
            })
            .finally(() => {
                this.loadingTable = false
            })
        },

        showModal(modal, data = null) {
      
            if (data !== null) {

                this.familyEdit.id = data.id
                this.familyEdit.cod = data.cod
                this.familyEdit.description = data.description
            
            }
            $(modal).modal("show");
        },

        /* --------------------CRUD Familias----------------------------- */
        createFamily(){

            this.loading = true
            BaseUrl.post(`api/families`, this.family).then( resp => {
                
                $("#modal-family-create").modal("hide")
                this.showFamilies()
                this.family = {
                    cod: '',
                    description: '',
                },
                Swal.fire("Creado", "La familia ha sido creada", "success");

                this.$emit("getFamilies")
            })
            .catch((error) => {
                this.errors = error.response.data.errors
                console.log(error.response)
            })
            .finally(() => {
                this.loading = false
            });
        },
        editFamily(){

            this.loading = true
            BaseUrl.put(`api/families/${this.familyEdit.id}`, this.familyEdit).then( resp => {
                
                $("#modal-family-edit").modal("hide")
                this.showFamilies()
                this.familyEdit = {}

                Swal.fire("Actualizado", "La familia ha sido actualizada", "success")

                this.$emit("getFamilies")
            })
            .catch((error) => {
                console.log(error)
            })
            .finally(() => {
                this.loading = false
            });
        },
        deleteFamily(id) {

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
                        const resp=await BaseUrl.delete(`api/families/${id}`)
                        this.showFamilies()
                        Swal.fire("Eliminado", "La familia ha sido eliminada", "success")

                        this.$emit("getFamilies")
                    } catch(error) {
                        console.log(error.response.data.error)
                        Swal.fire("Cancelado", "La familia no se puede eliminar", "error")
                    }

                },
            });

        },
    },
};
</script>

<style scoped>
</style>