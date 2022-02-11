<template>
    <button class="btn btn-lg btn-block btn-dark my-2" data-toggle="modal" data-target="#modal-line-create">
        <span><i class="fas fa-plus"></i></span>
        Nueva Linea
    </button>
    
    <div class="row">
        <div class="col-12">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">Lista de Lineas</h3>

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
                    <tr v-for="(line, index) in lines" :key="line.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ line.cod }}</td>
                    <td>{{ line.description }}</td>
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
                        <div
                            class="dropdown-menu"
                            aria-labelledby="dropdownMenuButton"
                            style=""
                        >
                            <a class="dropdown-item" href="#" @click="showModal('#modal-line-edit', line)">
                                <i class="col-1 mr-3 fas fa-edit"></i>Editar
                            </a>
                            <a class="dropdown-item" href="#" @click="deleteLine(line.id)">
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
                            @click="(link.url == null || link.active) ? null : showPaginateLines(link.url)" 
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

    <!-- Modal Nueva Linea -->
    <div class="modal fade" id="modal-line-create" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Nueva Linea</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form @submit.prevent="createLine()">
            <div class="modal-body">
            
                <div class="form-group">
                    <label for="name">Código</label>
                    <input type="text" class="form-control" v-model="line.cod">
                </div>

                <div class="form-group">
                    <label for="name">Descripción</label>
                    <input type="text" :class="'form-control' + (errors['description'] == null ? '' : ' is-invalid')" v-model="line.description" required>
                    <div class="invalid-feedback" v-if="errors['description']">
                        {{ errors["description"][0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Familia</label>
                    <v-select v-model="line.family_id" label="description" :reduce="family => family.id" :options="families">
                        <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                No se encontraron resultados para <b><em>{{ search }}</em></b>.
                            </template>
                        </template>
                    </v-select>
                    <div class="invalid-feedback" v-if="errors['family_id']">
                        {{ errors["family_id"][0] }}
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

    <!-- Modal Editar Linea -->
    <div class="modal fade" id="modal-line-edit" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Editar Linea</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <form @submit.prevent="editLine()">
            <div class="modal-body">
            
                <div class="form-group">
                    <label for="name">Código</label>
                    <input type="text" class="form-control" v-model="lineEdit.cod">
                </div>

                <div class="form-group">
                    <label for="name">Descripción</label>
                    <input type="text" class="form-control" v-model="lineEdit.description" required>
                </div>

                <div class="form-group">
                    <label for="name">Familia</label>
                    <v-select v-model="lineEdit.family_id" label="description" :reduce="family => family.id" :options="families">
                        <template v-slot:no-options="{ search, searching }">
                            <template v-if="searching">
                                No se encontraron resultados para <b><em>{{ search }}</em></b>.
                            </template>
                        </template>
                    </v-select>
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
    components: { BaseUrl },
    data() {
        return {

            loading: false,

            meta: {},
            perPage: 10,

            lines: [],
            line: {
                cod: '',
                description: '',
                family_id: '',
            },
            errors: {},
            lineEdit: {
                id: '',
                cod: '',
                description: '',
                family_id: '',
            },

        };
    },
    props: {
        families: Array,
        brands: Array,
    },
    async created() {
        this.showLines()
    },
    methods: {
        async showLines(){
            await BaseUrl.get(`api/lines?page=1&perPage=${this.perPage}`).then( resp => {
                this.lines = resp.data.data
                this.meta = resp.data.meta
            })
        },

        async showPaginateLines(url){
            await axios.get(`${url}&perPage=${this.perPage}`)
            .then( resp => {
                this.lines = resp.data.data
                this.meta = resp.data.meta
            })
        },

        showModal(modal, data = null) {
      
            if (data !== null) {

                this.lineEdit.id = data.id
                this.lineEdit.cod = data.cod
                this.lineEdit.description = data.description
                this.lineEdit.family_id = data.family_id
            
            }
            $(modal).modal("show");
        },

        /* --------------------CRUD Lineas----------------------------- */
        createLine(){

            this.loading = true
            BaseUrl.post(`api/lines`, this.line).then( resp => {
                
                $("#modal-line-create").modal("hide")
                this.showLines()
                this.line = {
                    cod: '',
                    description: '',
                    family_id: '',
                },
                Swal.fire("Creado", "La linea ha sido creada", "success");
            })
            .catch((error) => {

                this.errors = error.response.data.errors
                console.log(error.response);
            }).finally(() => {
                this.loading = false;
            });
        },
        editLine(){
            this.loading = true
            BaseUrl.put(`api/lines/${this.lineEdit.id}`, this.lineEdit).then( resp => {
                
                $("#modal-line-edit").modal("hide")
                this.showLines()
                this.lineEdit = {}

                Swal.fire("Actualizado", "La linea ha sido actualizada", "success");
            })
            .catch((error) => {
                console.log(error);
            })
            .finally(() => {
                this.loading = false;
            });
        },
        deleteLine(id) {

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
                        const resp = await BaseUrl.delete(`api/lines/${id}`)
                        this.showLines()
                        Swal.fire("Eliminado", "La linea ha sido eliminada", "success")
                    } catch(error) {
                        console.log(error.response.data.error)
                        Swal.fire("Cancelado", "La linea no se puede eliminar", "error")
                    }

                },
            });

        }
    },
};
</script>

<style>

</style>