<template>
  <button
    class="btn btn-dark btn-block btn-lg mb-4"
    data-toggle="modal"
    data-target="#new-customer"
  >
    Nuevo Cliente
  </button>

  <form @submit.prevent="createCustomer">
    <NewCustomer :customer="customer" :errors="errors" />
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
          <tr v-for="(customer, index) in customers" :key="customer.id">
            <td class="text-wrap" style="width: 40%">{{ customer.name }}</td>
            <td style="width: 10%">
              <span class="badge bg-maroon">{{
                customer.identification_document.description
              }}</span>
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
                <strong>Ubigeo: </strong>
                {{
                  customer.ubigee == null
                    ? "ninguno"
                    : customer.ubigee.place_description
                }}
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
                  <a class="dropdown-item" @click="editModal(index)"
                    ><i class="col-1 mr-3 fas fa-edit"></i>
                    Editar
                  </a>
                  <a class="dropdown-item" href="#" @click="deleteCustomer(id)">
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
      <Paginator :links="links" v-on:getDataPaginate="getCustomers" />
    </div>
  </div>

  <form action="" @submit.prevent="editCustomer">
      <EditCustomer :customer="editCustomer" :errors="errors" />
  </form>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import NewCustomer from "../components/NewCustomer.vue";
import Paginator from "../../../../compositions/Paginator.vue";
import EditCustomer from "../components/EditCustomer.vue";

export default {
  components: { BaseUrl, NewCustomer, Paginator, EditCustomer },
  data() {
    return {
      customer: {
        identification_document_id: 1,
      },
      editCustomer: {},
      links: {},
      customers: {},
      errors: [],
    };
  },

  created() {
    this.getCustomers();
  },
  methods: {
    async getCustomers() {
      await BaseUrl.get(
        `/api/customers?included=ubigee,identificationDocument&sort=-id&perPage=10&page=${this.$route.query.page}`
      )
        .then((response) => {
          this.customers = response.data.data;
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    async createCustomer() {
      await BaseUrl.post("/api/customers", this.customer)
        .then((response) => {
          $("#new-customer").modal("hide");
          Swal.fire("Cliente Registrado", "Exito!!", "success");
          console.log(response.data);
          this.customer = {};
          this.errors = [];
          this.getCustomers();
        })
        .catch((error) => {
          console.log(error.response);
          this.errors = error.response.data.errors;
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
          BaseUrl.delete(`/api/customers/${id}`)
            .then((response) => {
              Swal.fire("Deleted!", response.data.message, "success");
              this.getCustomers();
            })
            .catch((error) => {
              console.log(error.response);
            });
        }
      });
    },

    async editCustomer() {
      await BaseUrl.put(`/api/customers/${this.customer.id}`, this.customer)
        .then((response) => {
          $("#new-customer").modal("hide");
          Swal.fire("Cliente Registrado", "Exito!!", "success");
          this.getCustomers();
        })
        .catch((error) => {
          console.log(error.response);
          this.errors = error.response.data.errors;
        });
    },

    editModal(index) {
      $("#edit-customer").modal("show");
      this.editCustomer.id = this.customers[index].id;
      this.editCustomer.document = this.customers[index].document;
      this.editCustomer.identification_document_id =
        this.customers[index].identification_document.id;
      this.editCustomer.name = this.customers[index].name;
      this.editCustomer.ubigee_id =
        this.customers[index].ubigee != null
          ? this.customers[index].ubigee.id
          : null;
      this.editCustomer.adress = this.customers[index].adress;
      this.editCustomer.phone = this.customers[index].phone;
      this.editCustomer.email = this.customers[index].email;
    },
  },
};
</script>

<style>
</style>
