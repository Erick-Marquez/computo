<template>
  <form action="" @submit.prevent="generateReportPurchases()">
    <filters :filters="filters">
      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Tipo de comprobante</label>
          <select
            class="form-control rounded-pill"
            v-model="filters.document_type"
          >
            <option :value="null">TODOS</option>
            <option :value="'BOLETA'">BOLETA</option>
            <option :value="'FACTURA'">FACTURA</option>
            <option :value="'NOTA DE VENTA'">NOTA DE VENTA</option>
          </select>
        </div>
      </div>
      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Proveedor:</label>
          <select
            class="form-control rounded-pill"
            v-model="filters.provider_id"
          >
            <option :value="null">TODOS</option>
            <option
              v-for="provider in providers"
              :key="provider.id"
              :value="provider.id"
            >
              {{ provider.name }} - {{ provider.document }}
            </option>
          </select>
        </div>
      </div>
    </filters>
  </form>

  <!-- tabla de reportes de compras -->
  <div class="card">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Rerporte de Compras</h3>
        <div class="card-tools" v-show="purchases.length >= 1">
          <a
            :href="`/reports/purchases/pdf/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.provider_id}/${filters.document_type}`"
            target="_blank"
            class="btn btn-flat btn-danger mr-2 rounded-pill"
          >
            <i class="fas fa-file-pdf">PDF</i>
          </a>
          <a
            :href="`/reports/purchases/excel/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.provider_id}/${filters.document_type}`"
            class="btn btn-flat bg-olive rounded-pill"
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
                <th colspan="3">INFORMACIÓN PROVEEDOR</th>
                <th colspan="5">IMPORTES DE LA OPERACIÓN</th>
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
                <th>IGV</th>
                <th>TOTAL</th>
                <th>MONEDA</th>
                <th>T.C</th>
              </tr>
            </thead>

            <tbody v-if="purchases.length >= 1">
              <tr v-for="purchase in purchases" :key="purchase.id">
                <td>{{ purchase.date_issue }}</td>
                <td>{{ purchase.document_type }}</td>
                <td>{{ purchase.serie }}</td>
                <td>{{ purchase.document_number }}</td>

                <td>
                  {{ purchase.provider_document_type }}
                </td>
                <td>{{ purchase.provider_document }}</td>
                <td>{{ purchase.provider_name }}</td>

                <td>{{ purchase.subtotal }}</td>
                <td>{{ purchase.total_igv }}</td>
                <td>{{ purchase.total }}</td>
                <td>{{ purchase.handles_exchange_rate ? "USD" : "PEN" }}</td>
                <td>{{ purchase.exchange_rate }}</td>
              </tr>
            </tbody>
            <tbody v-else>
              <tr>
                <td colspan="12">
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
        document_type: null,
        provider_id: null,
      },
      purchases: [],
      providers: [],
    };
  },
  mounted() {
    this.getProviders();
  },
  methods: {
    async generateReportPurchases() {
      await BaseUrl.post(`/api/reports/purchases`, this.filters)
        .then((response) => {
          console.log(response.data);
          this.purchases = response.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getProviders() {
      await BaseUrl.get(`/api/providers`)
        .then((response) => {
          this.providers = response.data.data;
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
