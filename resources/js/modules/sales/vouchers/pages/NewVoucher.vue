<template>
  <div class="content-header">
    <div class="row mb-2">
      <div class="col-sm-8">
        <h3>Registrar Nueva Venta</h3>
      </div>
      <div class="col-sm-2">
        <div class="row">
          <label for="" class="col-4 col-form-label col-form-label-sm">
            <i class="text-danger fas fa-barcode"></i>
            Serie Cotización
          </label>
          <div class="col-8">
            <select
              v-model="quotationSerieSelect"
              class="form-control rounded-pill"
            >
              <option
                v-for="quotationSerie in quotationSeries"
                :key="quotationSerie.id"
                :value="quotationSerie.id"
              >
                {{ quotationSerie.serie }}
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="input-group">
          <input
            type="text"
            placeholder="n° cotización"
            class="form-control"
            v-model="numberQuotation"
          />
          <div class="input-group-append">
            <button
              class="btn btn-danger rounded-pill-right"
              @click="getQuotation()"
            >
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <h4>Comprobante</h4>
      <div class="row">
        <!-- TIPO DE COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-file-invoice"></i>
              Tipo comprobante
            </label>
            <select
              :class="
                'form-control rounded-pill' +
                (errors['voucher.document_type'] == null ? '' : ' is-invalid')
              "
              v-model="saleData.voucher.document_type"
              @change="loadSeries()"
            >
              <option
                v-for="voucherType in voucherTypes"
                :key="voucherType.id"
                :value="voucherType.id"
              >
                {{ voucherType.description }}
              </option>
            </select>
            <div
              class="invalid-feedback"
              v-if="errors['voucher.document_type']"
            >
              {{ errors["voucher.document_type"][0] }}
            </div>
          </div>
        </div>
        <!-- SERIE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-barcode"></i>
              Serie
            </label>
            <select
              :class="
                'form-control rounded-pill' +
                (errors['voucher.serie_id'] == null ? '' : ' is-invalid')
              "
              v-model="saleData.voucher.serie_id"
              @change="loadCurrentNumber()"
            >
              <option
                v-for="serie in voucherSeries"
                :key="serie.id"
                :value="serie.id"
              >
                {{ serie.serie }}
              </option>
            </select>
            <div class="invalid-feedback" v-if="errors['voucher.serie_id']">
              {{ errors["voucher.serie_id"][0] }}
            </div>
          </div>
        </div>

        <!-- N° COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-hashtag"></i>
              N° Comprobante</label
            >
            <input
              v-model="currentNumber"
              type="text"
              class="form-control rounded-pill"
              disabled
            />
          </div>
        </div>
      </div>
      <SearchCustomers
        :voucherType="saleData.voucher.document_type"
        :customer="saleData.customer"
        :errors="errors"
      />

      <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1">
          <h4>
            <i class="text-danger fas fa-box"></i>
            Productos
          </h4>
        </div>
        <div class="p-2">
          <div class="custom-control custom-checkbox">
            <input
              class="custom-control-input custom-control-input-danger"
              type="checkbox"
              id="searchAssemblies"
              v-model="searchAssemblies"
            />
            <label for="searchAssemblies" class="custom-control-label"
              >Configuracion de PC</label
            >
          </div>
        </div>
      </div>

      <div v-if="!searchAssemblies">
        <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->

        <SearchProducts
          :currencyExchange="Number(currencyExchange.change)"
          v-on:setProduct="setProduct"
        />
      </div>

      <search-assemblies
        v-else
        v-on:setAssemblie="setAssemblie"
      ></search-assemblies>

      <!-- VER PRODUCTOS SELECCIONADOS -->
      <SetProducts
        :igvTypes="igvTypes"
        :details="saleData.detail"
        :errors="errors"
        :activateDetailDiscount="activateDetailDiscount"
        v-on:getTotals="getTotals"
        v-on:activateOrDesactivateGlobalDiscount="
          activateOrDesactivateGlobalDiscount
        "
      />

      <!-- Observación -->
      <div class="row">
        <div class="col-md-8">
          <h4>Detalle Documento</h4>

          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">
                  <i class="text-danger fas fa-tags"></i>
                  Descuento
                </label>
                <input
                  :class="$errorsClass(errors['voucher.discount'])"
                  type="number"
                  min="0"
                  step="0.01"
                  v-model="saleData.voucher.discount"
                  @change="activateOrDesactivateDetailDiscount"
                  :disabled="activateGlobalDiscount"
                  @input="getTotals()"
                />
                <div
                  class="invalid-feedback ml-3"
                  v-if="$errorsExists(errors['voucher.discount'])"
                >
                  {{ $errorsPrint(errors["voucher.discount"]) }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group text-center">
                <label>
                  <i class="text-danger fas fa-file-contract"></i>
                  ¿Es multipago?
                </label>
                <div
                  class="
                    custom-control custom-switch custom-switch-on-danger
                    is-invalid
                  "
                >
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    id="customSwitchCreateIsMultiPayment"
                    v-model="saleData.voucher.isMultiPayment"
                    @change="clearMultipayment()"
                  />
                  <label
                    class="custom-control-label"
                    for="customSwitchCreateIsMultiPayment"
                    >{{ saleData.voucher.isMultiPayment ? "Si" : "No" }}</label
                  >
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group text-center">
                <label>
                  <i class="text-danger fas fa-file-contract"></i>
                  ¿Aplica garantía?
                </label>
                <div
                  class="
                    custom-control custom-switch custom-switch-on-danger
                    is-invalid
                  "
                >
                  <input
                    type="checkbox"
                    class="custom-control-input"
                    id="customSwitchCreate"
                    v-model="saleData.voucher.warranty"
                  />
                  <label
                    class="custom-control-label"
                    for="customSwitchCreate"
                    >{{ saleData.voucher.warranty ? "Si" : "No" }}</label
                  >
                </div>
              </div>
            </div>

            <div class="col-md-2" v-if="saleData.voucher.warranty">
              <div class="form-group">
                <label for="">
                  <i class="text-danger fas fa-barcode"></i>
                  Serie Garantia
                </label>
                <select
                  v-model="saleData.voucher.warranty_serie_id"
                  class="form-control rounded-pill"
                >
                  <option
                    v-for="warrantySerie in warrantySeries"
                    :key="warrantySerie.id"
                    :value="warrantySerie.id"
                  >
                    {{ warrantySerie.serie }}
                  </option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="table-responsive">
              <table class="table" style="min-width: 600px">
                <thead>
                  <tr>
                    <th>
                      <i class="text-danger fas fa-money-bill"></i> Tipo de pago
                    </th>
                    <th>Total Recibido S/.</th>
                    <th v-if="!saleData.voucher.isMultiPayment">Vuelto S/.</th>
                    <th
                      v-if="saleData.voucher.isMultiPayment"
                      class="col-2 text-center"
                    >
                      Acciones
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="(payment, index) in saleData.voucher.payments"
                    :key="payment.id"
                  >
                    <td>
                      <select
                        v-model="payment.payment_type_id"
                        class="form-control rounded-pill"
                      >
                        <option
                          v-for="paymentType in paymentTypes"
                          :key="paymentType.id"
                          :value="paymentType.id"
                        >
                          {{ paymentType.description }}
                        </option>
                      </select>
                    </td>
                    <td>
                      <input
                        class="form-control rounded-pill"
                        type="number"
                        min="0"
                        step="0.01"
                        v-model="payment.amount"
                        @input="index == 0 ? getChange() : null"
                      />
                    </td>
                    <td v-if="!saleData.voucher.isMultiPayment">
                      <input
                        class="form-control rounded-pill"
                        type="text"
                        v-model="saleData.voucher.change"
                        disabled
                      />
                    </td>

                    <template v-if="saleData.voucher.isMultiPayment">
                      <td class="text-center" v-if="index == 0">
                        <button
                          type="button"
                          class="btn btn-dark btn-sm"
                          @click="addPayment()"
                        >
                          <span><i class="fas fa-plus"></i></span>
                          Añadir
                        </button>
                      </td>
                      <td class="text-center" v-else>
                        <button
                          type="button"
                          class="btn btn-flat"
                          @click="deletePayment(index)"
                        >
                          <i class="text-danger fas fa-trash"></i>
                        </button>
                      </td>
                    </template>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <h4>Observación</h4>
                <textarea
                  cols="30"
                  rows="4"
                  class="form-control"
                  v-model="saleData.voucher.observation"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table mt-5">
              <tbody>
                <tr v-show="saleData.voucher.discount > 0">
                  <th>Descuento global:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span><span>{{ saleData.voucher.discount }}</span>
                  </td>
                </tr>
                <tr v-show="saleData.voucher.discountItems > 0">
                  <th>Descuento por item:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ saleData.voucher.discountItems }}</span>
                  </td>
                </tr>
                <tr v-show="saleData.voucher.totalTaxed > 0">
                  <th>Gravado:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ saleData.voucher.totalTaxed }}</span>
                  </td>
                </tr>
                <tr v-show="saleData.voucher.totalExonerated > 0">
                  <th>Exonerado:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ saleData.voucher.totalExonerated }}</span>
                  </td>
                </tr>
                <tr v-show="saleData.voucher.totalUnaffected > 0">
                  <th>Inafecto:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ saleData.voucher.totalUnaffected }}</span>
                  </td>
                </tr>
                <tr v-show="saleData.voucher.totalFree > 0">
                  <th>Gratuita:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ saleData.voucher.totalFree }}</span>
                  </td>
                </tr>
                <tr v-show="saleData.voucher.totalIgv > 0">
                  <th>Igv (18%):</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span><span>{{ saleData.voucher.totalIgv }}</span>
                  </td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span><span>{{ saleData.voucher.total }}</span>
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
          <form @submit.prevent="createSale()">
            <button
              v-if="!loadingVoucher"
              type="submit"
              class="btn btn-dark float-right"
            >
              <i class="far fa-credit-card"></i> Guarda Documento Electronico
            </button>

            <button
              v-else
              class="btn btn-dark float-right"
              :disabled="loadingVoucher"
            >
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import SearchCustomers from "../../components/SearchCustomers.vue";
import SearchAssemblies from "../../components/SearchAssemblies.vue";
import SearchProducts from "../../components/SearchProducts.vue";
import SetProducts from "../components/SetProducts.vue";
export default {
  components: {
    BaseUrl,
    SearchCustomers,
    SearchAssemblies,
    SearchProducts,
    SetProducts,
  },
  async created() {
    await BaseUrl.get(`api/sales/create`).then((resp) => {
      this.currencyExchange = resp.data.data.currencyExchange;
      this.identificationDocuments = resp.data.data.identificationDocuments;
      this.igvTypes = resp.data.data.igvTypes;
      this.series = resp.data.data.series;
      this.paymentTypes = resp.data.data.paymentTypes;
      this.saleData.voucher.payments[0].payment_type_id =
        this.paymentTypes[0].id;
      //Serie Voucher
      this.voucherTypes = resp.data.data.voucherTypes;
      this.saleData.voucher.document_type = this.voucherTypes[0].id;
      this.loadSeries();
      //Serie Quotation
      let serieBackupQ = this.series;
      this.quotationSeries = serieBackupQ.filter(
        (series) => series.voucher_type_id == 8
      );
      this.quotationSerieSelect = this.quotationSeries[0].id;
      //Serie Warranty
      let serieBackupW = this.series;
      this.warrantySeries = serieBackupW.filter(
        (series) => series.voucher_type_id == 9
      );
      this.saleData.voucher.warranty_serie_id = this.warrantySeries[0].id;
    });
    if (this.$route.query.serieQuotation && this.$route.query.numberQuotation) {
      this.quotationSerieSelect = this.$route.query.serieQuotation;
      this.numberQuotation = this.$route.query.numberQuotation;
      this.getQuotation();
    }
    this.loader.hide();
  },
  data() {
    return {
      loader: null,
      loadingVoucher: false,
      currencyExchange: {},
      identificationDocuments: [],
      igvTypes: [],
      series: [],
      paymentTypes: [],
      voucherTypes: [],
      warrantySeries: [],
      errors: [],
      searchAssemblies: false,
      quotationSerieSelect: null,
      quotationSeries: [],
      numberQuotation: null,
      contador: 0,
      voucherSeries: [],
      currentNumber: "Selecciona una serie",
      activateGlobalDiscount: false,
      activateDetailDiscount: false,

      saleData: {
        customer: {
          id: null,
        },
        voucher: {
          subtotal: 0,
          discount: 0,
          totalIgv: 0,
          totalExonerated: 0,
          totalUnaffected: 0,
          totalFree: 0,
          totalTaxed: 0,
          total: 0,
          discountItems: 0,
          quotation_id: null,
          document_type: 2,
          serie_id: "",
          moneda: "PEN",
          date_issue: "2021-10-17", //Año - mes - dia
          date_due: "2021-10-18",
          observation: "",
          received_money: 0,
          change: 0,
          warranty_serie_id: null,
          warranty: false,
          isMultiPayment: false,
          payments: [
            {
              payment_type_id: null,
              amount: 0,
            },
          ],
        },
        detail: [],
      },
    };
  },
  mounted() {
    this.loader = this.$loading.show({
      canCancel: true,
    });
  },
  methods: {
    loadSeries() {
      let serieBackup = this.series;
      let serieFilter = serieBackup.filter(
        (series) =>
          series.voucher_type_id == this.saleData.voucher.document_type
      );
      this.voucherSeries = serieFilter;
      this.saleData.voucher.serie_id = serieFilter[0].id;
      this.loadCurrentNumber();
    },
    loadCurrentNumber() {
      let serieBackup = this.voucherSeries;
      let serieFilter = serieBackup.filter(
        (series) => series.id == this.saleData.voucher.serie_id
      );
      this.currentNumber = serieFilter[0].current_number + 1;
    },
    setAssemblie(products) {
      this.saleData.detail = [];
      console.log(products);

      products.forEach((product) => {
        this.setProductAssembly(product);
      });
    },
    setProductAssembly(productAssembly) {
      let product = {
        discount: 0,
        subtotal: 0,
        total: 0,
        product_id: productAssembly.id,
        cod: productAssembly.cod,
        affect_icbper: false,
        igv_type_id: productAssembly.igv_type_id,
        description: productAssembly.name,
        brand: productAssembly.brand,
        manager_series: Boolean(productAssembly.manager_series),
        sale_price: (productAssembly.sale_price * this.currencyExchange.change).toFixed(2),
        quantity: productAssembly.quantity,
        series: [],
      };
      //Añadir series
      for (let j = 0; j < product.quantity; j++) {
        product.series.push("");
      }
      this.saleData.detail.push(product);
      this.getTotals();
      console.log(productAssembly);
      // Alertas para las notificaciones y calcular totales
      //   this.getQuotationDiscount(0);
    },
    setProduct(product, price) {
      let index = this.saleData.detail.findIndex(
        (element) => element.product_id == product.id
      );
      if (index == -1) {
        this.saleData.detail.push({
          discount: 0,
          subtotal: 0,
          total: 0,
          product_id: product.id,
          cod: product.cod,
          affect_icbper: false,
          igv_type_id: product.igv_type_id,
          description: product.name,
          brand: product.brand,
          sale_price: price,
          manager_series: Boolean(product.manager_series),
          quantity: 1,
          series: [""],
        });
        this.getTotals();
      }
    },
    activateOrDesactivateGlobalDiscount() {
      // recorrer el array detalle en busca de un descuento
      let discount = 0;
      this.saleData.detail.forEach((e) => {
        discount += e.discount * 1;
      });
      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateGlobalDiscount = discount > 0 ? true : false;
    },
    activateOrDesactivateDetailDiscount() {
      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateDetailDiscount =
        this.saleData.voucher.discount > 0 ? true : false;
    },
    getTotals() {
      //!REDONDEAR AL FINAL
      let subtotal = 0;
      let totalIgv = 0;
      let totalExonerated = 0;
      let totalUnaffected = 0;
      let totalFree = 0;
      let totalTaxed = 0;
      let discountItems = 0;
      let total = 0;
      //TODO cambiar el switch por un objeto
      let totals = {
        10: 0, //totalTaxed
      };
      // igv constante
      const igv = 0.18;
      this.saleData.detail.forEach((e) => {
        discountItems += e.discount;
        switch (parseInt(e.igv_type_id)) {
          case 10: //Gravado - Operación Onerosa
            // hallar el precio sin igv
            let priceWithoutIgv = e.sale_price / (1 + igv);
            // hallar el subtotal = (precio sin igv * cantidad) - descuento
            e.subtotal = this.roundToTwo(
              priceWithoutIgv * e.quantity - e.discount
            ).toFixed(2);
            // hallar el total = (subtotal * 1.18)
            e.total = this.roundToTwo(
              (priceWithoutIgv * e.quantity - e.discount) * (1 + igv)
            ).toFixed(2);
            // Actualizar totales globales
            subtotal += Number(e.subtotal);
            totalIgv += Number(e.total - e.subtotal);
            totalTaxed += Number(e.subtotal);
            total += Number(e.total);
            break;
          case 11: //[Gratuita] Gravado – Retiro por premio
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 12: //[Gratuita] Gravado – Retiro por donación
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 13: //[Gratuita] Gravado – Retiro
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 14: //[Gratuita] Gravado – Retiro por publicidad
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 15: //[Gratuita] Gravado – Bonificaciones
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 16: //[Gratuita] Gravado – Retiro por entrega a trabajadores
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 20: //Exonerado - Operación Onerosa
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalExonerated += Number(e.subtotal);
            total += Number(e.total);
            break;
          case 30: //Inafecto - Operación Onerosa
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalUnaffected += Number(e.subtotal);
            total += Number(e.total);
            break;
          case 31: //[Gratuita] Inafecto – Retiro por Bonificación
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 32: //[Gratuita] Inafecto – Retiro
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 33: //[Gratuita] Inafecto – Retiro por Muestras Médicas
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 34: //[Gratuita] Inafecto - Retiro por Convenio Colectivo
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 35: //[Gratuita] Inafecto – Retiro por premio
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 36: //[Gratuita] Inafecto - Retiro por publicidad
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 40: //Exportación
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity - e.discount
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalUnaffected += Number(e.subtotal);
            total += Number(e.total);
            break;
        }
      });
      this.saleData.voucher.subtotal = this.roundToTwo(subtotal).toFixed(2);
      this.saleData.voucher.totalIgv = this.roundToTwo(totalIgv).toFixed(2);
      this.saleData.voucher.totalExonerated =
        this.roundToTwo(totalExonerated).toFixed(2);
      this.saleData.voucher.totalUnaffected =
        this.roundToTwo(totalUnaffected).toFixed(2);
      this.saleData.voucher.totalFree = this.roundToTwo(totalFree).toFixed(2);
      this.saleData.voucher.totalTaxed = this.roundToTwo(totalTaxed).toFixed(2);
      this.saleData.voucher.discountItems =
        this.roundToTwo(discountItems).toFixed(2);
      this.saleData.voucher.total = this.roundToTwo(
        total - this.saleData.voucher.discount
      ).toFixed(2);
    },
    roundToTwo(num) {
      return +(Math.round(num + "e+2") + "e-2");
    },
    getChange() {
      if (this.saleData.voucher.payments[0].amount != 0) {
        this.saleData.voucher.change =
          this.saleData.voucher.payments[0].amount -
          this.saleData.voucher.total;
      }
      if (this.saleData.voucher.payments[0].amount == 0) {
        this.saleData.voucher.change = 0;
      }
    },
    createSale() {
      this.loadingVoucher = true;
      this.saleData.voucher.received_money = 0;
      if (!this.saleData.voucher.isMultiPayment) {
        this.saleData.voucher.received_money =
          this.saleData.voucher.payments[0].amount;
      }

      BaseUrl.post("/api/sales", this.saleData)
        .then((response) => {
          this.errors = [];
          console.log(response);
          this.$router.replace({ name: "voucher-list" });
          Swal.fire("Comprobante Creado", response.data, "success");
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(error.response.data.errors);
          console.log(error.response);
          this.errors = error.response.data.errors;
          if (this.errors["detail"] != null) {
            Swal.fire("Algo salio mal", this.errors["detail"][0], "error");
          }
          this.getErrorDetailSerie(0, 0);
        })
        .finally(() => {
          this.loadingVoucher = false;
        });
    },
    // i = index1(detail) , j = index2(series)
    getErrorDetailSerie(i, j) {
      if (i < this.saleData.detail.length) {
        if (j < this.saleData.detail[i].quantity) {
          if (this.errors[`detail.${i}.series.${j}`] != null) {
            Swal.fire({
              title: "Algo salio mal",
              html:
                "Exite un error en el producto  <b>" +
                this.saleData.detail[i].description +
                " - " +
                this.saleData.detail[i].brand +
                " - " +
                this.saleData.detail[i].cod +
                "</b>: </br>" +
                this.errors[`detail.${i}.series.${j}`][0],
              icon: "warning",
            }).then((result) => {
              i++;
              this.getErrorDetailSerie(i, 0);
            });
          } else {
            j++;
            this.getErrorDetailSerie(i, j);
          }
        } else {
          i++;
          this.getErrorDetailSerie(i, 0);
        }
      }
    },
    getQuotation() {
      this.saleData.detail = [];
      BaseUrl.get(
        `api/sales/quotation/${this.quotationSerieSelect}/${this.numberQuotation}`
      )
        .then((resp) => {
          let quotation = resp.data.data;
          this.saleData.voucher.quotation_id = Number(quotation.id);
          this.saleData.voucher.discount = Number(quotation.discount);
          this.saleData.voucher.warranty = Boolean(quotation.have_warranty);
          this.saleData.voucher.observation = quotation.observation;
          this.saleData.voucher.isMultiPayment =
            quotation.payment_types.length > 0 ? true : false;
          if (this.saleData.voucher.isMultiPayment) {
            this.saleData.voucher.payments = [];
            quotation.payment_types.forEach((e) => {
              let payment = {
                payment_type_id: e.pivot.payment_type_id,
                amount: e.pivot.amount,
              };
              this.saleData.voucher.payments.push(payment);
            });
          }
          quotation.quotation_details.forEach((e, index) => {
            let product = {
              discount: Number(e.discount),
              subtotal: 0,
              total: 0,
              product_id: e.branch_product_id,
              cod: e.branch_product.product.cod,
              affect_icbper: false,
              igv_type_id: e.igv_type_id,
              description: e.branch_product.product.name,
              brand: e.branch_product.product.brand.description,
              sale_price: e.price,
              manager_series: Boolean(e.branch_product.product.manager_series),
              quantity: e.quantity,
              series: [],
            };
            //Añadir series
            for (let j = 0; j < e.quantity; j++) {
              product.series.push("");
            }
            this.saleData.detail.push(product);
            //Activar descuento
            this.activateOrDesactivateGlobalDiscount();
            this.activateOrDesactivateDetailDiscount();
          });
          // Alertas para las notificaciones y calcular totales
          this.getQuotationDiscount(0);
        })
        .catch((error) => {
          if (error.response.status == 404) {
            Swal.fire({
              title: "No encontrado",
              html: "No existe la cotización",
              icon: "warning",
            });
          }
        });
    },
    getQuotationDiscount(index) {
      if (index < this.saleData.detail.length) {
        if (this.saleData.detail[index].discount > 0) {
          Swal.fire({
            title: "¿Aceptar Descuento?",
            html:
              "El producto <b>" +
              this.saleData.detail[index].description +
              "</b> " +
              "tiene un precio <b>S/. " +
              this.saleData.detail[index].sale_price +
              "</b> " +
              "y tiene un descuento por un total de <b>S/. " +
              this.saleData.detail[index].discount +
              "</b> " +
              "el precio final es de <b>S/. " +
              (this.saleData.detail[index].sale_price -
                this.saleData.detail[index].discount) +
              "</b>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, adelante",
            cancelButtonText: "Cancelar",
            allowOutsideClick: false,
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: "Confirmado",
                html:
                  "El descuento para el producto <b>" +
                  this.saleData.detail[index].description +
                  "</b> " +
                  "por un total de <b>S/. " +
                  this.saleData.detail[index].discount +
                  "</b> " +
                  "ha sido aceptado el precio final es <b>S/. " +
                  this.saleData.detail[index].sale_price +
                  "</b>",
                icon: "success",
                allowOutsideClick: false,
              }).then((result) => {
                if (result.value) {
                  index++;
                  this.getQuotationDiscount(index);
                }
              });
            } else if (
              result.dismiss === Swal.DismissReason.cancel ||
              result.dismiss === Swal.DismissReason.backdrop
            ) {
              let discount = this.saleData.detail[index].discount;
              this.saleData.detail[index].discount = 0;
              Swal.fire({
                title: "Cancelado",
                html:
                  "El descuento para el producto <b>" +
                  this.saleData.detail[index].description +
                  "</b> " +
                  "por un total de <b>S/. " +
                  discount +
                  "</b> " +
                  "ha sido eliminado el precio final es <b>S/. " +
                  this.saleData.detail[index].sale_price +
                  "</b>",
                icon: "error",
                allowOutsideClick: false,
              }).then((result) => {
                if (result.value) {
                  index++;
                  this.getQuotationDiscount(index);
                }
              });
            }
          });
        } else {
          index++;
          this.getQuotationDiscount(index);
        }
      } else {
        //Activar descuento
        // if (this.saleData.voucher.discount > 0) {
        //   Swal.fire({
        //     title: "¿Aceptar Descuento?",
        //     html: 'El producto <b>' + this.saleData.detail[index].description + '</b> ' +
        //     'tiene un precio <b>S/. ' + this.saleData.detail[index].sale_price + '</b> ' +
        //     'y tiene un descuento por un total de <b>S/. ' + this.saleData.detail[index].discount + '</b> ' +
        //     'el precio final es de <b>S/. ' + (this.saleData.detail[index].sale_price - this.saleData.detail[index].discount) + '</b>',
        //     icon: "warning",
        //     showCancelButton: true,
        //     confirmButtonColor: "#3085d6",
        //     cancelButtonColor: "#d33",
        //     confirmButtonText: "Si, adelante",
        //     cancelButtonText: "Cancelar",
        //     allowOutsideClick: false
        //   })
        //   .then((result) => {
        //     if (result.isConfirmed) {
        //       Swal.fire({
        //         title: 'Confirmado',
        //         html: 'El descuento para el producto <b>' + this.saleData.detail[index].description + '</b> ' +
        //         'por un total de <b>S/. ' + this.saleData.detail[index].discount + '</b> '  +
        //         'ha sido aceptado el precio final es <b>S/. ' + this.saleData.detail[index].sale_price + '</b>',
        //         icon: 'success',
        //         allowOutsideClick: false
        //       }).then((result) => {
        //         if (result.value) {
        //           index++
        //           this.getQuotationDiscount(index)
        //         }
        //       })
        //     } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.backdrop) {
        //       let discount = this.saleData.detail[index].discount
        //       this.saleData.detail[index].discount = 0
        //       Swal.fire({
        //         title: 'Cancelado',
        //         html: 'El descuento para el producto <b>' + this.saleData.detail[index].description + '</b> ' +
        //         'por un total de <b>S/. ' + discount +  '</b> ' +
        //         'ha sido eliminado el precio final es <b>S/. ' + this.saleData.detail[index].sale_price + '</b>',
        //         icon: 'error',
        //         allowOutsideClick: false
        //       }).then((result) => {
        //         if (result.value) {
        //           index++
        //           this.getQuotationDiscount(index)
        //         }
        //       })
        //     }
        //   })
        // }
        // else {
        //   index++
        //   this.getQuotationDiscount(index)
        // }
        this.activateOrDesactivateGlobalDiscount();
        this.activateOrDesactivateDetailDiscount();
        //calcular totales
        this.getTotals();
      }
    },
    addPayment() {
      const payment = {
        payment_type_id: this.paymentTypes[0].id,
        amount: 0,
      };
      this.saleData.voucher.payments.push(payment);
    },
    deletePayment(index) {
      this.saleData.voucher.payments.splice(index, 1);
    },
    clearMultipayment() {
      if (!this.saleData.voucher.isMultiPayment) {
        this.saleData.voucher.payments = [];
      }
      this.addPayment();
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
</style>
