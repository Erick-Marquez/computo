<template>
  <form action="" @submit.prevent="generateReportMovements()">
    <filters :filters="filters" v-on:changeBranch="getCashboxes()">
      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Caja:</label>
          <select
            class="form-control rounded-pill"
            v-model="filters.cashbox_id"
          >
            <option :value="null">TODOS</option>
            <option
              v-for="cashbox in cashboxes"
              :key="cashbox.id"
              :value="cashbox.id"
            >
              {{ cashbox.description }}
            </option>
          </select>
        </div>
      </div>

      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Tipo de movimiento:</label>
          <select
            class="form-control rounded-pill"
            v-model="filters.movement_type"
            @change="changeMovementType"
          >
            <option :value="null">TODOS</option>
            <option value="EGRESO">EGRESO</option>
            <option value="INGRESO">INGRESO</option>
            <option value="REMUNERACION">REMUNERACIÓN</option>
          </select>
        </div>
      </div>
      <div v-if="filters.movement_type == 'REMUNERACION'" class="col-md">
        <div class="form-group">
          <label class="lead" for="">Personal:</label>
          <v-select
            class="style-chooser"
            v-model="filters.user_id"
            placeholder="TODOS"
            label="name"
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

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Aperturas y Cierres</h3>
      <div class="card-tools" v-show="movements.length >= 1">
          <a
            :href="`/reports/movements/pdf/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.cashbox_id}/${filters.movement_type}/${filters.user_id}`"
            target="_blank"
            class="btn btn-flat btn-danger mr-2 rounded-pill"
          >
            <i class="fas fa-file-pdf"></i> PDF
          </a>
          <a
            class="btn btn-flat bg-olive rounded-pill"
            target="_blank"
            :href="`/reports/movements/excel/${filters.fromDate}/${filters.untilDate}/${filters.branch_id}/${filters.cashbox_id}/${filters.movement_type}/${filters.user_id}`"
          >
            <i class="fas fa-file-excel"></i> Excel
          </a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Fecha y Hora</th>
              <th>Concepto</th>
              <th>Tipo de pago</th>
              <th>Observación</th>
              <th>Monto</th>
              <th>Print</th>
            </tr>
          </thead>

          <tbody v-if="movements.length >= 1">
            <tr v-for="mov in movements" :key="mov.id">
              <td>{{ mov.created_at }}</td>
              <td>{{ mov.type }}</td>
              <td>{{ mov.payment_type }}</td>
              <td>{{ mov.observation }}</td>
              <td>{{ mov.amount }}</td>
              <td>
                <a
                  class="btn btn-flat btn-default"
                  target="_blank"
                  :href="`/print/movement/${mov.id}`"
                >
                  <span class="text-success"
                    ><i class="fas fa-file-alt"></i
                  ></span>
                </a>
              </td>
            </tr>
          </tbody>
          <tbody v-else>
            <tr>
              <td colspan="5">
                <p class="text-center lead">
                  <b
                    >No existen Registros de la Caja relacionados a las
                    fechas</b
                  >
                </p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import Filters from "../../../../compositions/Filters.vue";

export default {
  components: { BaseUrl, Filters },
  data() {
    return {
      filters: {
        branch_id: null,
        fromDate: null,
        untilDate: null,
        cashbox_id: null,
        user_id: null,
        movement_type: null,
      },

      sellers: [],
      cashboxes: [],
      movements: [],
    };
  },
  mounted() {
    this.getCashboxes();
    this.getSellers();
  },
  methods: {
    async getCashboxes() {
      await BaseUrl.get(
        `/api/cajas?filter[branch_id]=${
          this.filters.branch_id == null ? "" : this.filters.branch_id
        }`
      )
        .then((response) => {
          this.cashboxes = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async generateReportMovements() {
      await BaseUrl.post(`/api/reports/movements`, this.filters)
        .then((response) => {
          this.movements = response.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getSellers() {
      await BaseUrl.get(`/api/users`)
        .then((response) => {
          this.sellers = response.data.data;
          this.sellers.push({ name: "TODOS", id: null });
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    changeMovementType() {
      this.filters.user_id = null;
    },
  },
  computed: {},
};
</script>

<style>
</style>
