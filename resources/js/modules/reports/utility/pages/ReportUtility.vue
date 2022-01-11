<template>
  <form action="" @submit.prevent="generateReportUtility()">
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
    </filters>
  </form>

  <!-- tabla de reportes de Ventas -->
  <div class="row">
    <div class="col-md">
      <div class="card">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Utilidad por venta</h3>
            <div class="card-tools">
              <!-- <button class="btn btn-flat btn-danger mr-2 rounded-pill">
                <i class="fas fa-file-excel"></i> PDF
              </button>
              <button class="btn btn-flat bg-olive rounded-pill">
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
                    <th>NUM. DOC.</th>
                    <th>CLIENTE</th>
                    <th>F. EMISIÓN</th>
                    <th>TOTAL</th>
                    <th>UTILIDAD</th>
                  </tr>
                </thead>

                <tbody v-if="utility.length >= 1">
                  <tr v-for="sale in utility" :key="sale.id">
                    <td>
                      {{ sale.serie }}-{{ sale.document_number }}
                      <br />
                      {{ sale.voucher_type }}
                    </td>
                    <td>{{ sale.name }}</td>
                    <td>{{ sale.created_at }}</td>
                    <td>{{ sale.state === "ANULADO" ? 0 : sale.total }}</td>
                    <td>
                      {{
                        (sale.utility2 =
                          sale.state === "ANULADO"
                            ? 0
                            : sale.total_discount === 0
                            ? parseFloat(sale.utility).toFixed(2)
                            : parseFloat(sale.utility).toFixed(2) -
                              sale.total_discount)
                      }}
                    </td>
                  </tr>
                </tbody>
                <tfoot v-if="utility.length >= 1">
                  <tr>
                    <td colspan="4" class="text-right">
                      <strong>TOTAL:</strong>
                    </td>
                    <td>
                      {{
                        utility
                          .reduce((previousValue, currentValue) => {
                            return (
                              parseFloat(previousValue) +
                              parseFloat(currentValue.utility2)
                            );
                          }, 0)
                          .toFixed(2)
                      }}
                    </td>
                  </tr>
                </tfoot>
                <tbody v-else>
                  <tr>
                    <td colspan="5">
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
    </div>
    <div class="col-md">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Productos mas vendidos</h3>
        </div>
        <div class="card-body">
          <most-selled-products :msp="msp"></most-selled-products>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Filters from "../../../../compositions/Filters.vue";
import MostSelledProducts from "../components/MostSelledProducts.vue";
import BaseUrl from "../../../../api/BaseUrl";

export default {
  components: { Filters, MostSelledProducts },
  data() {
    return {
      filters: {
        branch_id: null,
        fromDate: null,
        untilDate: null,
        voucher_type_id: null,
        customer_id: null,
      },
      utility: [],
      msp: [],
      customers: [],
    };
  },
  mounted() {
    this.getCustomers();
  },
  methods: {
    async generateReportUtility() {
      await BaseUrl.post(`/api/reports/utility`, this.filters)
        .then((response) => {
          console.log(response.data);
          this.utility = response.data.utility;
          this.msp = response.data.msp;
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
