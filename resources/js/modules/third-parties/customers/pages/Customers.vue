<template>
  <button
    class="btn btn-dark btn-block btn-lg mb-4"
    data-toggle="modal"
    data-target="#new-customer"
  >
    Nuevo Cliente
  </button>

  <form @submit.prevent="createCustomer">
    <NewCustomer :customer="customer" />
  </form>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Listado de clientes</h3>

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
            <th>Documento</th>
            <th>Datos</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="customer in customers" :key="customer.id">
            <td class="text-wrap" style="width: 40%">{{ customer.name }}</td>
            <td style="width: 10%">
              <span class="badge bg-maroon">{{ customer.type_document }}</span>
              <br />
              {{ customer.document }}
            </td>
            <td class="text-wrap" style="width: 40%">
              <p class="font-weight-light">
                <strong>Telefono: </strong>
                {{ customer.phone == null ? "ninguno" : customer.phone }}
              </p>
              <p class="font-weight-light">
                <strong>Email: </strong>
                {{ customer.email == null ? "ninguno" : customer.email }}
              </p>
              <p class="font-weight-light">
                <strong>Dirección: </strong>
                {{ customer.address == null ? "ninguno" : customer.address }}
              </p>
            </td>
            <td style="width: 10%">
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
                    @click="deleteCustomer(customer.id)"
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
          <a class="page-link" href="#" @click="showCustomers(link.label)">{{
            link.label
          }}</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import baseUrl from "../../../../api/BaseUrl";
import BaseUrl from "../../../../api/BaseUrl";
import NewCustomer from "../components/NewCustomer.vue";

export default {
  components: { BaseUrl, NewCustomer },
  data() {
    return {
      customer: {
        identification_document_id: 1,
      },
      links: {},
      customers: {},
    };
  },
  created() {
    this.showCustomers();
  },
  methods: {
    async showCustomers(page = 1) {
      await BaseUrl.get(`/api/clientes?sort=-id&page=${page}&perPage=10`)
        .then((response) => {
          this.customers = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    async createCustomer() {
      await BaseUrl.post("/api/clientes", this.customer)
        .then((response) => {
          console.log(response.data);
          $("#new-customer").modal("hide");
          this.customer = {};
          this.showCustomers();
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    deleteCustomer(id) {
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
          BaseUrl.delete(`/api/clientes/${id}`)
            .then((response) => {
              Swal.fire("Deleted!", response.data.message, "success");
              this.showCustomers();
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
