<template>
  <div class="content-header">
    <h3>Registrar Nueva Compra</h3>
  </div>
  <div class="card">
    <form @submit.prevent="createPurchase" novalidate>
      <div class="card-body">
        <h4>Comprobante</h4>
        <div class="row mt-3">
          <!-- TIPO DE COMPROBANTE -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="">
                <i class="text-danger fas fa-file-invoice"></i>
                Tipo comprobante
              </label>
              <select
                v-model="newPurchase.voucherDetail.document_type"
                class="form-control rounded-pill"
              >
                <option value="BOLETA">BOLETA</option>
                <option value="FACTURA">FACTURA</option>
                <option value="NOTA DE VENTA">NOTA DE VENTA</option>
              </select>
            </div>
          </div>

          <!-- SERIE -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="">
                <i class="text-danger fas fa-barcode"></i>
                Serie</label
              >
              <input
                type="text"
                :class="$errorsClass(errors['voucherDetail.serie'])"
                v-model="newPurchase.voucherDetail.serie"
              />
              <div
                v-if="$errorsExists(errors['voucherDetail.serie'])"
                class="invalid-feedback ml-3"
              >
                {{ $errorsPrint(errors["voucherDetail.serie"]) }}
              </div>
            </div>
          </div>

          <!-- N° COMPROBANTE -->
          <div class="col-md-3">
            <div class="form-group">
              <label for="">
                <i class="text-danger fas fa-hashtag"></i>
                N° Comprobante</label
              >
              <input
                type="text"
                :class="$errorsClass(errors['voucherDetail.document_number'])"
                v-model="newPurchase.voucherDetail.document_number"
              />
              <div
                v-if="$errorsExists(errors['voucherDetail.document_number'])"
                class="invalid-feedback ml-3"
              >
                {{ $errorsPrint(errors["voucherDetail.document_number"]) }}
              </div>
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label
                ><i class="text-danger far fa-calendar-alt"></i>Fecha:</label
              >
              <input
                type="date"
                :class="$errorsClass(errors['voucherDetail.date_issue'])"
                v-model="newPurchase.voucherDetail.date_issue"
              />
              <div
                v-if="$errorsExists(errors['voucherDetail.date_issue'])"
                class="invalid-feedback ml-3"
              >
                {{ $errorsPrint(errors["voucherDetail.date_issue"]) }}
              </div>
            </div>
          </div>
        </div>

        <search-provider
          :provider="newPurchase.provider"
          :voucherType="newPurchase.voucherDetail.document_type"
          :errors="errors"
        ></search-provider>
        <search-products :products="newPurchase.products" :errors="errors"></search-products>
        <set-products :products="newPurchase.products" :errors="errors"></set-products>
        <!-- Observación -->
        <div class="row mt-4">
          <div class="col-md-8 pr-5">
            <div class="row">
              <div class="col-md">
                <div class="d-flex justify-content-start">
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input
                        class="custom-control-input custom-control-input-danger"
                        type="checkbox"
                        id="handle_exchange_rate"
                        v-model="newPurchase.voucherDetail.handle_exchange_rate"
                      />
                      <label
                        for="handle_exchange_rate"
                        class="custom-control-label"
                      >
                        Maneja tipo de cambio
                      </label>
                    </div>
                  </div>

                  <div class="ml-4 form-group">
                    <input
                      type="number"
                      :class="
                        $errorsClass(errors['voucherDetail.exchange_rate'])
                      "
                      v-show="newPurchase.voucherDetail.handle_exchange_rate"
                      v-model.number="newPurchase.voucherDetail.exchange_rate"
                      step="0.001"
                    />
                    <div
                      v-if="$errorsExists(errors['voucherDetail.exchange_rate'])"
                      class="invalid-feedback ml-3"
                    >
                      {{ $errorsPrint(errors["voucherDetail.exchange_rate"]) }}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-md">
                <div class="form-group">
                  <h5 class="pl-2">
                    <i class="far fa-comment-alt text-danger"></i>
                    Observación
                  </h5>
                  <textarea
                    name=""
                    id=""
                    cols="30"
                    rows="4"
                    class="form-control rounded-pill px-5"
                    v-model="newPurchase.voucherDetail.observation"
                  ></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="table-responsive">
              <h5 class="text-center lead">Resumen:</h5>
              <table class="table">
                <tbody>
                  <tr>
                    <th>Subtotal:</th>
                    <td>
                      $
                      {{
                        newPurchase.products.length
                          ? (newPurchase.voucherDetail.subtotal =
                              newPurchase.products
                                .reduce((previousValue, currentValue) => {
                                  return (
                                    parseFloat(previousValue) +
                                    parseFloat(currentValue.subtotal)
                                  );
                                }, 0)
                                .toFixed(2))
                          : 0
                      }}
                    </td>
                  </tr>
                  <tr>
                    <th>Total:</th>
                    <td>
                      $
                      {{
                        newPurchase.products.length
                          ? (newPurchase.voucherDetail.total =
                              newPurchase.products
                                .reduce((previousValue, currentValue) => {
                                  return (
                                    parseFloat(previousValue) +
                                    parseFloat(currentValue.total)
                                  );
                                }, 0)
                                .toFixed(2))
                          : 0
                      }}
                    </td>
                  </tr>
                  <tr>
                    <th>Total igv:</th>
                    <td>
                      $
                      {{
                        (newPurchase.voucherDetail.total_igv = parseFloat(
                          newPurchase.voucherDetail.total -
                            newPurchase.voucherDetail.subtotal
                        ).toFixed(2))
                      }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Resumen de ventas -->
        <div class="row no-print">
          <div class="col-12">
            <button type="submit" class="btn btn-dark float-right">
              <i class="far fa-credit-card"></i> Guardar Nueva Compra
            </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import SearchProvider from "../components/SearchProvider.vue";
import SearchProducts from "../components/SearchProducts.vue";
import SetProducts from '../components/SetProducts.vue';
import BaseUrl from "../../../../api/BaseUrl";
// import ErrorsForm from "../../../../api/ErrorsForm";

export default {
  components: { SearchProvider, SearchProducts, SetProducts },
//   setup() {
//     const {errorsExists, errorsClass, errorsPrint } = ErrorsForm();
//     return {
//       errorsExists,
//       errorsClass,
//       errorsPrint,
//     };
//   },
  data() {
    return {
      newPurchase: {
        voucherDetail: {
          document_type: "BOLETA",
          serie: null,
          date_issue: null,
          document_number: null,
          handle_exchange_rate: true,
          exchange_rate: null,
          observation: null,
          subtotal: 0,
          total_igv: 0,
          total: 0,
        },
        provider: {
          id: null,
          identification_document_id: 6,
        },
        products: [],
      },
      errors: [],
    };
  },
  mounted() {
    this.getCurrencyExchange();
  },
  methods: {
    async createPurchase() {
      await BaseUrl.post(`/api/purchases`, this.newPurchase)
        .then((response) => {
          console.log(response.data);
          this.$router.push({ name: "purchase-list" });
          Swal.fire(
            "Compra Registrada!",
            "Su compra se registro con exito.",
            "success"
          );
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(this.errors);
        });
    },
    async getCurrencyExchange() {
      await BaseUrl.get(`api/currencyexchanges`)
        .then((response) => {
          this.newPurchase.voucherDetail.exchange_rate =
            response.data.data[0].change; // lo en  via en un array xd
        })
        .catch(() => {
          console.log(error.response);
        });
    },
  },
  computed: {},
};
</script>

<style scoped>
.btn.btn-dark {
  border-top-right-radius: 23px;
  border-bottom-right-radius: 23px;
  background: #536976; /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to right,
    #292e49,
    #536976
  ); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to right,
    #292e49,
    #536976
  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

label {
  color: rgba(48, 48, 48, 0.774);
  font-weight: 300;
}

.rounded-pill-left {
  border-top-left-radius: 50px;
  border-bottom-left-radius: 50px;
}

.rounded-pill-right {
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
}
</style>
