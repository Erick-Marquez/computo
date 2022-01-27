<template>
  <button
    class="btn btn-dark btn-block btn-lg mb-4"
    data-toggle="modal"
    data-target="#new-provider"
  >
    Nuevo Proveedor
  </button>

  <form @submit.prevent="storeProvider">
    <NewProvider :provider="provider" :errors="errors" />
  </form>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Listado de Proveedores</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px">
          <input
            type="text"
            name="table_search"
            class="form-control float-right"
            placeholder="Search"
            v-model.trim="searchProvider"
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
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Nombre Comercial</th>
            <th>Documento</th>
            <th>Datos</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(provider, index) in providers" :key="provider.id">
            <td class="text-wrap" style="width: 20%">{{ provider.name }}</td>
            <td class="text-wrap" style="width: 20%">
              {{ provider.tradename }}
            </td>
            <td class="text-wrap" style="width: 10%">
              <span class="badge bg-maroon">{{
                provider.identification_document != null
                  ? provider.identification_document.description
                  : "Otro"
              }}</span>
              <br />
              {{ provider.document }}
            </td>
            <td class="text-wrap" style="width: 40%">
              <p class="font-weight-light">
                <strong>Telefono: </strong>
                {{ provider.phone == null ? "ninguno" : provider.phone }}
              </p>
              <p class="font-weight-light">
                <strong>Email: </strong>
                {{ provider.email == null ? "ninguno" : provider.email }}
              </p>
              <p class="font-weight-light">
                <strong>Dirección: </strong>
                {{ provider.address == null ? "ninguno" : provider.address }}
              </p>
            </td>
            <td class="text-wrap" style="width: 10%">
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
                  <a class="dropdown-item" @click="editModalProvider(index)"
                    ><i class="col-1 mr-3 fas fa-edit"></i>
                    Editar
                  </a>
                  <a
                    class="dropdown-item"
                    href="#"
                    @click="deleteProvider(provider.id)"
                  >
                    <i class="col-1 mr-3 fas fa-trash"></i>
                    Eliminar
                  </a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <form @submit.prevent="updateProvider">
      <EditProvider :provider="editProvider" :errors="errors" />
    </form>

    <!-- /.card-body -->
    <div class="card-footer">
      <Paginator :links="links" v-on:getDataPaginate="getProviders" />
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import NewProvider from "../components/NewProvider.vue";
import Paginator from "../../../../compositions/Paginator.vue";
import EditProvider from "../components/EditProvider.vue";

export default {
  components: { BaseUrl, NewProvider, EditProvider, Paginator },
  data() {
    return {
      provider: {
        identification_document_id: 1,
      },
      editProvider: {},
      links: {},
      providers: {},
      errors: [],

      searchingTable: [],
      searchProvider: "",
    };
  },
  created() {
    this.getProviders();
  },
  methods: {
    async getProviders() {
      await BaseUrl.get(
        `/api/providers?included=ubigee,identificationDocument&sort=-id&search[name]=${this.searchProvider}&search[tradename]=${this.searchProvider}&search[document]=${this.searchProvider}&perPage=10&page=${this.$route.query.page}`
      )
        .then((response) => {
          this.providers = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async storeProvider() {
      await BaseUrl.post("/api/providers", this.provider)
        .then((response) => {
          console.log(response.data);
          $("#new-provider").modal("hide");
          this.provider = { identification_document_id: 1 };
          this.errors = [];
          this.getProviders();
        })
        .catch((error) => {
          console.log(error.response);
          this.errors = error.response.data.errors;
        });
    },

    async updateProvider() {
      await BaseUrl.put(
        `/api/providers/${this.editProvider.id}`,
        this.editProvider
      )
        .then((response) => {
          $("#edit-provider").modal("hide");
          Swal.fire("Proveedor Editado", "Exito!!", "success");
          this.getProviders();
        })
        .catch((error) => {
          console.log(error.response);
          this.errors = error.response.data.errors;
        });
    },

    deleteProvider(id) {
      Swal.fire({
        title: "Esta seguro?",
        text: "Usted no puede revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Borralo!",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`/api/providers/${id}`)
            .then((response) => {
              Swal.fire("Eliminado!", response.data.message, "success");
              this.getProviders();
            })
            .catch((error) => {
              console.log(error.response);
            });
        }
      });
    },

    async searchTable() {
      clearTimeout(this.searchingTable);
      this.searchingTable = setTimeout(this.getProviders, 300);
    },

    editModalProvider(index) {
      $("#edit-provider").modal("show");
      this.editProvider.id = this.providers[index].id;
      this.editProvider.document = this.providers[index].document;
      this.editProvider.identification_document_id =
        this.providers[index].identification_document.id;
      this.editProvider.name = this.providers[index].name;
      this.editProvider.tradename = this.providers[index].tradename;
      this.editProvider.ubigee_id =
        this.providers[index].ubigee != null
          ? this.providers[index].ubigee.id
          : null;
      this.editProvider.address = this.providers[index].address;
      this.editProvider.phone = this.providers[index].phone;
      this.editProvider.email = this.providers[index].email;
    },
  },
};
</script>

<style>
</style>
