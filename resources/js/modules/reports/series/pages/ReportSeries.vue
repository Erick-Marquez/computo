<template>
  <form action="" @submit.prevent="generateReportSalesDetails()">
    <filters :filters="filters">
      <!-- <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Tipo de comprobante</label>
          <select
            class="form-control rounded-pill"
            v-model="filters.voucher_type_id"
          >
            <option :value="null">TODOS</option>
            <option :value="1">Factura Eléctronica</option>
            <option :value="2">Boleta Eléctronica</option>
            <option :value="3">Nota de Venta Eléctronica</option>
          </select>
        </div>
      </div> -->
      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Producto: </label>
          <select
            class="form-control rounded-pill"
            v-model="filters.product_id"
          >
            <option :value="null">TODOS</option>
            <option
              v-for="product in products"
              :key="product.id"
              :value="product.id"
            >
              {{ product.name }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Cliente:</label>
          <select
            class="form-control rounded-pill"
            v-model="filters.customer_id"
          >
            <option :value="null">TODOS</option>
            <option
              v-for="customer in customers"
              :key="customer.id"
              :value="customer.id"
            >
              {{ customer.name }} - {{ customer.document }}
            </option>
          </select>
        </div>
      </div>
    </filters>
  </form>

  <!-- tabla de reportes de Ventas -->
  <div class="card">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Rerporte de Venta Detallada</h3>
        <div class="card-tools">
          <a
            :href="`../../reports/details/print/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.customer_id}/${filters.product_id}`"
            target="_blank"
            v-show="sales_details.length >= 1"
            class="btn btn-flat btn-danger mr-2 rounded-pill"
          >
            <i class="fas fa-file-pdf"></i> PDF
          </a>
          <!-- <button class="btn btn-flat bg-olive rounded-pill">
            <i class="fas fa-file-pdf"></i> Excel
          </button> -->
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
                <th colspan="3">DETALLE DE PRODUCTO</th>
                <th colspan="3">COMPRA</th>
                <th colspan="3">VENTA</th>
              </tr>

              <tr>
                <th>SERIE</th>
                <th>PRODUCTO</th>
                <th>DETALLE</th>

                <th>FECHA</th>
                <th>PROVEEDOR</th>
                <th>PRECIO</th>

                <th>FECHA</th>
                <th>CLIENTE</th>
                <th>PRECIO</th>
              </tr>
            </thead>

            <tbody v-if="sales_details.length >= 1">
              <tr v-for="sale in sales_details" :key="sale.id">
                <td>{{ sale.date }}</td>
                <td>{{ sale.voucher_type }}</td>
                <td>{{ sale.serie }} - {{ sale.document_number }}</td>
                <td>{{ sale.cod }}</td>
                <td>{{ sale.name }}</td>

                <td>
                  {{ sale.brand }}
                </td>
                <td>{{ sale.line }}</td>
                <td>{{ sale.price }}</td>

                <td>{{ sale.quantity }}</td>
                <td>{{ sale.discount }}</td>
                <td>{{ sale.total_igv }}</td>
                <td>{{ sale.subtotal }}</td>
                <td>{{ sale.total }}</td>
                <td>{{ sale.series }}</td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="13">
                  <p class="lead">
                    <b>No existen Registros las fechas seleccionadas </b>
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
        fromDate: null,
        untilDate: null,
        voucher_type_id: null,
        customer_id: null,
        product_id: null,
      },
      sales_details: [],
      customers: [],
      products: [],
    };
  },
  mounted() {
    this.getCustomers();
    this.getProducts();
  },
  methods: {
    async generateReportSalesDetails() {
      await BaseUrl.post(`/api/reports/details`, this.filters)
        .then((response) => {
          console.log(response.data);
          this.sales_details = response.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getCustomers() {
      await BaseUrl.get(`/api/customers`)
        .then((response) => {
          this.customers = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getProducts() {
      await BaseUrl.get(`/api/products`)
        .then((response) => {
          this.products = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>

<style>
</style>
