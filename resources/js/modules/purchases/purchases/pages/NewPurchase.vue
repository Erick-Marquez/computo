<template>
  <div class="content-header">
    <h3>Registrar Nueva Compra</h3>
  </div>
  <div class="card">
    <form @submit.prevent="createPurchase">
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
                v-model="newPurchase.document_type"
                class="form-control rounded-pill"
              >
                <option value="03">BOLETA</option>
                <option value="01">FACTURA</option>
                <option value="NV">NOTA DE VENTA</option>
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
                class="form-control rounded-pill"
                v-model="newPurchase.serie"
              />
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
                class="form-control rounded-pill"
                v-model="newPurchase.document_number"
              />
            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group">
              <label
                ><i class="text-danger far fa-calendar-alt"></i>Fecha:</label
              >
              <input
                type="date"
                class="form-control rounded-pill"
                v-model="newPurchase.date_issue"
              />
            </div>
          </div>
        </div>

        <search-provider
          :provider="newPurchase.provider"
          :voucherType="newPurchase.document_type"
        ></search-provider>

        <search-products :products="newPurchase.products"></search-products>

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
                        v-model="newPurchase.handle_exchange_rate"
                      />
                      <label
                        for="handle_exchange_rate"
                        class="custom-control-label"
                      >
                        Maneja tipo de cambio
                      </label>
                    </div>
                  </div>

                  <input
                    type="text"
                    class="form-control rounded-pill px-4"
                    v-show="newPurchase.handle_exchange_rate"
                    v-model="newPurchase.exchange_rate"
                  />
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
                    v-model="newPurchase.observation"
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
                          ? (newPurchase.subtotal = newPurchase.products
                              .reduce((previousValue, currentValue) => {
                                return (
                                  parseFloat(previousValue) +
                                  parseFloat(
                                    currentValue.referential_purchase_price
                                  )
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
                          ? (newPurchase.total = newPurchase.products
                              .reduce((previousValue, currentValue) => {
                                return (
                                  parseFloat(previousValue) +
                                  parseFloat(
                                    currentValue.referential_purchase_price
                                  )
                                );
                              }, 0)
                              .toFixed(2))
                          : 0
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
import BaseUrl from "../../../../api/BaseUrl";

export default {
  components: { SearchProvider, SearchProducts },
  data() {
    return {
      newPurchase: {
        handle_exchange_rate: true,
        document_type: "03",
        serie: null,
        document_number: null,
        date_issue: null,
        subtotal: 0,
        total: 0,
        provider: {
          id: null,
          identification_document_id: 6,
        },
        products: [],
      },
    };
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
          console.log(error.response);
        });
    },
  },
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
