<template>
  <button
    class="btn btn-dark btn-block btn-lg mb-4"
    data-toggle="modal"
    data-target="#new-provider"
  >
    Nuevo Proveedor
  </button>

  <form @submit.prevent="createProvider">
    <NewProvider :provider="provider" />
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
          <tr v-for="provider in providers" :key="provider.id">
            <td class="text-wrap" style="width: 20%">{{ provider.name }}</td>
            <td class="text-wrap" style="width: 20%">
              {{ provider.comercial_name }}
            </td>
            <td class="text-wrap" style="width: 10%">
              <span class="badge bg-maroon">{{ provider.type_document }}</span>
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
                  <a class="dropdown-item" href="#"
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
    <!-- /.card-body -->
    <div class="card-footer">
      <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item" v-for="link in links" :key="link.index">
          <a class="page-link" href="#" @click="showProviders(link.label)">{{
            link.label
          }}</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import NewProvider from "../components/NewProvider.vue";

export default {
  components: { BaseUrl, NewProvider },
  data() {
    return {
      provider: {
        identification_document_id: 1,
      },
      links: {},
      providers: {},
    };
  },
  created() {
    this.showProviders();
  },
  methods: {
    async showProviders(page = 1) {
      await BaseUrl.get(`/api/proveedores?sort=-id&page=${page}&perPage=10`)
        .then((response) => {
          this.providers = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    async createProvider() {
      await BaseUrl.post("/api/proveedores", this.provider)
        .then((response) => {
          console.log(response.data);
          $("#new-provider").modal("hide");
          this.provider = { identification_document_id: 1 };
          this.showProviders();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    deleteProvider(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`/api/proveedores/${id}`)
            .then((response) => {
              Swal.fire("Deleted!", response.data.message, "success");
              this.showProviders();
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
