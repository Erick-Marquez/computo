<template>
  <form @submit.prevent=""></form>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Lista de cuentas por pagar</h3>

      <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px">
          <input
            type="text"
            name="table_search"
            class="form-control float-right"
            placeholder="Search"
          />

          <div class="input-group-append">
            <button type="submit" class="btn btn-default">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Serie de compra</th>
            <th>Proveedor</th>
            <th>Deuda</th>
            <th>Total Pagado</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="account in accounts" :key="account.id">
            <td>
              {{ transformDateTime(account.created) }}
            </td>
            <td>
              <span class="badge badge-danger">
                {{ account.purchase.serie }} -
                {{ account.purchase.document_number }}
              </span>
            </td>
            <td>{{ account.purchase.provider.name }}</td>
            <td>{{ account.debt }}</td>
            <td>{{ account.residue }}</td>
            <td>
              <span v-if="account.debt != 0" class="badge badge-danger"
                >Pendiente</span
              >
              <span v-else class="badge badge-success">Cancelado</span>
            </td>
            <td>
              <div class="dropdown">
                <button
                  class="btn btn-sm btn-fat btn-outline-success"
                  @click="openModalAccountToPay(account.id)"
                >
                  <i class="fas fa-money-bill"></i>
                  Pagar
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>

  <form @submit.prevent="storeNewPay">
    <div
      class="modal fade"
      tabindex="-1"
      id="pay-account"
      aria-labelledby="pay-account"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Pagar Deuda</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 6%">#</th>
                    <th style="width: 20%">Fecha</th>
                    <th style="width: 30%">Método de pago</th>
                    <th style="width: 30%" class="text-center">Monto</th>
                    <th style="width: 15%">Accion</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- mostrar lista de pago de cuentas -->
                  <tr v-for="detail in account.details" :key="detail.id">
                    <td>{{ detail.installment }}</td>
                    <td>{{ detail.date_issue }}</td>

                    <td v-if="detail.payment == null">
                      <select
                        :class="$errorsClass(errors['payment_type_id'])"
                        v-model="detail.payment_type_id"
                      >
                        <option
                          :value="pt.id"
                          v-for="pt in paymentTypes"
                          :key="pt.id"
                        >
                          {{ pt.description }}
                        </option>
                      </select>
                    </td>

                    <td v-else>{{ detail.payment.description }}</td>

                    <td class="text-center">{{ detail.amount }}</td>
                    <td>
                      <button
                        v-if="!detail.payd"
                        @click.prevent="payInstallment(detail)"
                        class="btn btn-sm btn-fat btn-outline-success"
                      >
                        <i class="far fa-money-bill-alt"></i>
                      </button>
                      <span v-else class="badge badge-success">Pagado</span>
                      <!-- <button
                        class="btn btn-sm btn-fat btn-outline-danger"
                        @click.prevent="destroyNewPay(detail.id)"
                      >
                        <i class="fas fa-trash"></i>
                      </button> -->
                    </td>
                  </tr>

                  <!-- form para crear nuevo pago -->
                  <!-- <tr v-if="account.debt > 0">
                    <td>
                      <input
                        :class="$errorsClass(errors['date_issue'])"
                        type="date"
                        v-model="newPay.date_issue"
                      />
                      <div
                        v-if="$errorsExists(errors['date_issue'])"
                        class="invalid-feedback ml-3"
                      >
                        {{ $errorsPrint(errors["date_issue"]) }}
                      </div>
                    </td>
                    <td>
                      <select
                        :class="$errorsClass(errors['payment_type_id'])"
                        v-model="newPay.payment_type_id"
                      >
                        <option
                          :value="pt.id"
                          v-for="pt in paymentTypes"
                          :key="pt.id"
                        >
                          {{ pt.description }}
                        </option>
                      </select>
                      <div
                        v-if="$errorsExists(errors['payment_type_id'])"
                        class="invalid-feedback ml-3"
                      >
                        {{ $errorsPrint(errors["payment_type_id"]) }}
                      </div>
                    </td>
                    <td>
                      <input
                        :class="[
                          $errorsClass(errors['amount']),
                          'form-control-border text-center',
                        ]"
                        type="number"
                        step="0.001"
                        v-model="newPay.amount"
                      />
                      <div
                        v-if="$errorsExists(errors['amount'])"
                        class="invalid-feedback ml-3"
                      >
                        {{ $errorsPrint(errors["amount"]) }}
                      </div>
                    </td>
                    <td>
                      <button class="btn btn-sm btn-fat btn-outline-info">
                        <i class="fas fa-check"></i>
                      </button>
                    </td>
                  </tr> -->
                </tbody>
                <tfoot>
                  <tr>
                    <td colspan="3" class="pb-0">
                      <p class="text-right font-weight-bold">TOTAL PAGADO:</p>
                    </td>
                    <td class="text-center">{{ account.residue }}</td>
                  </tr>
                  <tr>
                    <td colspan="3" class="pb-0">
                      <p class="text-right font-weight-bold">TOTAL A PAGAR:</p>
                    </td>
                    <td class="text-center">
                      {{
                        parseFloat(account.residue) + parseFloat(account.debt)
                      }}
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3" class="pb-0">
                      <p class="text-right font-weight-bold">
                        PENDIENTE DE PAGO:
                      </p>
                    </td>
                    <td class="text-center">{{ account.debt }}</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-outline-danger"
              data-dismiss="modal"
            >
              Cerrar
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";

export default {
  components: { BaseUrl },
  data() {
    return {
      accounts: [],
      account: {},
      newPay: {
        date_issue: null,
        amount: null,
        account_to_pay_id: null,
        payment_type_id: 1,
      },
      paymentTypes: [],
      errors: [],
    };
  },
  created() {
    this.getAccountsToPay();
    this.getPaymentTypes();
  },
  methods: {
    async getAccountsToPay() {
      await BaseUrl.get(`/api/accounts-to-pay?included=purchase.provider`)
        .then((response) => {
          this.accounts = response.data.data;
          console.log(response.data.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    async getAccountDetails(id) {
      await BaseUrl.get(
        `/api/accounts-to-pay/${id}?included=accountToPayDetails.paymentType`
      )
        .then((response) => {
          console.log(response.data.data);
          this.account = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    async storeNewPay() {
      this.newPay.account_to_pay_id = this.account.id;
      await BaseUrl.post(`/api/account-to-pay-details`, this.newPay)
        .then((response) => {
          console.log(response.data);
          this.getAccountDetails(this.account.id);
          this.getAccountsToPay();
          this.newPay = {
            date_issue: null,
            amount: null,
            account_to_pay_id: null,
            payment_type_id: 1,
          };
          this.errors = [];
        })
        .catch((error) => {
          console.log(error.response.data.errors);
          this.errors = error.response.data.errors;
        });
    },

    async payInstallment(installment) {
      await BaseUrl.put(
        `/api/account-to-pay-details/${installment.id}`,
        installment
      )
        .then((response) => {
          console.log(response.data);
          this.getAccountDetails(this.account.id);
          this.getAccountsToPay();
          this.errors = [];
        })
        .catch((error) => {
          console.log(error.response.data);
          this.errors = error.response.data.errors;
        });
    },

    async destroyNewPay(detail) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`/api/account-to-pay-details/${detail}`)
            .then((response) => {
              console.log(response.data);
              this.getAccountDetails(this.account.id);
            })
            .catch((error) => {
              console.log(error.response.data);
            });
        }
      });
    },

    async getPaymentTypes() {
      await BaseUrl.get(`/api/payment-types`)
        .then((response) => {
          this.paymentTypes = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    openModalAccountToPay(id) {
      $("#pay-account").modal("show");
      this.getAccountDetails(id);
    },

    transformDateTime(date_time) {
      return moment(date_time).utc().format("YYYY-MM-DD h:mm:ss");
    },
  },
};
</script>

<style>
</style>

