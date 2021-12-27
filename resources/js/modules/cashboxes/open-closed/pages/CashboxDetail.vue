<template>
  <div class="row d-flex align-items-center">
    <div class="col-md-6 d-flex align-items-stretch flex-column">
      <div class="card bg-white d-flex flex-fill">
        <div class="card-header border-bottom-0 text-center">
          <h4>
            <strong>{{ details.cashbox_description }}</strong> - Resumen de
            apertura
          </h4>
        </div>
        <div class="card-body pt-0">
          <div class="row">
            <div class="col-7">
              <p class="lead"><b>Cajero: </b> {{ details.user_name }}</p>
              <p class="lead">
                <b>Fecha de apertura: </b> {{ details.opening_date }}
              </p>
              <p class="lead">
                <b>Monto de apertura: </b> S/. {{ details.opening_amount }}
              </p>
            </div>
            <div class="col-5 text-center">
              <img
                src="https://adminlte.io/themes/v3/dist/img/user4-128x128.jpg"
                alt="user-avatar"
                class="img-circle img-fluid"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row">
        <div class="col-md-6">
          <div class="info-box" @click="changeSelectedFilter('VENTA')">
            <span class="info-box-icon bg-navy">
              <i class="fas fa-money-check-alt"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Ventas</span>
              <span class="info-box-number">{{
                details.movementsTotal.sales
              }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-6">
          <div class="info-box" @click="changeSelectedFilter('COMPRA')">
            <span class="info-box-icon bg-warning">
              <i class="fas fa-shopping-basket"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">compras</span>
              <span class="info-box-number">{{
                details.movementsTotal.purchases
              }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="info-box" @click="changeSelectedFilter('INGRESO')">
            <span class="info-box-icon bg-teal">
              <i class="fas fa-hand-holding-usd"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Ingresos</span>
              <span class="info-box-number">{{
                details.movementsTotal.incomes
              }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>

        <div class="col-md-6">
          <div class="info-box" @click="changeSelectedFilter('EGRESO')">
            <span class="info-box-icon bg-maroon">
              <i class="fas fa-file-invoice-dollar"></i>
            </span>

            <div class="info-box-content">
              <span class="info-box-text">Egresos</span>
              <span class="info-box-number">{{
                details.movementsTotal.expenses
              }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <button
    class="btn btn-dark btn-block btn-lg mb-4"
    data-toggle="modal"
    data-target="#new-movement"
  >
    Nuevo movimiento
  </button>

  <form @submit.prevent="newMovement">
    <NewMovementVue
      :movement="movement"
      :errors="errors"
      :disabled="disabled"
    />
  </form>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Detalle de movementsTotal de caja</h3>

      <div class="card-tools">
        <div class="row">
          <div class="col-md">
            <select
              id="filterConceptSelected"
              @change="filterTypeConcept()"
              v-model="filterConceptSelected"
            >
              <option value="VENTA">Ventas</option>
              <option value="COMPRA">Compras</option>
              <option value="EGRESO">Egresos</option>
              <option value="INGRESO">Ingresos</option>
              <option value="TODOS" selected>Todos</option>
            </select>
          </div>
          <!-- <div class="col-md">
            <ul class="pagination pagination-sm float-right">
              <li class="page-item"><a class="page-link" href="#">«</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">»</a></li>
            </ul>
          </div> -->
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-responsive-sm table-hover">
        <thead>
          <tr>
            <th>Fecha y Hora</th>
            <th>Concepto</th>
            <th>Observación</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!movements.length" class="text-center p-4">
            <td colspan="4">
              <p class="lead">NO HAY MOVIMIENTOS REGISTRADOS</p>
            </td>
          </tr>
          <tr v-else v-for="movement in movements" :key="movement.id">
            <td>{{ movement.date }}</td>
            <td>{{ movement.concept }}</td>
            <td>{{ movement.observation }}</td>
            <td>{{ movement.amount }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="3" class="text-right">
              <strong>BALANCE TOTAL:</strong>
            </td>
            <td>
              {{
                parseFloat(
                  parseFloat(details.opening_amount, 3) +
                    parseFloat(details.movementsTotal.sales, 3) +
                    parseFloat(details.movementsTotal.incomes, 3) -
                    parseFloat(details.movementsTotal.expenses, 3) -
                    parseFloat(details.movementsTotal.purchases, 3) -
                    parseFloat(details.movementsTotal.account_to_pay, 3)
                ).toFixed(2)
              }}
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <button
    class="btn-outline-danger btn-lg btn-block mb-4"
    @click="closeCashbox"
  >
    <i class="fas fa-door-closed"></i>
    Cerrar Caja
  </button>
</template>
<script>
import BaseUrl from "../../../../api/BaseUrl";
import NewMovementVue from "../../components/NewMovement.vue";

export default {
  components: { BaseUrl, NewMovementVue },
  data() {
    return {
      movement: {
        type: "EGRESO",
      },
      details: {
        opening_date: {},
        movementsTotal: {
          sales: 0,
          incomes: 0,
          expenses: 0,
          purchase: 0,
        },
      },
      openClosedCashbox: {
        id: null,
      },
      movements: [],
      filterConceptSelected: "TODOS",
      errors: {},
      disabled: false,
    };
  },
  props: {},
  created() {
    this.showDetails();
  },
  methods: {
    async showDetails() {
      await BaseUrl.get(`/api/cashbox/detail/${this.$route.params.id}`)
        .then((response) => {
          this.details = response.data;

          this.openClosedCashbox.id = this.details.opening_id;
          this.openClosedCashbox.user_id = this.details.user_id;
          this.openClosedCashbox.cashbox_id = this.details.cashbox_id;

          this.movements = this.details.movements;
        })
        .catch((error) => {
          this.details = [];
          console.log(error.response);
        });
    },
    async newMovement() {
      this.disabled = true;
      await BaseUrl.post(
        `/api/cashbox/${this.$route.params.id}/movement`,
        this.movement
      )
        .then((response) => {
          console.log(response.data);
          this.showDetails();
          this.errors = {};
          this.movement = {};
          this.movement.type = "EGRESO";
          $("#new-movement").modal("hide");
          this.disabled = false;
        })
        .catch((error) => {
          console.log(error.response);
          this.errors = error.response.data.errors;
          this.disabled = false;
        });
    },
    async closeCashbox() {
      Swal.fire({
        title: "¿Esta seguro que desea cerrar caja?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Cerrar!",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.patch(
            `/api/cashbox/${this.openClosedCashbox.id}/close`,
            this.openClosedCashbox
          )
            .then((response) => {
              this.$router.push({ name: "layout-cashbox" });
              console.log(response.data);
              Swal.fire({
                icon: "sucess",
                title: "Caja Cerrada!",
                text: "Su caja se cerro satisfactoriamente.",
                footer: `<a class="btn btn-sm btn-outline-info" target="_blank" href="/print/cashbox/report/${response.data}"><i class="fas fa-file-invoice-dollar"></i> Ver reporte</a>`,
              });
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
    filterTypeConcept() {
      if (this.filterConceptSelected == "TODOS") {
        this.movements = this.details.movements;
      } else {
        this.movements = this.details.movements.filter(
          (e) => e.concept === this.filterConceptSelected
        );
      }
    },
    changeSelectedFilter(value) {
      document.getElementById("filterConceptSelected").value = value;
      this.filterConceptSelected = value;
      this.filterTypeConcept();
    },
    showModal(modal, cashbox = null) {
      if (cashbox !== null) {
        this.cashbox = cashbox;
      }
      $(modal).modal("show");
    },
  },
};
</script>

<style scoped>
.info-box {
  cursor: pointer;
}
</style>
