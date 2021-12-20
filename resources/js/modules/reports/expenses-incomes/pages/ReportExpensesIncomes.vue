<template>
  <form action="" @submit.prevent="generateReportCashboxes()">
    <filters :filters="filters" v-on:changeBranch="getCashboxes()">
      <div class="col-md">
        <div class="form-group">
          <label class="lead" for="">Caja:</label>
          <select class="form-control rounded-pill" v-model="filters.cashbox_id">
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
    </filters>
  </form>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Aperturas y Cierres</h3>
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
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Caja</th>
              <th>Apertura</th>
              <th>Cierre</th>
              <th>Usuario</th>
              <th>Acciones</th>
            </tr>
          </thead>

          <tbody v-if="openClosedCashboxes.length >= 1">
            <tr v-for="occ in openClosedCashboxes" :key="occ.id">
              <td>{{ occ.cashbox_name }}</td>
              <td>
                <p class="lead">
                  Fecha: <b>{{ occ.opening_date }}</b>
                </p>
                <hr />
                <p class="lead">
                  Monto: <b>{{ occ.opening_amount }}</b>
                </p>
              </td>
              <td>
                <p class="lead">
                  Fecha: <b>{{ occ.closing_date }}</b>
                </p>
                <hr />
                <p class="lead">
                  Monto: <b>{{ occ.closing_amount }}</b>
                </p>
              </td>
              <td>{{ occ.user_name}}</td>
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
                    <a
                      class="dropdown-item"
                      target="_blank"
                      :href="'/print/cashbox/report/' + occ.id"
                    >
                      <i class="col-1 mr-3 fas fa-edit"></i>
                      PDF
                    </a>
                    <!-- <a class="dropdown-item" href="#">
                          <i class="col-1 mr-3 fas fa-edit"></i>
                          Eliminar
                        </a> -->
                  </div>
                </div>
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
      },

      cashboxes: [],
      openClosedCashboxes: [],
    };
  },
  mounted() {
    this.getCashboxes();
  },
  methods: {
    async getCashboxes() {
      await BaseUrl.get(`/api/cajas?filter[branch_id]=${this.filters.branch_id == null ? '' : this.filters.branch_id}`)
        .then((response) => {
          this.cashboxes = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async generateReportCashboxes() {
      await BaseUrl.post(`/api/reports/cashboxes`, this.filters)
        .then((response) => {
          this.openClosedCashboxes = response.data;
          console.log(this.openClosedCashboxes);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    doSomething() {
        console.log('algo');
    }
  },
  computed: {},
};
</script>

<style>
</style>
