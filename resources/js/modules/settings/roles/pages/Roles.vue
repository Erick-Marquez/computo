<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Roles</h1>
    </div>
  </div>

  <div class="container-fluid">
    <button
      class="btn btn-dark btn-block btn-lg mb-4"
      data-toggle="modal"
      data-target="#new-rol"
    >
      <i class="fas fa-plus"></i>
      Nuevo Rol
    </button>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Roles</h3>

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
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nombre del Rol</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="rol in roles" :key="rol.id">
                  <td>{{ rol.id }}</td>
                  <td>{{ rol.name }}</td>
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
                        <router-link
                          class="dropdown-item"
                          :to="{ path: `/roles/${rol.id}` }"
                        >
                          <i class="col-1 mr-3 fas fa-edit"></i>
                          Editar
                        </router-link>
                        <button
                          class="dropdown-item"
                          @click="deleteRol(rol.id)"
                        >
                          <i class="col-1 mr-3 fas fa-trash"></i>
                          Eliminar
                        </button>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>

  <div class="modal fade" id="new-rol" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear Nuevo Rol</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createRol()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre del Rol</label>
              <input
                id="description"
                type="text"
                class="form-control"
                v-model="rol.name"
                required
              />
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button
              type="button"
              class="btn btn-outline-danger"
              data-dismiss="modal"
            >
              Cerrar
            </button>
            <button type="submit" class="btn btn-dark">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl.js";
export default {
  components: { BaseUrl },
  created() {
    this.getRoles();
  },
  data() {
    return {
      roles: {},
      rol: {
      },
    };
  },
  methods: {
    async getRoles() {
      await BaseUrl.get(`/api/roles`)
        .then((response) => {
          this.roles = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    async createRol() {
      await BaseUrl.post(`/api/roles`, this.rol)
        .then((response) => {
          console.log(response.data);
          this.rol = {};
          $("#new-rol").modal("hide");
          this.getRoles();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    async deleteRol(id) {
      Swal.fire({
        title: "Esta seguro de elimiar este rol?",
        text: "Este cambio no se puede revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Borralo!",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`/api/roles/${id}`)
            .then((response) => {
              console.log(response.data);
              Swal.fire("Borrado!", "El Rol fue eliminado.", "success");
              this.getRoles();
            })
            .catch((error) => {
              console.log(error.response);
            });
        }
      });
    },
  },
};
</script>

<style>
</style>
