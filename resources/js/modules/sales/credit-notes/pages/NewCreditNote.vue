<template>
  <div class="content-header">
    <h3>Registrar Nueva de Nota de Crédito</h3>
  </div>
  <div class="card">
    <div class="card-body">

      <h4>Comprobante a modificar:</h4>
      <div class="row">
        <!-- TIPO DE COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-calendar-times"></i>
              Tipo de documento
            </label>
            <select class="form-control rounded-pill" v-model="voucherToModify.voucherType" @change="getSeries()">
              <option 
                v-for="voucherType in voucherTypes" 
                :key="voucherType.id"
                :value="voucherType.id"
              >
                {{ voucherType.description }}
              </option>
            </select>
          </div>
        </div>
        <!-- SERIE -->
        <div class="col-md-3">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-barcode"></i>
              Serie
            </label>
            <select
              v-model="voucherToModify.serie"
              class="form-control rounded-pill"
            >
              <option v-for="serie in voucherToModifySeries" :key="serie.id" :value="serie.id">
                {{ serie.serie }}
              </option>
            </select>
          </div>
        </div>

        <!-- N° COMPROBANTE -->
        <div class="col-md-3">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-hashtag"></i>
              N° de Documento
            </label>
            <input
              v-model="voucherToModify.documentNumber"
              type="text"
              class="form-control rounded-pill"
            />
          </div>
        </div>

        <!-- Button Search -->
        <div class="col-md-2 d-flex align-items-center justify-content-center">
          <button v-if="!loadingSearchVoucher" type="button" class="btn btn-md btn-block btn-dark" @click="getVoucherToModify()">
            <i class="fas fa-search"></i>
            Buscar
          </button>
          <button v-else class="btn btn-md btn-block btn-dark" :disabled="loadingSearchVoucher">
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </button>
        </div>
      </div>

      <h4>Comprobante</h4>
      <div class="row">
        <!-- SERIE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-barcode"></i>
              Serie
            </label>
            <select
              v-model="creditNote.serie_id"
              class="form-control rounded-pill"
              @change="getCurrentNumber()"
            >
              <option v-for="serie in creditNoteSeries" :key="serie.id" :value="serie.id">
                {{ serie.serie }}
              </option>
            </select>
          </div>
        </div>

        <!-- N° COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-hashtag"></i>
              N° de Nota de Crédito
            </label>
            <input
              v-model="currentNumber"
              type="text"
              class="form-control rounded-pill"
              disabled
            />
          </div>
        </div>

        <!-- MOTIVO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-hashtag"></i>
              Motivo
            </label>
            <select class="form-control rounded-pill" v-model="creditNote.credit_note_type_id" required>
              <option v-for="creditNoteType in creditNoteTypes" :key="creditNoteType.id" :value="creditNoteType.id">
                {{ creditNoteType.description }}
              </option>
            </select>
          </div>
        </div>
      </div>

      <h4 >Datos del Cliente</h4>
      <div class="row mb-3">
        <!-- TIPO DOCUMENTO -->
        <div class="col-md-3">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fas fa-address-card"></i>
              Tipo documento
            </label>
            <input type="text" class="form-control rounded-pill" :value="customer.documentType" disabled />
          </div>
        </div>

        <!-- N° DOCUMENTO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fas fa-pen"></i>
              N° Documento
            </label>
            <input type="text" class="form-control rounded-pill" :value="customer.document" disabled />
          </div>
        </div>

        <!-- NOMBRE/RAZON SOCIAL -->
        <div class="col-md-5">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-id-badge"></i>
              Nombre/Razón Social:
            </label>
            <input type="text" class="form-control rounded-pill" :value="customer.name" disabled />
          </div>
        </div>
      </div>

      <!-- VER PRODUCTOS SELECCIONADOS -->
      <h4>
        <i class="text-danger fas fa-box"></i>
        Productos
      </h4>
      <div class="row">
        <div
          class="col-12 table-responsive mt-4 mb-4 table-product border rounded"
        >
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 2%"></th>
                <th style="width: 35%">Descripción</th>
                <th style="width: 20%">Tipo IGV</th>
                <th style="width: 3%">Cantidad</th>
                <th style="width: 10%">Precio</th>
                <th style="width: 10%">Sub Total</th>
                <th style="width: 10%">Total</th>
                <th style="width: 5%">Series</th>
                <th style="width: 3%"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detail, index) in creditNote.details" :key="detail">
                <td>
                  <Popper class="light" arrow>
                    <button type="button" class="btn btn-flat bg-light">
                      <i class="text-primary fas fa-eye"></i>
                    </button>
                    
                    <template v-slot:content>
                      <b>Precio: </b>{{ detail.oldTotals.price }}
                      <br>
                      <b>Descuento: </b>{{ detail.oldTotals.discount }}
                      <br>
                      <b>SubTotal: </b>{{ detail.oldTotals.subtotal }}
                      <br>
                      <template v-if="detail.oldTotals.totalIgv > 0">
                        <b>Igv (18%): </b>{{ detail.oldTotals.totalIgv }}
                        <br>
                      </template>
                      <b>Total: </b>{{ detail.oldTotals.total }}
                      <br>
                    </template>
                  </Popper>
                </td>
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
                    :value="detail.igv_type_id"
                    class="form-control rounded-pill"
                    disabled
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
                    @change="addSeries(index)"
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
                      (errorsCreate['detail.' + index + '.sale_price'] == null
                        ? ''
                        : ' is-invalid')
                    "
                    type="number"
                    min="0.01"
                    step="0.01"
                    v-model="detail.sale_price"
                    @input="getTotals()"
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
                  <input
                    :disabled="!detail.manager_series"
                    type="button"
                    class="btn btn-dark btn-sm"
                    value="Series"
                    @click="showModalSeries(index)"
                  >
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
            v-if="creditNote.details.length == 0"
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

      <!-- MODAL SERIES -->
      <div
        v-if="creditNote.details.length !== 0"
        class="modal fade"
        id="modal-series"
        tabindex="-1"
        role="dialog"
        aria-labelledby="seriesModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="seriesModalLabel">
                Registrar series para {{ creditNote.details[index].slug }} - {{ creditNote.details[index].cod }}
              </h5>
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
              <div
                v-for="(serie, i) in creditNote.details[index].series"
                :key="serie"
                class="form-group"
              >
                <v-select v-model="creditNote.details[index].series[i]" label="serie" :options="creditNote.details[index].seriesSearch" >
                  <template v-slot:no-options="{ search, searching }">
                    <template v-if="searching">
                      No se encontraron resultados para <b><em>{{ search }}</em></b>.
                    </template>
                    <em v-else style="opacity: 0.5">Escribe la serie del producto.</em>
                  </template>
                </v-select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-dark" data-dismiss="modal">
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Observación -->
      <div class="row">
        <div class="col-md-8">
          <h4>Detalle Documento</h4>
          <div class="row">
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
                  v-model="creditNote.discount"
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
                  :value="creditNote.observation"
                  disabled
                ></textarea>
              </div>
            </div>
          </div>
        </div>

        <!-- Totales -->
        <div class="col-md-4">
            <h5 class="lead mb-2 text-center">Resumen:</h5>
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr v-show="creditNote.totalTaxed > 0">
                  <th>Gravado:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.totalTaxed }}</span>
                  </td>
                </tr>
                <tr v-show="creditNote.totalExonerated > 0">
                  <th>Exonerado:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.totalExonerated }}</span>
                  </td>
                </tr>
                <tr v-show="creditNote.totalUnaffected > 0">
                  <th>Inafecto:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.totalUnaffected }}</span>
                  </td>
                </tr>
                <tr v-show="creditNote.totalFree > 0">
                  <th>Gratuita:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.totalFree }}</span>
                  </td>
                </tr>
                <tr v-show="creditNote.totalIgv > 0">
                  <th>Igv (18%):</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.totalIgv }}</span>
                  </td>
                </tr>
                <tr
                  v-show="
                    creditNote.discount ||
                    creditNote.discountItems > 0
                  "
                >
                  <th>Subtotal:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.subtotal }}</span>
                  </td>
                </tr>
                <tr v-show="creditNote.discount > 0">
                  <th>Descuento global:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.discount }}</span>
                  </td>
                </tr>
                <tr v-show="creditNote.discountItems > 0">
                  <th>Descuento por item:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.discountItems }}</span>
                  </td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td class="d-flex justify-content-between">
                    <span>S/.</span
                    ><span>{{ creditNote.total }}</span>
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
          <form @submit.prevent="createCreditNote()">
            <button
              v-if="!loadingCreditNote"
              type="submit"
              class="btn btn-dark float-right"
            >
              <i class="far fa-credit-card"></i> Guardar Nota de Crédito
            </button>

            <button
              v-else
              class="btn btn-dark float-right"
              :disabled="loadingCreditNote"
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
import Popper from "vue3-popper"
export default {
  components: { BaseUrl, Popper},
  async created() {
    await BaseUrl.get(`api/credit-notes/create`).then((resp) => {
      this.voucherTypes = resp.data.data.voucherTypes
      this.voucherToModify.voucherType = this.voucherTypes[0].id

      this.series = resp.data.data.series
      this.getSeries()

      this.creditNoteTypes = resp.data.data.creditNotesTypes
      this.igvTypes = resp.data.data.igvTypes
    })

    if (this.$route.query.voucherType && this.$route.query.serie && this.$route.query.documentNumber) {
      
      this.voucherToModify.voucherType = this.$route.query.voucherType
      this.voucherToModify.serie = this.$route.query.serie
      this.voucherToModify.documentNumber = this.$route.query.documentNumber
      this.getVoucherToModifySeries()
      this.getCreditNoteSeries()
      this.getVoucherToModify()
    }

    this.loader.hide();
  },
  data() {
    return {
      loader: null,
      loadingCreditNote: false,
      loadingSearchVoucher: false,

      voucherTypes: [],
      series: [],
      creditNoteTypes: [],
      igvTypes: [],

      index: 0,

      voucherToModifySeries: [],
      creditNoteSeries: [],

      currentNumber: null,

      voucherToModify: {
        voucherType: null,
        serie: null,
        documentNumber: null
      },

      creditNote: {
        sale_id: null,
        serie_id: null,
        credit_note_type_id: null,

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

        details: []

      },

      customer: {
        documentType: null,
        document: null,
        name: null
      },

      activateGlobalDiscount: false,
      activateDetailDiscount: false,

      errors: [],
      errorsCreate: {},
    };
  },
  mounted() {
    this.loader = this.$loading.show({
      canCancel: true,
    });
  },
  methods: {
    getSeries() {
      this.getVoucherToModifySeries()
      this.voucherToModify.serie = this.voucherToModifySeries[0].id
      this.getCreditNoteSeries()
    },
    getVoucherToModifySeries(){
      let serieBackup = this.series
      this.voucherToModifySeries = serieBackup.filter(
        (serie) => serie.voucher_type_id == this.voucherToModify.voucherType
      )
    },
    getCreditNoteSeries(){
      let serieBackup = this.series
      let type = this.voucherToModify.voucherType == 1 ? 4 : this.voucherToModify.voucherType == 2 ? 5 : null
      this.creditNoteSeries = serieBackup.filter(
        (serie) => serie.voucher_type_id == type
      )
      this.creditNote.serie_id = this.creditNoteSeries[0].id
      this.getCurrentNumber()
    },
    getCurrentNumber() {
      let serieBackup = this.series;
      let serieFilter = serieBackup.filter(
        (series) => series.id == this.creditNote.serie_id
      );
      this.currentNumber = serieFilter[0].current_number + 1;
    },
    showModalSeries(index) {
      this.index = index
      $('#modal-series').modal("show")
    },
    addSeries(i){
      if (this.creditNote.details[i].manager_series) {
        let dif = this.creditNote.details[i].quantity - this.creditNote.details[i].series.length
        if (dif > 0) {
          for (let j = 0; j < dif; j++) {
            this.creditNote.details[i].series.push('')
          }
        } else {
          for (let j = 0; j < -dif; j++) {
            this.creditNote.details[i].series.pop(1)
          }
        }
      }

    },
    getVoucherToModify() {

      this.loadingSearchVoucher = true

      this.creditNote.details = []
      this.creditNote.sale_id = null
      this.creditNote.discount = null
      this.creditNote.observation = null
      this.customer = {
        documentType: null,
        document: null,
        name: null
      }

      BaseUrl.get(`api/credit-notes/voucher/${this.voucherToModify.serie}/${this.voucherToModify.documentNumber}`).then((resp) => {
        this.customer.documentType = resp.data.data.customer.identification_document.description
        this.customer.document = resp.data.data.customer.document
        this.customer.name = resp.data.data.customer.name

        this.creditNote.sale_id = resp.data.data.id

        this.creditNote.discount = Number(resp.data.data.global_discount)
        this.creditNote.observation = resp.data.data.observation

        resp.data.data.sale_details.forEach((e, i) => {
          this.creditNote.details.push({
            subtotal: 0,
            total: 0,
            discount: 0,
            product_id: e.branch_product.id,
            slug: e.branch_product.product.slug,
            cod: e.branch_product.product.cod,
            affect_icbper: false,
            igv_type_id: e.igv_type_id,
            description: e.branch_product.product.name,
            brand: e.branch_product.product.brand.description,
            sale_price: Number(e.unit_value),
            quantity: e.quantity,

            manager_series: Boolean(e.branch_product.product.manager_series),

            series: [],
            seriesSearch: e.series,

            oldTotals: {
              price: Number(Number(e.unit_value) + Number(e.discount / e.quantity)).toFixed(2),
              discount: Number(e.discount).toFixed(2),
              subtotal: Number(e.subtotal).toFixed(2),
              total: Number(e.total).toFixed(2),
              totalIgv: Number(e.total_igv).toFixed(2)
            }
          })
          for (let index = 0; index < e.quantity; index++) {
            this.addSeries(i)
          }
        })
        console.log(resp.data.data)
      })
      .catch((error) => {
        console.log(error.response);
      })
      .finally(() => {
        this.loadingSearchVoucher = false;
        this.getTotals()
        this.activateOrDesactivateGlobalDiscount()
        this.activateOrDesactivateDetailDiscount()
      })
    },
    deleteItem(index) {
      this.creditNote.details.splice(index, 1);
      this.getTotals();
    },
    activateOrDesactivateGlobalDiscount() {
      // recorrer el array detalle en busca de un descuento
      let discount = 0;
      this.creditNote.details.forEach((e) => {
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
        this.creditNote.discount > 0 ? true : false;
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

      this.creditNote.details.forEach((e) => {
        discountItems += e.discount;

        switch (parseInt(e.igv_type_id)) {
          case 10: //Gravado - Operación Onerosa
            // hallar el precio sin igv
            let priceWithoutIgv = e.sale_price / (1 + igv);

            // hallar el subtotal = (precio sin igv * cantidad) - descuento
            e.subtotal = this.roundToTwo(
              priceWithoutIgv * e.quantity
            ).toFixed(2);

            // hallar el total = (subtotal * 1.18)
            e.total = this.roundToTwo(
              (priceWithoutIgv * e.quantity) * (1 + igv)
            ).toFixed(2);

            // Actualizar totales globales
            subtotal += Number(e.subtotal);
            totalIgv += Number(e.total - e.subtotal);
            totalTaxed += Number(e.subtotal);
            total += Number(e.total);
            break;
          case 11: //[Gratuita] Gravado – Retiro por premio
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 12: //[Gratuita] Gravado – Retiro por donación
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 13: //[Gratuita] Gravado – Retiro
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 14: //[Gratuita] Gravado – Retiro por publicidad
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 15: //[Gratuita] Gravado – Bonificaciones
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 16: //[Gratuita] Gravado – Retiro por entrega a trabajadores
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 20: //Exonerado - Operación Onerosa
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalExonerated += Number(e.subtotal);
            total += Number(e.total);
            break;
          case 30: //Inafecto - Operación Onerosa
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalUnaffected += Number(e.subtotal);
            total += Number(e.total);
            break;
          case 31: //[Gratuita] Inafecto – Retiro por Bonificación
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 32: //[Gratuita] Inafecto – Retiro
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 33: //[Gratuita] Inafecto – Retiro por Muestras Médicas
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 34: //[Gratuita] Inafecto - Retiro por Convenio Colectivo
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 35: //[Gratuita] Inafecto – Retiro por premio
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 36: //[Gratuita] Inafecto - Retiro por publicidad
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalFree += Number(e.total);
            break;
          case 40: //Exportación
            e.subtotal = this.roundToTwo(
              e.sale_price * e.quantity
            ).toFixed(2);
            e.total = this.roundToTwo(e.subtotal).toFixed(2);
            subtotal += Number(e.subtotal);
            totalUnaffected += Number(e.subtotal);
            total += Number(e.total);
            break;
        }
      });

      this.creditNote.subtotal =
        this.roundToTwo(subtotal + totalIgv).toFixed(2);
      this.creditNote.totalIgv =
        this.roundToTwo(totalIgv).toFixed(2);
      this.creditNote.totalExonerated =
        this.roundToTwo(totalExonerated).toFixed(2);
      this.creditNote.totalUnaffected =
        this.roundToTwo(totalUnaffected).toFixed(2);
      this.creditNote.totalFree =
        this.roundToTwo(totalFree).toFixed(2);
      this.creditNote.totalTaxed =
        this.roundToTwo(totalTaxed).toFixed(2);
      this.creditNote.discountItems =
        this.roundToTwo(discountItems).toFixed(2);
      this.creditNote.total = this.roundToTwo(
        total - this.creditNote.discount - this.creditNote.discountItems
      ).toFixed(2);
    },
    roundToTwo(num) {
      return +(Math.round(num + "e+2") + "e-2");
    },

    createCreditNote() {
      this.loadingCreditNote = true;

      BaseUrl.post("/api/credit-notes", this.creditNote)
        .then((response) => {
          console.log(response);

          this.errorsCreate = {};

          this.$router.replace({ name: "credit-notes-list" });
          Swal.fire("Comprobante Creado", response.data, "success");
        })
        .catch((error) => {
          console.log(error.response);
        })
        .finally(() => {
          this.loadingCreditNote = false;
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
.light {
  --popper-theme-background-color: #ffffff;
  --popper-theme-background-color-hover: #ffffff;
  --popper-theme-text-color: #333333;
  --popper-theme-border-width: 1px;
  --popper-theme-border-style: solid;
  --popper-theme-border-color: #eeeeee;
  --popper-theme-border-radius: 6px;
  --popper-theme-padding: 20px;
  --popper-theme-box-shadow: 0 6px 30px -6px rgba(0, 0, 0, 0.25);
}
</style>
