<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Compras</h1>
    </div>
  </div>

  <div class="container-fluid">
    <a class="btn btn-lg btn-block btn-dark mb-4" href="/nueva-compra">
      <i class="fas fa-plus"></i>
      Nueva Compra
    </a>
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
                  v-model.trim="searchPurchase"
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
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Comprobante</th>
                  <th>Moneda</th>
                  <th>Proveedor</th>
                  <th>Total</th>
                  <th>Estado</th>
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
                    <span class="badge badge-success">{{
                      purchase.handles_exchange_rate ? "USD" : "PEN"
                    }}</span>
                    <br />
                    {{ purchase.exchange_rate }}
                  </td>
                  <td>
                    {{ purchase.provider.name }}
                  </td>
                  <td>
                    {{ purchase.handles_exchange_rate ? "$" : "S/." }}
                    {{ purchase.total }}
                  </td>
                  <td v-if="purchase.account_to_pay != null">
                    <span
                      v-if="purchase.account_to_pay.debt == 0"
                      class="badge badge-success"
                      >Cancelado</span
                    >
                    <span v-else class="badge badge-danger">Pendiente</span>
                  </td>
                  <td v-else>
                    <span class="badge badge-info">Sin credito</span>
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
                        <!-- <a class="dropdown-item" href="#"
                          ><i class="col-1 mr-3 fas fa-eye"></i>Mostrar</a
                        ><a class="dropdown-item" href="#"
                          ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                        >-->

                        <a
                          class="dropdown-item"
                          :href="`print/purchase/${purchase.id}`"
                          target="_blank"
                        >
                          <i class="col-1 mr-3 far fa-file-pdf"></i>
                          PDF
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
            <Paginator :links="links" v-on:getDataPaginate="getPurchases" />
          </div>
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
  components: { Paginator },
  data() {
    return {
      purchases: [],
      links: {},

      searchingTable: [],
      searchPurchase: "",
    };
  },
  mounted() {
    this.getPurchases();
  },
  methods: {
    async getPurchases() {
      await BaseUrl.get(
        `/api/purchases?included=provider,accountToPay&sort=-id&search[serie]=${this.searchPurchase}&search[document_number]=${this.searchPurchase}&search[document_type]=${this.searchPurchase}&perPage=10&page=${this.$route.query.page}`
      )
        .then((response) => {
          this.purchases = response.data.data;
          this.links = response.data.meta.links;
          console.log(this.purchases);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    async searchTable() {
      clearTimeout(this.searchingTable);
      this.searchingTable = setTimeout(this.getPurchases, 300);
    },

  },
};
</script>

<style>
</style>
