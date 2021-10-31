<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Compras</h1>
    </div>
  </div>

  <div class="container-fluid">
    <router-link
      class="btn btn-lg btn-block btn-dark mb-4"
      :to="{ name: 'new-purchase' }"
    >
      <i class="fas fa-plus"></i>
      Nueva Compra
    </router-link>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de compras</h3>

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
                  <th>Fecha</th>
                  <th>Comprobante</th>
                  <th>Moneda</th>
                  <th>Proveedor</th>
                  <th>Total</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="purchase in purchases" :key="purchase.id">
                  <td>
                    {{ purchase.date_issue }}
                  </td>
                  <td>
                    <span class="badge badge-danger">
                      {{ purchase.serie }} - {{ purchase.document_number }}
                    </span>
                    <br />
                    {{ purchase.document_type }}
                  </td>
                  <td>
                    {{ purchase.exchange_rate }}
                  </td>
                  <td>
                    {{ purchase.provider.name }}
                  </td>
                  <td>
                    {{ purchase.total }}
                  </td>
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
                        <a class="dropdown-item" href="#"
                          ><i class="col-1 mr-3 fas fa-eye"></i>Mostrar</a
                        ><a class="dropdown-item" href="#"
                          ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                        ><a class="dropdown-item" href="#" target="_blank"
                          ><i class="col-1 mr-3 far fa-file-pdf"></i>PDF</a
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
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";

export default {
  data() {
    return {
      purchases: [],
    };
  },
  mounted() {
    this.getPurchases();
  },
  methods: {
    async getPurchases() {
      await BaseUrl.get(`/api/purchases?included=provider&perPage=10`)
        .then((response) => {
          this.purchases = response.data.data;
        })
        .catch((response) => {
          console.log(error.response);
        });
    },
  },
};
</script>

<style>
</style>
