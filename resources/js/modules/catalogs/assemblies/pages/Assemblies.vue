<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Configuraciones o Ensamblajes de PC</h1>
    </div>
  </div>

  <div class="container-fluid">
    <router-link
      class="btn btn-block btn-lg btn-dark mb-4"
      :to="{ name: 'new-assembly' }"
    >
      <i class="fas fa-plus"></i>
      Nuevo Ensamblaje
    </router-link>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Ensamblajes</h3>
            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  v-model.trim="searchAssembly"
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
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="assembly in assemblies" :key="assembly.id">
                    <td>{{ assembly.id }}</td>
                    <td v-if="assembly.image != null">
                      <img
                        :src="`/storage/${assembly.image.url}`"
                        class="img-fluid"
                        alt=""
                        style="width: 150px"
                      />
                    </td>
                    <td v-else>No tiene imagen</td>
                    <td>{{ assembly.cod }}</td>
                    <td>{{ assembly.name }}</td>
                    <td>{{ assembly.description }}</td>
                    <td>${{ assembly.price }}</td>
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
                            :to="{
                              name: 'edit-assembly',
                              params: { id: assembly.id },
                            }"
                          >
                            <i class="col-1 mr-3 fas fa-eye"></i>
                            Editar
                          </router-link>
                          <a class="dropdown-item" href="#">
                            <i class="col-1 mr-3 fas fa-edit"></i>
                            Eliminar
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer">
            <Paginator :links="links" v-on:getDataPaginate="getAssemblies" />
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import Paginator from "../../../../compositions/Paginator.vue";

export default {
  components: { BaseUrl, Paginator },
  data() {
    return {
      assemblies: [],
      links: {},

      searchAssembly: "",
      searchingTable: [], // acumular busquedas
    };
  },
  created() {
    this.getAssemblies();
  },
  methods: {
    async getAssemblies() {
      await BaseUrl.get(
        `/api/assemblies?included=products,image&search[name]=${this.searchAssembly}&perPage=10&page=${this.$route.query.page}`
      )
        .then((response) => {
          this.assemblies = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    async searchTable() {
      clearTimeout(this.searchingTable);
      this.searchingTable = setTimeout(this.getAssemblies, 300);
    },
  },
};
</script>

<style>
</style>
