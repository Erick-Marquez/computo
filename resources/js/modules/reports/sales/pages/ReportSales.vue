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
          <v-select
            class="style-chooser"
            v-model="filters.customer_id"
            label="name"
            placeholder="TODOS"
            :reduce="(customer) => customer.id"
            :options="customers"
          >
            <template v-slot:no-options="{ search, searching }">
              <template v-if="searching">
                No se encontraron resultados para
                <b
                  ><em>{{ search }}</em></b
                >.
              </template>
            </template>
          </v-select>
        </div>
      </div>
      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Vendedor:</label>
          <v-select
            class="style-chooser"
            v-model="filters.seller_id"
            label="name"
            placeholder="TODOS"
            :reduce="(seller) => seller.id"
            :options="sellers"
          >
            <template v-slot:no-options="{ search, searching }">
              <template v-if="searching">
                No se encontraron resultados para
                <b
                  ><em>{{ search }}</em></b
                >.
              </template>
            </template>
          </v-select>
        </div>
      </div>
    </filters>
  </form>

  <!-- tabla de reportes de Ventas -->
  <div class="card">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Reporte de Ventas</h3>
        <div class="card-tools" v-show="sales.length >= 1">
          <a
            :href="`/reports/sales/pdf/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.customer_id}/${filters.voucher_type_id}/${filters.seller_id}`"
            target="_blank"
            class="btn btn-flat btn-danger mr-2 rounded-pill"
          >
            <i class="fas fa-file-pdf"></i> PDF
          </a>
          <a
            class="btn btn-flat bg-olive rounded-pill"
            target="_blank"
            :href="`/reports/sales/excel/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.customer_id}/${filters.voucher_type_id}/${filters.seller_id}`"
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
                <th style="width: 20%">RAZON SOCIAL</th>

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
                <td class="text-wrap">{{ sale.customer_name }}</td>

                <td>{{ sale.subtotal }}</td>
                <td>{{ sale.total_discount }}</td>
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
        seller_id: null,
      },
      sales: [],
      customers: [],
      sellers: [],
    };
  },
  mounted() {
    this.getCustomers();
    this.getSellers();
    console.log(this.customers);
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
          this.customers.push({ name: "TODOS", id: null });
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getSellers() {
      await BaseUrl.get(`/api/roles/Vendedor/users`)
        .then((response) => {
          this.sellers = response.data;
          this.sellers.push({ name: "TODOS", id: null });
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>

<style>
.style-chooser .vs__dropdown-toggle {
  border-radius: 50px;
  width: 100%;
  height: calc(2.25rem + 2px);
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border-color: #ced4da;
  box-shadow: inset 0 0 0 transparent;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
  fill: #394066;
}
</style>
