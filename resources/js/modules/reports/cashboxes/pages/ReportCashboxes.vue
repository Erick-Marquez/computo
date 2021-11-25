<template>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label class="lead" for="">Caja:</label>
                <select
                  id="select-cajas"
                  class="js-states form-control rounded-pill"
                  style="width: 100%"
                >
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

            <div class="col-md-4">
              <div class="form-group">
                <label class="lead" for="">Desde:</label>
                <input
                  type="date"
                  class="form-control rounded-pill"
                  :max="maxDate"
                  v-model="fromDate"
                />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="lead" for="">Hasta:</label>
                <input
                  type="date"
                  class="form-control rounded-pill"
                  :max="maxDate"
                  v-model="untilDate"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <button class="btn btn-block btn-sm btn-dark" @click="searchOCC()">
            <i class="fas fa-search"></i>
            Buscar
          </button>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Aperturas y Cierres</h3>
          <div class="card-tools">
            <button class="btn btn-flat btn-danger mr-2 rounded-pill">
              <i class="fas fa-file-excel"></i> PDF
            </button>
            <button class="btn btn-flat bg-olive rounded-pill">
              <i class="fas fa-file-pdf"></i> Excel
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Apertura</th>
                  <th>Cierre</th>
                  <th>Usuario</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <tbody v-if="openClosedCashboxes.length >= 1">
                <tr v-for="occ in openClosedCashboxes" :key="occ.id">
                  <td>{{ occ.id }}</td>
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
                  <td>{{ occ.user.name }}</td>
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
                        <a class="dropdown-item" href="#">
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
      <!-- /.card -->
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
  components: { BaseUrl },
  data() {
    return {
      cashboxes: [],
      fromDate: null,
      untilDate: null,
      openClosedCashboxes: [],
    };
  },
  created() {
    this.getCajas();
    this.fromDate = this.dateToday();
    this.untilDate = this.dateToday();
  },
  mounted() {
    $("#select-cajas").select2();
    $(".select2-selection.select2-selection--single").addClass("rounded-pill");
  },
  methods: {
    async getCajas() {
      await BaseUrl.get(`/api/cajas`)
        .then((response) => {
          this.cashboxes = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getOCC(cashbox_id) {
      await BaseUrl.get(
        `/api/openClosedCashboxes?included=cashbox,user&filter[cashbox_id]=${cashbox_id}&filter[state]=false&dateInterval=${this.fromDate},${this.untilDate}`
      )
        .then((response) => {
          this.openClosedCashboxes = response.data.data;
          console.log(this.openClosedCashboxes);
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    searchOCC() {
      if (this.untilDate >= this.fromDate) {
        const cashbox_id = $("#select-cajas").val();
        this.getOCC(cashbox_id);
      } else {
      }
    },
    dateToday() {
      const date = new Date();
      return moment(date).format("YYYY-MM-DD");
    },
  },
  computed: {
    maxDate() {
      return this.dateToday();
    },
  },
};
</script>

<style>
</style>
