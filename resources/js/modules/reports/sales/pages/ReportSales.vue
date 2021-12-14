<template>
  <form action="" @submit.prevent="generateReportSales()">
    <filters :filters="filters">
      <div class="col-md">
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
        <h3 class="card-title">Rerporte de Ventas</h3>
        <div class="card-tools">
          <a :href="`../../reports/sales/print/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.customer_id}/${filters.voucher_type_id}`" target="_blank" v-show="sales.length >= 1" class="btn btn-flat btn-danger mr-2 rounded-pill">
            <i class="fas fa-file-excel"></i> PDF
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
                <th colspan="4">DATOS DE COMPROBANTE</th>
                <th colspan="3">INFORMACIÓN DE CLIENTE</th>
                <th colspan="7">IMPORTES DE LA OPERACIÓN</th>
              </tr>
              <tr>
                <th>F. DE EMISIÓN</th>
                <th>TIPO DOC</th>
                <th>SERIE</th>
                <th>NUMERO</th>

                <th>T. DOC</th>
                <th>NUMERO</th>
                <th>RAZON SOCIAL</th>

                <th>OP. GRAVADA</th>
                <th>DESC.</th>
                <th>IGV</th>
                <th>OP. EXONERADA</th>
                <th>OP. INAFECTA</th>
                <th>TOTAL</th>
                <th>ESTADO</th>
              </tr>
            </thead>

            <tbody v-if="sales.length >= 1">
              <tr v-for="sale in sales" :key="sale.id">
                <td>{{ sale.date_issue }}</td>
                <td>{{ sale.voucher_type }}</td>
                <td>{{ sale.serie }}</td>
                <td>{{ sale.document_number }}</td>

                <td>
                  {{ sale.customer_document_type }}
                </td>
                <td>{{ sale.customer_document }}</td>
                <td>{{ sale.customer_name }}</td>

                <td>{{ sale.subtotal }}</td>
                <td>{{ sale.discount }}</td>
                <td>{{ sale.total_igv }}</td>
                <td>{{ sale.total_exonerated }}</td>
                <td>{{ sale.total_unaffected }}</td>
                <td>{{ sale.total }}</td>
                <td>{{ sale.state }}</td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="14">
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
      },
      sales: [],
      customers: [],
    };
  },
  mounted() {
    this.getCustomers();
  },
  methods: {
    async generateReportSales() {
      await BaseUrl.post(`/api/reports/sales`, this.filters)
        .then((response) => {
          console.log(response.data);
          this.sales = response.data;
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
  },
};
</script>

<style>
</style>
