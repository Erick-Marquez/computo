<template>
  <div class="content-header">
    <h3>Registrar Nueva Cotizacion</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <h4>Cotización</h4>
      <div class="row">
        <!-- TIPO DE COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-calendar-times"></i>
              Valido Hasta
            </label>
            <input
              type="date"
              :class="
                'form-control rounded-pill' +
                (errorsCreate['quotation.date_due'] == null
                  ? ''
                  : ' is-invalid')
              "
              v-model="quotationData.quotation.date_due"
              required
            />
            <div
              class="invalid-feedback"
              v-if="errorsCreate['quotation.date_due']"
            >
              {{ errorsCreate["quotation.date_due"][0] }}
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
              v-model="quotationData.quotation.serie_id"
              :class="
                'form-control rounded-pill' +
                (errorsCreate['quotation.serie_id'] == null
                  ? ''
                  : ' is-invalid')
              "
              @change="getCurrentNumber()"
            >
              <option v-for="serie in series" :key="serie.id" :value="serie.id">
                {{ serie.serie }}
              </option>
            </select>
            <div
              class="invalid-feedback"
              v-if="errorsCreate['quotation.serie_id']"
            >
              {{ errorsCreate["quotation.serie_id"][0] }}
            </div>
          </div>
        </div>

        <!-- N° COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-hashtag"></i>
              N° de Cotización
            </label>
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
        :voucherType="2"
        :customer="quotationData.customer"
        :errors="errors"
      />

      <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->
      <SearchProducts :currencyExchange="Number(currencyExchange.change)" v-on:setProduct="setProduct"/>

      <!-- VER PRODUCTOS SELECCIONADOS -->
      <div class="row">
        <div
          class="col-12 table-responsive mt-4 mb-4 table-product border rounded"
        >
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 40%">Descripción</th>
                <th style="width: 20%">Tipo IGV</th>
                <th style="width: 3%">Cantidad</th>
                <th style="width: 8%">Descuento</th>
                <th style="width: 8%">Precio</th>
                <th style="width: 8%">Sub Total</th>
                <th style="width: 8%">Total</th>
                <th style="width: 3%"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detail, index) in quotationData.detail" :key="detail">
                <td>
                  <input
                    :class="
                      'form-control rounded-pill' +
                      (errorsCreate['detail.' + index + '.product_id'] == null
                        ? ''
                        : ' is-invalid')
                    "
                    type="text"
                    :value="detail.slug + ' - ' + detail.cod"
                    disabled
                  />
                  <div
                    class="invalid-feedback"
                    v-if="errorsCreate['detail.' + index + '.product_id']"
                  >
                    {{ errorsCreate["detail." + index + ".product_id"][0] }}
                  </div>
                </td>
                <td>
                  <select
                    v-model="detail.igv_type_id"
                    :class="
                      'form-control rounded-pill' +
                      (errorsCreate['detail.' + index + '.igv_type_id'] == null
                        ? ''
                        : ' is-invalid')
                    "
                    @change="getTotals()"
                  >
                    <option
                      v-for="igvType in igvTypes"
                      :key="igvType.id"
                      :value="igvType.id"
                    >
                      {{ igvType.description }}
                    </option>
                  </select>
                  <div
                    class="invalid-feedback"
                    v-if="errorsCreate['detail.' + index + '.igv_type_id']"
                  >
                    {{ errorsCreate["detail." + index + ".igv_type_id"][0] }}
                  </div>
                </td>
                <td>
                  <input
                    :class="
                      'form-control rounded-pill' +
                      (errorsCreate['detail.' + index + '.quantity'] == null
                        ? ''
                        : ' is-invalid')
                    "
                    type="number"
                    min="1"
                    v-model="detail.quantity"
                    @input="getTotals()"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="errorsCreate['detail.' + index + '.quantity']"
                  >
                    {{ errorsCreate["detail." + index + ".quantity"][0] }}
                  </div>
                </td>
                <td>
                  <input
                    :class="
                      'form-control rounded-pill' +
                      (errorsCreate['detail.' + index + '.discount'] == null
                        ? ''
                        : ' is-invalid')
                    "
                    type="number"
                    min="0"
                    step="0.01"
                    v-model="detail.discount"
                    @change="activateOrDesactivateGlobalDiscount"
                    :disabled="activateDetailDiscount"
                    @input="getTotals()"
                  />
                  <div
                    class="invalid-feedback"
                    v-if="errorsCreate['detail.' + index + '.discount']"
                  >
                    {{ errorsCreate["detail." + index + ".discount"][0] }}
                  </div>
                </td>
                <td>
                  <input
                    :class="
                      'form-control rounded-pill' +
                      (errorsCreate['detail.' + index + '.sale_price'] == null
                        ? ''
                        : ' is-invalid')
                    "
                    type="text"
                    v-model="detail.sale_price"
                    disabled
                  />
                  <div
                    class="invalid-feedback"
                    v-if="errorsCreate['detail.' + index + '.sale_price']"
                  >
                    {{ errorsCreate["detail." + index + ".sale_price"][0] }}
                  </div>
                </td>
                <td>
                  <input
                    class="form-control rounded-pill"
                    type="text"
                    disabled
                    :value="detail.subtotal"
                  />
                </td>
                <td>
                  <input
                    class="form-control rounded-pill"
                    type="text"
                    disabled
                    :value="detail.total"
                  />
                </td>
                <td>
                  <button
                    class="btn btn-flat bg-light"
                    @click="deleteItem(index)"
                  >
                    <i class="text-danger fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <div
            class="image-without-products"
            v-if="quotationData.detail.length == 0"
          >
            <img
              src="../../../../../img/add_product.png"
              alt=""
              style="max-height: 120px"
            />
            <h1 class="display-4">Agregue productos</h1>
          </div>
        </div>
      </div>

      <!-- Observación -->
      <div class="row">
        <div class="col-md-8">
          <h4>Detalle Documento</h4>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label for="">
                  <i class="text-danger fas fa-tags"></i>
                  Vendedor
                </label>
                <select
                  v-model="quotationData.quotation.seller_id"
                  :class="
                    'form-control rounded-pill' +
                    (errorsCreate['quotation.seller_id'] == null
                      ? ''
                      : ' is-invalid')
                  "
                >
                  <option
                    v-for="seller in sellers"
                    :key="seller.id"
                    :value="seller.id"
                  >
                    {{ seller.name }}
                  </option>
                </select>
                <div
                  class="invalid-feedback"
                  v-if="errorsCreate['quotation.seller_id']"
                >
                  {{ errorsCreate["quotation.seller_id"][0] }}
                </div>
              </div>
            </div>

            <!-- Descuento Global -->
            <div class="col-md">
              <div class="form-group">
                <label for="">
                  <i class="text-danger fas fa-tags"></i>
                  Descuento
                </label>
                <input
                  :class="
                    'form-control rounded-pill' +
                    (errorsCreate['quotation.discount'] == null
                      ? ''
                      : ' is-invalid')
                  "
                  type="number"
                  min="0"
                  step="0.01"
                  v-model="quotationData.quotation.discount"
                  @change="activateOrDesactivateDetailDiscount"
                  :disabled="activateGlobalDiscount"
                  @input="getTotals()"
                />
                <div
                  class="invalid-feedback"
                  v-if="errorsCreate['quotation.discount']"
                >
                  {{ errorsCreate["quotation.discount"][0] }}
                </div>
              </div>
            </div>

            <!-- Aplica Garantia -->
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
                    v-model="quotationData.quotation.warranty"
                  />
                  <label
                    class="custom-control-label"
                    for="customSwitchCreate"
                    >{{ quotationData.quotation.warranty ? "Si" : "No" }}</label
                  >
                </div>
                <div
                  class="invalid-feedback"
                  v-if="errorsCreate['quotation.warranty']"
                >
                  {{ errorsCreate["quotation.warranty"][0] }}
                </div>
              </div>
            </div>
          </div>
          <!-- Observacion -->
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>
                  <i class="text-danger fas fa-eye"></i>
                  Observación
                </label>
                <textarea
                  cols="30"
                  rows="4"
                  class="form-control rounded-pill px-5"
                  v-model="quotationData.quotation.observation"
                ></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- Totales -->
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr v-show="quotationData.quotation.totalTaxed > 0">
                  <th>Gravado:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.totalTaxed }}</span>
                  </td>
                </tr>
                <tr v-show="quotationData.quotation.totalExonerated > 0">
                  <th>Exonerado:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.totalExonerated }}</span>
                  </td>
                </tr>
                <tr v-show="quotationData.quotation.totalUnaffected > 0">
                  <th>Inafecto:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.totalUnaffected }}</span>
                  </td>
                </tr>
                <tr v-show="quotationData.quotation.totalFree > 0">
                  <th>Gratuita:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.totalFree }}</span>
                  </td>
                </tr>
                <tr v-show="quotationData.quotation.totalIgv > 0">
                  <th>Igv (18%):</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.totalIgv }}</span>
                  </td>
                </tr>
                <tr
                  v-show="
                    quotationData.quotation.discount ||
                    quotationData.quotation.discountItems > 0
                  "
                >
                  <th>Subtotal:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.subtotal }}</span>
                  </td>
                </tr>
                <tr v-show="quotationData.quotation.discount > 0">
                  <th>Descuento global:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.discount }}</span>
                  </td>
                </tr>
                <tr v-show="quotationData.quotation.discountItems > 0">
                  <th>Descuento por item:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.discountItems }}</span>
                  </td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ quotationData.quotation.total }}</span>
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
          <form @submit.prevent="createQuotation()">
            <button
              v-if="!loadingQuotation"
              type="submit"
              class="btn btn-dark float-right"
            >
              <i class="far fa-credit-card"></i> Guardar Cotización
            </button>

            <button
              v-else
              class="btn btn-dark float-right"
              :disabled="loadingQuotation"
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
import SearchProducts from "../../components/SearchProducts.vue";
export default {
  components: { BaseUrl, SearchCustomers, SearchProducts },
  async created() {
    await BaseUrl.get(`api/quotations/create`).then((resp) => {
      this.currencyExchange = resp.data.data.currencyExchange
      this.identificationDocuments = resp.data.data.identificationDocuments
      this.igvTypes = resp.data.data.igvTypes

      this.sellers = resp.data.data.sellers
      this.series = resp.data.data.series
      this.quotationData.quotation.serie_id = this.series[0].id
      this.getCurrentNumber()
    });

    this.loader.hide()

  },
  data() {
    return {

      loader: null,
      loadingQuotation: false,

      currencyExchange: {},
      identificationDocuments: [],
      igvTypes: [],

      sellers: [],
      series: [],

      currentNumber: "Selecciona una serie",

      activateGlobalDiscount: false,
      activateDetailDiscount: false,

      quotationData: {
        customer: {
          id: null,
        },
        quotation: {
          seller_id: null,
          subtotal: 0,
          discount: 0,
          totalIgv: 0,
          totalExonerated: 0,
          totalUnaffected: 0,
          totalFree: 0,
          totalTaxed: 0,
          total: 0,

          discountItems: 0,

          observation: "",
          warranty: false,
          date_due: null,
          serie_id: "",
        },
        detail: [],
      },
      errors: [],
      errorsCreate: {},
    };
  },
  mounted(){
    this.loader = this.$loading.show({
      canCancel: true,
    });
  },
  methods: {
    getCurrentNumber() {
      let serieBackup = this.series;
      let serieFilter = serieBackup.filter(
        (series) => series.id == this.quotationData.quotation.serie_id
      );
      this.currentNumber = serieFilter[0].current_number + 1;
    },
    setProduct(product, price){
      
      let index = this.quotationData.detail.findIndex(
        (element) => element.product_id == product.id
      );

      if (index == -1) {
        this.quotationData.detail.push({
          discount: 0,
          subtotal: 0,
          total: 0,

          product_id: product.id,
          slug: product.slug,
          cod: product.cod,
          affect_icbper: false,
          igv_type_id: product.igv_type_id,
          description: product.name,
          brand: product.brand,
          sale_price: price,
          quantity: 1,
        });

        this.getTotals();
      }
      
    },
    deleteItem(index) {
      this.quotationData.detail.splice(index, 1)
      this.getTotals()
    },
    activateOrDesactivateGlobalDiscount() {
      // recorrer el array detalle en busca de un descuento
      let discount = 0;
      this.quotationData.detail.forEach((e) => {
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
        this.quotationData.quotation.discount > 0 ? true : false;
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

      this.quotationData.detail.forEach((e) => {
        discountItems += e.discount;

        switch (parseInt(e.igv_type_id)) {
          case 10: //Gravado - Operación Onerosa
            // hallar el precio sin igv
            let priceWithoutIgv = e.sale_price / (1 + igv)

            // hallar el subtotal = (precio sin igv * cantidad) - descuento
            e.subtotal = this.roundToTwo(priceWithoutIgv * e.quantity).toFixed(2)

            // hallar el total = (subtotal * 1.18)
            e.total = this.roundToTwo((priceWithoutIgv * e.quantity) * (1 + igv)).toFixed(2)

            // Actualizar totales globales
            subtotal += Number(e.subtotal)
            totalIgv += Number(e.total - e.subtotal)
            totalTaxed += Number(e.subtotal)
            total += Number(e.total)
            break;
          case 11: //[Gratuita] Gravado – Retiro por premio
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 12: //[Gratuita] Gravado – Retiro por donación
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 13: //[Gratuita] Gravado – Retiro
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 14: //[Gratuita] Gravado – Retiro por publicidad
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 15: //[Gratuita] Gravado – Bonificaciones
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 16: //[Gratuita] Gravado – Retiro por entrega a trabajadores
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 20: //Exonerado - Operación Onerosa
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalExonerated += Number(e.subtotal)
            total += Number(e.total)
            break;
          case 30: //Inafecto - Operación Onerosa
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalUnaffected += Number(e.subtotal)
            total += Number(e.total)
            break;
          case 31: //[Gratuita] Inafecto – Retiro por Bonificación
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 32: //[Gratuita] Inafecto – Retiro
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 33: //[Gratuita] Inafecto – Retiro por Muestras Médicas
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break;
          case 34: //[Gratuita] Inafecto - Retiro por Convenio Colectivo
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break
          case 35: //[Gratuita] Inafecto – Retiro por premio
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break
          case 36: //[Gratuita] Inafecto - Retiro por publicidad
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalFree += Number(e.total)
            break
          case 40: //Exportación
            e.subtotal = this.roundToTwo(e.sale_price * e.quantity).toFixed(2)
            e.total = this.roundToTwo(e.subtotal).toFixed(2)
            subtotal += Number(e.subtotal)
            totalUnaffected += Number(e.subtotal)
            total += Number(e.total)
            break
        }
      });

      this.quotationData.quotation.subtotal = this.roundToTwo(subtotal + totalIgv).toFixed(2);
      this.quotationData.quotation.totalIgv = this.roundToTwo(totalIgv).toFixed(2);
      this.quotationData.quotation.totalExonerated = this.roundToTwo(totalExonerated).toFixed(2);
      this.quotationData.quotation.totalUnaffected = this.roundToTwo(totalUnaffected).toFixed(2);
      this.quotationData.quotation.totalFree = this.roundToTwo(totalFree).toFixed(2);
      this.quotationData.quotation.totalTaxed = this.roundToTwo(totalTaxed).toFixed(2);
      this.quotationData.quotation.discountItems = this.roundToTwo(discountItems).toFixed(2);
      this.quotationData.quotation.total = this.roundToTwo(total - this.quotationData.quotation.discount - this.quotationData.quotation.discountItems).toFixed(2);
    },
    roundToTwo(num) {
      return +(Math.round(num + "e+2") + "e-2");
    },

    createQuotation() {
      this.loadingQuotation = true;

      BaseUrl.post("/api/quotations", this.quotationData)
        .then((response) => {
          console.log(response);

          this.errorsCreate = {};

          this.$router.replace({ name: "quotation-list" });
          Swal.fire(
            "Cotización Creada",
            "Se ha creado la Cotización " + response.data,
            "success"
          );
        })
        .catch((error) => {
          console.log(error.response);
          this.errorsCreate = error.response.data.errors;

          if (this.errorsCreate["detail"] != null) {
            Swal.fire(
              "Algo salio mal",
              this.errorsCreate["detail"][0],
              "error"
            );
          }
        })
        .finally(() => {
          this.loadingQuotation = false;
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
.option__relative {
  position: relative;
  z-index: 99;
}
.option__contenedor {
  box-sizing: border-box;
  border-radius: 5px;
  width: 100%;
  max-height: 200px;
  box-shadow: 0 0 2px 0 rgb(128, 189, 255);
  background-color: #fff;
  box-sizing: border-box;
  cursor: pointer;
  overflow-y: scroll;
  position: absolute;
  z-index: 100;
}
.option__contenedor input,
.search input {
  display: block;
  margin-left: auto;
  margin-right: auto;
  /*border-color: #93a8c3;*/
  outline-color: rgb(128, 189, 255);
  border-style: solid;
  border-width: 1px;
  /*color:rgb(172,173,182)*/
}
.option__contenedor table {
  width: 100%;
  padding: 8px 10px;
  margin: 0;
}
.option__contenedor::-webkit-scrollbar {
  width: 7px;
  background-color: rgb(128, 189, 255);
}
.option__contenedor::-webkit-scrollbar-thumb {
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  border-right: 1px solid rgb(128, 189, 255);
  border-left: 1px solid rgb(128, 189, 255);
}
.search .option__contenedor {
  top: 0;
}
.search input {
  width: 100%;
  height: 40px;
  border-radius: 5px;
}

.table-product {
  min-height: 250px;
}
.table-product table {
  min-width: 900px;
}
.image-without-products {
  display: flex;
  justify-content: center;
  align-items: center;
  align-content: center;
  opacity: 0.7;
  height: 150px;
  width: 100%;
  min-width: 850px;
}
.image-without-products img {
  margin-bottom: 0.5rem;
  margin-right: 0.5rem;
}
</style>
