<template>
  <form action="" @submit.prevent="generateReportProducts()">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md">
            <div class="form-group">
              <label for="" class="lead">Sucursal</label>
              <select
                class="form-control rounded-pill"
                v-model="filters.branch_id"
              >
                <option :value="null" disabled>Seleccione una sucursal</option>
                <option
                  v-for="branch in branches"
                  :key="branch.id"
                  :value="branch.id"
                >
                  {{ branch.description }}
                </option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <slot></slot>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-block btn-sm btn-dark">
          <i class="fas fa-search"></i>
          Buscar
        </button>
      </div>
    </div>
  </form>

  <!-- tabla de reportes de productos -->
  <div class="card">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Rerporte de Productos</h3>
        <div class="card-tools" v-show="products.length >= 1">
          <a
            :href="`/reports/products/pdf/${filters.branch_id}`"
            target="_blank"
            class="btn btn-flat btn-danger mr-2 rounded-pill"
          >
            <i class="fas fa-file-pdf"></i> PDF
          </a>
          <a
            class="btn btn-flat bg-olive rounded-pill"
            :href="`/reports/products/excel/${filters.branch_id}`"
          >
            <i class="fas fa-file-excel"></i> Excel
          </a>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table
            class="table table-hover table-bordered text-nowrap text-center"
          >
            <thead>
              <tr>
                <th>COD</th>
                <th>PRODUCTO</th>
                <th>LINEA</th>
                <th>MARCA</th>
                <th>STOCK</th>
                <th>PRECIO COMPRA</th>
                <th>PRECIO 1</th>
                <th>PRECIO 2</th>
                <th>PRECIO 3</th>
                <th>ACTIVO</th>
              </tr>
            </thead>

            <tbody v-if="products.length >= 1">
              <tr v-for="product in products" :key="product.id">
                <td>{{ product.cod }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.line }}</td>
                <td>{{ product.brand }}</td>
                <td>{{ product.stock }}</td>
                <td>{{ product.referential_purchase_price }}</td>
                <td>{{ product.sale_price }}</td>
                <td>{{ product.referential_sale_price_one }}</td>
                <td>{{ product.referential_sale_price_two }}</td>
                <td>{{ product.active ? "SI" : "NO" }}</td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="10">
                  <p class="lead">
                    <b>No existen Registros de las fechas seleccionadas </b>
                  </p>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</template>

<script>
import Filters from "../../../../compositions/Filters.vue";
import BaseUrl from "../../../../api/BaseUrl";

export default {
  components: { Filters },
  data() {
    return {
      filters: {
        branch_id: null,
      },
      products: [],
      branches: [],
    };
  },
  mounted() {
    this.getBranches();
  },
  methods: {
    async generateReportProducts() {
      await BaseUrl.post(`/api/reports/products`, this.filters)
        .then((response) => {
          console.log(response.data);
          this.products = response.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getBranches() {
      await BaseUrl.get(`/api/branches`)
        .then((response) => {
          this.branches = response.data.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>

<style>
</style>
