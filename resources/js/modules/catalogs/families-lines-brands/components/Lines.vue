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
                            <a
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-eye"></i>Mostrar</a
                            ><a
                            class="dropdown-item"
                            href="#"
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
        </div>
        <!-- /.card -->
        </div>
    </div>

    <!-- Modal Nueva Linea -->
    <div class="modal fade" id="modal-line-create" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Nueva Marca</h4>
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
                <input type="text" class="form-control" v-model="line.description" required>
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

            lines: [],
            line: {
                cod: '',
                description: '',
            },
            lineEdit: {
                id: '',
                cod: '',
                description: '',
            },

        };
    },
    async created() {
        this.showLines()
    },
    methods: {
        async showLines(){
            await BaseUrl.get(`api/lines`).then( resp => {
                this.lines=resp.data.data
            })
        },

        showModal(modal, data = null) {
      
            if (data !== null) {

                this.brandEdit = data
            
            }
            $(modal).modal("show");
        },

        /* --------------------CRUD Lineas----------------------------- */
        createLine(){
            BaseUrl.post(`api/lines`, this.line).then( resp => {
                
                console.log(resp)
                $("#modal-line-create").modal("hide")
                this.showLines()
                this.lines = {
                    cod: '',
                    description: '',
                },
                Swal.fire("Creado", "La linea ha sido creada", "success");
            })
            .catch((error) => {
                console.log(error);
            });
        },
        editLine(){
            BaseUrl.put(`api/families/${this.familyEdit.id}`, this.familyEdit).then( resp => {
                
                console.log(resp)
                $("#modal-line-edit").modal("hide")
                this.showFamilies()
                this.familyEdit = {}

                Swal.fire("Actualizado", "La familia ha sido actualizada", "success");
            })
            .catch((error) => {
                console.log(error);
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
            }).then((result) => {
                if (result.isConfirmed) {
                BaseUrl.delete(`api/currencyexchanges/${id}`).then( resp => {
                    this.showCurrencyExchanges();
                    })
                    .catch((error) => {
                    console.log(error);
                    });

                Swal.fire("Eliminado", "El Cambio de Divisa ha sido eliminado", "success");
                }
            });
        },
    },
};
</script>

<style scoped>
</style>