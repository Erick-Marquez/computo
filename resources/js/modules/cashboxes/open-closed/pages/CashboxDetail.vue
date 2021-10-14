<template>
  <div class="container-fluid">
    <!-- <div class="row">
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info">
            <i class="fas fa-money-check-alt"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Ventas</span>
            <span class="info-box-number">{{ details.balance.sales }}</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-success">
            <i class="fas fa-hand-holding-usd"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Ingresos</span>
            <span class="info-box-number">{{ details.balance.incomes }}</span>
          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-warning">
            <i class="fas fa-file-invoice-dollar"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Egresos</span>
            <span class="info-box-number">{{ details.balance.expenses }}</span>
          </div>
        </div>
      </div>
    </div> -->

    <div class="row">
      <div class="col-md-6 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
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
          <div class="col-md">
            <div class="info-box">
              <span class="info-box-icon bg-navy">
                <i class="fas fa-money-check-alt"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">Ventas</span>
                <span class="info-box-number">{{ details.balance.sales }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <div class="row">
          <div class="col-md">
            <div class="info-box">
              <span class="info-box-icon bg-teal">
                <i class="fas fa-hand-holding-usd"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">Ingresos</span>
                <span class="info-box-number">{{
                  details.balance.incomes
                }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md">
            <div class="info-box">
              <span class="info-box-icon bg-maroon">
                <i class="fas fa-file-invoice-dollar"></i>
              </span>

              <div class="info-box-content">
                <span class="info-box-text">Egresos</span>
                <span class="info-box-number">{{
                  details.balance.expenses
                }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6 col-12">
        <button
          type="button"
          class="btn btn-dark btn-lg btn-block mb-3"
          @click="showModal('#new-income')"
        >
          <i class="fas fa-plus"></i>
          Nuevo Ingreso
        </button>
      </div>
      <div class="col-md-6 col-sm-6 col-12">
        <button
          type="button"
          class="btn btn-danger btn-lg btn-block mb-3"
          @click="showModal('#new-expense')"
        >
          <i class="fas fa-minus"></i>
          Nuevo Egreso
        </button>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Detalle de balance de caja</h3>

        <div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Fecha y Hora</th>
              <th>Concepto</th>
              <th>Observación</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="movement in details.movements" :key="movement.id">
              <td>{{ movement.date }}</td>
              <td>{{ movement.concept }}</td>
              <td>{{ movement.observation }}</td>
              <td>{{ movement.amount }}</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" class="text-right"><strong>Balance:</strong></td>
              <td>
                {{
                  parseFloat(details.opening_amount, 3) +
                  parseFloat(details.balance.sales, 3) +
                  parseFloat(details.balance.incomes, 3) -
                  parseFloat(details.balance.expenses, 3)
                }}
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>

  <!-- Modales -->
  <div class="modal fade" id="new-income" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Ingreso</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="newIncome()">
          <div class="modal-body">
            <div class="form-group">
              <label for="">Importe</label>
              <input
                type="number"
                class="form-control"
                v-model="income.amount"
                required
              />
            </div>
            <div class="form-group">
              <label for="">Observacion</label>
              <textarea
                class="form-control"
                rows="5"
                placeholder="Observacion..."
                v-model="income.observation"
              ></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <button
    class="btn-outline-danger btn-lg btn-block mb-4"
    @click="closeCashbox"
  >
    <i class="fas fa-door-closed"></i>
    Cerrar Caja
  </button>

  <div class="modal fade" id="new-expense" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Egreso</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="newExpense()">
          <div class="modal-body">
            <div class="form-group">
              <label for="">Importe</label>
              <input
                type="number"
                class="form-control"
                v-model="expense.amount"
                required
              />
            </div>
            <div class="form-group">
              <label for="">Observacion</label>
              <textarea
                class="form-control"
                rows="5"
                placeholder="Observacion..."
                v-model="expense.observation"
              ></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import BaseUrl from "../../../../api/BaseUrl";
import axios from "axios";
export default {
  components: { BaseUrl },
  data() {
    return {
      income: {},
      expense: {},
      details: {
        balance: {
          sales: 0,
          incomes: 0,
          expenses: 0,
        },
      },
      cashbox: {},
    };
  },
  props: {
  },
  created() {
    this.showDetails();
  },
  methods: {
    async showDetails() {
      await BaseUrl.get(`/api/cashbox/detail/${this.$route.params.id}`)
        .then((response) => {
          this.details = response.data;
          console.log(this.details);
        })
        .catch((error) => {
          this.details = [];
          console.log(error);
        });
    },
    async newIncome() {
      await BaseUrl.post(
        `/api/cashbox/${this.$route.params.id}/income`,
        this.income
      )
        .then((response) => {
          $("#new-income").modal("hide");
          this.showDetails();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async newExpense() {
      await BaseUrl.post(
        `/api/cashbox/${this.$route.params.id}/expense`,
        this.expense
      )
        .then((response) => {
          $("#new-expense").modal("hide");
          this.showDetails();
        })
        .catch((error) => {
          console.log(error);
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
        BaseUrl.patch(
          `/api/cashbox/${this.$route.params.id}/close`,
          this.cashbox
        )
          .then((response) => {
            $("#new-expense").modal("hide");
            this.showDetails();
          })
          .catch((error) => {
            console.log(error);
          });
        if (result.isConfirmed) {
          this.$router.push({ name: "layout-cashbox" });
          Swal.fire(
            "Cerrado!",
            "Su caja se cerro satisfactoriamente.",
            "success"
          );
        }
      });
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

<style>
</style>
