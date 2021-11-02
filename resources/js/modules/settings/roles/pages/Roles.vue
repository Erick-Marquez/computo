<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Roles</h1>
    </div>
  </div>

  <div class="container-fluid">
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
                        <router-link class="dropdown-item" :to="{name: 'edit-permissions'}">
                          <i class="col-1 mr-3 fas fa-eye"></i>Mostrar
                        </router-link>
                        <a class="dropdown-item" href="#"
                          ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                        >
                        <a class="dropdown-item" href="#"
                          ><i class="col-1 mr-3 fas fa-trash"></i>Eliminar</a
                        >
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

  <!-- MODALES -->
  <div class="modal fade" id="modal-create" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear nueva Caja</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createCashbox()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre de la caja</label>
              <input
                id="description"
                type="text"
                class="form-control"
                required
              />
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>
            <button type="submit" class="btn btn-primary">Guardar</button>
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
  async created() {
    await BaseUrl.get(`api/roles`).then((resp) => {
      this.roles = resp.data.data;
    });
  },
  data() {
    return {
      roles: {},
    };
  },
  methods: {},
};
</script>

<style>
</style>
