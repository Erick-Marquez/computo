<template>
  <div class="content-header">
    <h3>Registrar Nueva Compra</h3>
    <!-- {{ newPurchase }} -->
  </div>
  <div class="card">
    <div class="card-body">
      <h4>Comprobante</h4>
      <div class="row">
        <!-- TIPO DE COMPROBANTE -->
        <div class="col-md-3">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-file-invoice"></i>
              Tipo comprobante
            </label>
            <select
              v-model="newPurchase.voucher.type"
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
              v-model="newPurchase.voucher.serie"
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
              v-model="newPurchase.voucher.number"
            />
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">
            <label><i class="text-danger far fa-calendar-alt"></i>Fecha:</label>
            <input
              type="date"
              class="form-control rounded-pill"
              v-model="newPurchase.voucher.date"
            />
          </div>
        </div>
      </div>

      <search-provider
        :provider="newPurchase.provider"
        :voucherType="newPurchase.voucher.type"
      ></search-provider>

      <search-products
        :products="newPurchase.products"
      ></search-products>

      <!-- Observación -->
      <div class="row">
        <div class="col-md-8">
          <!-- <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Descuento</label>
                <input class="form-control rounded-pill" type="text" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Total Recibido S/.</label>
                <input class="form-control rounded-pill" type="text" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Vuelto S/.</label>
                <input class="form-control rounded-pill" type="text" />
              </div>
            </div>
          </div> -->
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <h4>Observación</h4>
                <textarea
                  name=""
                  id=""
                  cols="30"
                  rows="4"
                  class="form-control rounded-pill px-5"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <th>Subtotal:</th>
                  <td>$250.30</td>
                </tr>
                <tr>
                  <th>Tax (9.3%)</th>
                  <td>$10.34</td>
                </tr>
                <tr>
                  <th>Shipping:</th>
                  <td>$5.80</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>$265.24</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Resumen de ventas -->
      <div class="row no-print">
        <div class="col-12">
          <!-- <a
            href="invoice-print.html"
            rel="noopener"
            target="_blank"
            class="btn btn-default"
            ><i class="fas fa-print"></i> Print</a
          > -->
          <button type="button" class="btn btn-dark float-right">
            <i class="far fa-credit-card"></i> Guarda Documento Electronico
          </button>
          <!-- <button
            type="button"
            class="btn btn-primary float-right"
            style="margin-right: 5px"
          >
            <i class="fas fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SearchProvider from "../components/SearchProvider.vue";
import SearchProducts from "../components/SearchProducts.vue";

export default {
  components: { SearchProvider, SearchProducts },
  data() {
    return {
      newPurchase: {
        voucher: {
          type: "03",
          serie: null,
          number: null,
          date: null,
        },
        provider: {
          identification_document_id: 6,
        },
        products: {},
      },
    };
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
