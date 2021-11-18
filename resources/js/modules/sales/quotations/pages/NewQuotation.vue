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
            <input type="date" :class="'form-control rounded-pill' + (errorsCreate['quotation.date_due'] == null ? '' : ' is-invalid')" v-model="quotationData.quotation.date_due" required>
            <div class="invalid-feedback" v-if="errorsCreate['quotation.date_due'] ">
              {{ errorsCreate['quotation.date_due'][0] }}
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
            <select v-model="quotationData.quotation.serie_id" :class="'form-control rounded-pill' + (errorsCreate['quotation.serie_id'] == null ? '' : ' is-invalid')" @change="getCurrentNumber()">
              <option v-for="serie in series" :key="serie.id" :value="serie.id">
                {{ serie.serie }}
              </option>
            </select>
            <div class="invalid-feedback" v-if="errorsCreate['quotation.serie_id'] ">
              {{ errorsCreate['quotation.serie_id'][0] }}
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
            <input v-model="currentNumber" type="text" class="form-control rounded-pill" disabled>
          </div>
        </div>
      </div>

      <SearchCustomers :voucherType="2" :customer="quotationData.customer" :errors="errors"/>

      <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->
      <div class="row">
        <div class="col-md ">
          <h4>
            <i class="text-danger fas fa-box"></i>
            Productos
          </h4>
          <div class="">
            <input type="search"  v-model="productSearch" @keyup="searchProducts" class="form-control rounded-pill form-control rounded-pill-lg" placeholder="Escribe tu producto o código">
            <div class="option__relative">
              <div class="option__contenedor" >
                <div>
                  <table table class="table table-sm table-bordered table-hover bg-white shadow-lg">
                    <thead v-if="productSearchFilter.length > 0" class="thead-dark text-center">
                      <tr>
                        <td>Nombre</td>
                        <td>Marca</td>
                        <td>Precio 1</td>
                        <td>Precio 2</td>
                        <td>Precio 3</td>
                        <td>Stock</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="filSearch in productSearchFilter" :key="filSearch">
                        <td>{{ filSearch.name }}</td>
                        <td class="col-2 text-center">{{ filSearch.brand }}</td>
                        <td class="col-2 text-center">
                          <input class="btn btn-sm btn-success w-50" type="button" :value="filSearch.sale_price" @click="priceOne(filSearch)">
                        </td>
                        <td class="col-2 text-center">
                          <input class="btn btn-sm btn-warning w-50" type="button" :value="filSearch.referential_sale_price_one" @click="priceTwo(filSearch)">
                        </td>
                        <td class="col-2 text-center">
                          <input class="btn btn-sm btn-info w-50" type="button" :value="filSearch.referential_sale_price_two" @click="priceThree(filSearch)">
                        </td>
                        <td class="col-1 text-center">{{ filSearch.stock }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- VER PRODUCTOS SELECCIONADOS -->
      <div class="row">
        <div class="col-12 table-responsive mt-4">
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
                  <input :class="'form-control rounded-pill' + (errorsCreate['detail.'+ index +'.product_id'] == null ? '' : ' is-invalid')" type="text" :value="detail.description + ' - ' + detail.brand + ' - ' + detail.cod" disabled>
                  <div class="invalid-feedback" v-if="errorsCreate['detail.'+ index +'.product_id']">
                    {{ errorsCreate['detail.'+ index +'.product_id'][0] }}
                  </div>
                </td>
                <td>
                  <select v-model="detail.igv_type_id" :class="'form-control rounded-pill' + (errorsCreate['detail.'+ index +'.igv_type_id'] == null ? '' : ' is-invalid')" @change="getTotals()">
                    <option v-for="igvType in igvTypes" :key="igvType.id" :value="igvType.id">
                      {{ igvType.description }}
                    </option>
                  </select>
                  <div class="invalid-feedback" v-if="errorsCreate['detail.'+ index +'.igv_type_id']">
                    {{ errorsCreate['detail.'+ index +'.igv_type_id'][0] }}
                  </div>
                </td>
                <td>
                  <input :class="'form-control rounded-pill' + (errorsCreate['detail.'+ index +'.quantity'] == null ? '' : ' is-invalid')" type="number" min="1" v-model="detail.quantity" @input="getTotals()">
                  <div class="invalid-feedback" v-if="errorsCreate['detail.'+ index +'.quantity']">
                    {{ errorsCreate['detail.'+ index +'.quantity'][0] }}
                  </div>
                </td>
                <td>
                  <input :class="'form-control rounded-pill' + (errorsCreate['detail.'+ index +'.discount'] == null ? '' : ' is-invalid')" type="number" min="0" step="0.001" v-model="detail.discount" @change="activateOrDesactivateGlobalDiscount" :disabled="activateDetailDiscount" @input="getTotals()">
                  <div class="invalid-feedback" v-if="errorsCreate['detail.'+ index +'.discount']">
                    {{ errorsCreate['detail.'+ index +'.discount'][0] }}
                  </div>
                </td>
                <td>
                  <input :class="'form-control rounded-pill' + (errorsCreate['detail.'+ index +'.sale_price'] == null ? '' : ' is-invalid')" type="text" v-model="detail.sale_price" disabled>
                  <div class="invalid-feedback" v-if="errorsCreate['detail.'+ index +'.sale_price']">
                    {{ errorsCreate['detail.'+ index +'.sale_price'][0] }}
                  </div>
                </td>
                <td>
                  <input class="form-control rounded-pill" type="text" disabled :value="detail.subtotal">
                </td>
                <td>
                  <input class="form-control rounded-pill" type="text" disabled :value="detail.total">
                </td>
                <td>
                  <button class="btn btn-flat bg-light" @click="deleteItem(index)">
                    <i class="text-danger fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
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
                  <i class="text-danger fas fa-money-bill"></i>
                  Tipo de pago
                </label>
                <select v-model="quotationData.quotation.payment_type_id" :class="'form-control rounded-pill' + (errorsCreate['quotation.payment_type_id'] == null ? '' : ' is-invalid')">
                  <option v-for="paymentType in paymentTypes" :key="paymentType.id" :value="paymentType.id">
                    {{ paymentType.description }}
                  </option>
                </select>
                <div class="invalid-feedback" v-if="errorsCreate['quotation.payment_type_id'] ">
                  {{ errorsCreate['quotation.payment_type_id'][0] }}
                </div>
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label for="">
                  <i class="text-danger fas fa-tags"></i>
                  Descuento
                </label>
                <input :class="'form-control rounded-pill' + (errorsCreate['quotation.discount'] == null ? '' : ' is-invalid')" type="number" min="0" step="0.001"
                v-model="quotationData.quotation.discount" @change="activateOrDesactivateDetailDiscount" :disabled="activateGlobalDiscount" @input="getTotals()">
                <div class="invalid-feedback" v-if="errorsCreate['quotation.discount'] ">
                  {{ errorsCreate['quotation.discount'][0] }}
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group text-center">
                <label>
                  <i class="text-danger fas fa-file-contract"></i>
                  ¿Aplica garantía?
                </label>
                <div class="custom-control custom-switch custom-switch-on-danger is-invalid">
                  <input type="checkbox" class="custom-control-input" id="customSwitchCreate" v-model="quotationData.quotation.warranty">
                  <label class="custom-control-label" for="customSwitchCreate">{{ quotationData.quotation.warranty ? 'Si' : 'No' }}</label>
                </div>
                <div class="invalid-feedback" v-if="errorsCreate['quotation.warranty'] ">
                  {{ errorsCreate['quotation.warranty'][0] }}
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label>
                  <i class="text-danger fas fa-eye"></i>
                  Observación
                </label>
                <textarea cols="30" rows="4" class="form-control rounded-pill px-5" v-model="quotationData.quotation.observation"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr v-show="quotationData.quotation.discount > 0">
                  <th>Descuento global:</th>
                  <td>S/. {{ quotationData.quotation.discount }}</td>
                </tr>
                <tr v-show="quotationData.quotation.discountItems > 0">
                  <th>Descuento por item:</th>
                  <td>S/. {{ quotationData.quotation.discountItems }}</td>
                </tr>
                <tr v-show="quotationData.quotation.totalTaxed > 0">
                  <th>Gravado:</th>
                  <td>S/. {{ quotationData.quotation.totalTaxed }}</td>
                </tr>
                <tr v-show="quotationData.quotation.totalExonerated > 0">
                  <th>Exonerado:</th>
                  <td>S/. {{ quotationData.quotation.totalExonerated }}</td>
                </tr>
                <tr v-show="quotationData.quotation.totalUnaffected > 0">
                  <th>Inafecto:</th>
                  <td>S/. {{ quotationData.quotation.totalUnaffected }}</td>
                </tr>
                <tr v-show="quotationData.quotation.totalFree > 0">
                  <th>Gratuita:</th>
                  <td>S/. {{ quotationData.quotation.totalFree }}</td>
                </tr>
                <tr v-show="quotationData.quotation.totalIgv > 0">
                  <th>Igv (18%):</th>
                  <td>S/. {{ quotationData.quotation.totalIgv }}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>S/. {{ quotationData.quotation.total }}</td>
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
            <button type="submit" class="btn btn-dark float-right">
              <i class="far fa-credit-card"></i> Guardar Cotización
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
export default {
  components: { BaseUrl, SearchCustomers },
  async created() {

    await BaseUrl.get(`api/sales/identificationdocuments`).then((resp) => {
      this.identificationDocuments = resp.data.data;
    });

    await BaseUrl.get(`api/sales/products`).then((resp) => {
      this.products = resp.data.data;
    });

    await BaseUrl.get(`api/sales/igvtypes`).then((resp) => {
      this.igvTypes = resp.data.data;
    });

    await BaseUrl.get(`api/sales/paymenttypes`).then((resp) => {
      this.paymentTypes = resp.data.data;
      this.quotationData.quotation.payment_type_id = this.paymentTypes[0].id
    });

    this.getSeries()

  },
  data() {
    return {

      series: {},
      currentNumber: 'Selecciona una serie',
      paymentTypes: null,

      productSearch:'',
      productSearchFilter: [],

      activateGlobalDiscount: false,
      activateDetailDiscount: false,

      identificationDocuments: [],
      igvTypes: [],
      products: {},
      quotationData: {
        customer: {
          id: null
        },
        quotation: {

          subtotal : 0,
          discount : 0,
          totalIgv : 0,
          totalExonerated : 0,
          totalUnaffected : 0,
          totalFree : 0,
          totalTaxed : 0,
          total : 0,

          discountItems: 0,

          observation: '',
          warranty: false,
          date_due: null,
          serie_id: '',
          payment_type_id: null,
        },
        detail: []
      },
      errors: [],
      errorsCreate: {

      }
    };
  },
  mounted(){
    const contain = document.querySelector('.card')
    contain.addEventListener('click', (e)=> {
      if (e.target.className !='inputContent') {
        this.productSearchFilter=''
      }
    })
  },
  methods:{

    async getSeries() {
      await BaseUrl.get(`api/quotations/series`).then((resp) => {
        this.series = resp.data.data;
        this.quotationData.quotation.serie_id = this.series[0].id
        this.getCurrentNumber()
      });
    },
    getCurrentNumber() {
      let serieBackup = this.series;
      let serieFilter = serieBackup.filter(
        (series) => series.id == this.quotationData.quotation.serie_id
      );
      this.currentNumber = serieFilter[0].current_number + 1;
    },

    searchProducts(){

      let produtsBackup = this.products
      let wordFilter = this.productSearch.toLowerCase();

      if(wordFilter===''){
        this.productSearchFilter=''
      }else{
        this.productSearchFilter = produtsBackup.filter(products =>
          (products.name.toLowerCase().indexOf(wordFilter) !== -1)
        );
      }

    },
    priceOne(filSearch){

      const product = {
        discount : 0,
        subtotal: 0,
        total: 0,

        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : filSearch.igv_type_id,
        description : filSearch.name,
        brand : filSearch.brand,
        sale_price : filSearch.sale_price,
        quantity : 1,
      }

      this.quotationData.detail.push(product)

      this.productSearch = ''

      this.getTotals()
    },
    priceTwo(filSearch){

      const product = {
        discount : 0,
        subtotal: 0,
        total: 0,

        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : filSearch.igv_type_id,
        description : filSearch.name,
        brand : filSearch.brand,
        sale_price : filSearch.referential_sale_price_one,
        quantity : 1,
      }

      this.quotationData.detail.push(product)

      this.productSearch = ''

      this.getTotals()

    },
    priceThree(filSearch){

      const product = {
        discount : 0,
        subtotal: 0,
        total: 0,

        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : filSearch.igv_type_id,
        description : filSearch.name,
        brand : filSearch.brand,
        sale_price : filSearch.referential_sale_price_two,
        quantity : 1,
      }

      this.quotationData.detail.push(product)

      this.productSearch = ''

      this.getTotals()

    },
    deleteItem(index){
      this.quotationData.detail.splice(index, 1);
    },
    activateOrDesactivateGlobalDiscount() {
      // recorrer el array detalle en busca de un descuento
      let discount = 0
      this.quotationData.detail.forEach( e => {
        discount += (e.discount * 1)
      })

      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateGlobalDiscount = discount > 0 ? true : false

    },
    activateOrDesactivateDetailDiscount() {

      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateDetailDiscount = this.quotationData.quotation.discount > 0 ? true : false

    },
    getTotals(){

      this.quotationData.quotation.subtotal = 0
      this.quotationData.quotation.totalIgv = 0
      this.quotationData.quotation.totalExonerated = 0
      this.quotationData.quotation.totalUnaffected = 0
      this.quotationData.quotation.totalFree = 0
      this.quotationData.quotation.totalTaxed = 0
      this.quotationData.quotation.total = 0

      this.quotationData.quotation.discountItems = 0

      // igv constante
      const igv = 0.18

      this.quotationData.detail.forEach( e => {

        this.quotationData.quotation.discountItems += e.discount

        switch (parseInt(e.igv_type_id)) {
          case 10: //Gravado - Operación Onerosa

            // hallar el precio sin igv
            let priceWithoutIgv = e.sale_price / (1 + igv)

            // hallar el subtotal = (precio sin igv * cantidad) - descuento
            e.subtotal = (parseFloat((priceWithoutIgv * e.quantity).toFixed(2)) - e.discount)

            // hallar el total = (subtotal * 1.18)
            e.total = parseFloat(( e.subtotal * (1 + igv)).toFixed(2))

            // Actualizar totales globales
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalIgv += parseFloat((e.total - e.subtotal).toFixed(2))
            this.quotationData.quotation.totalTaxed += e.subtotal
            this.quotationData.quotation.total += e.total
            break
          case 11: //[Gratuita] Gravado – Retiro por premio
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 12: //[Gratuita] Gravado – Retiro por donación
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 13: //[Gratuita] Gravado – Retiro
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 14: //[Gratuita] Gravado – Retiro por publicidad
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 15: //[Gratuita] Gravado – Bonificaciones
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 16: //[Gratuita] Gravado – Retiro por entrega a trabajadores
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 20: //Exonerado - Operación Onerosa
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalExonerated += e.subtotal
            this.quotationData.quotation.total += e.total
            break
          case 30: //Inafecto - Operación Onerosa
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalUnaffected += e.subtotal
            this.quotationData.quotation.total += e.total
            break
          case 31: //[Gratuita] Inafecto – Retiro por Bonificación
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 32: //[Gratuita] Inafecto – Retiro
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 33: //[Gratuita] Inafecto – Retiro por Muestras Médicas
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 34: //[Gratuita] Inafecto - Retiro por Convenio Colectivo
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 35: //[Gratuita] Inafecto – Retiro por premio
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 36: //[Gratuita] Inafecto - Retiro por publicidad
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalFree += e.total
            break
          case 40: //Exportación
            e.subtotal = (parseFloat((e.sale_price * e.quantity).toFixed(2)) - e.discount)
            e.total = e.subtotal
            this.quotationData.quotation.subtotal += e.subtotal
            this.quotationData.quotation.totalUnaffected += e.subtotal
            this.quotationData.quotation.total += e.total
            break
        }

      })

      this.quotationData.quotation.total = this.quotationData.quotation.total - this.quotationData.quotation.discount

    },
    createQuotation() {

      BaseUrl.post("/api/quotations", this.quotationData).then((response) => {
        console.log(response)

        this.errorsCreate = {
        }

        this.$router.push({ name: "quotation-list" })
        Swal.fire(
          "Cotización Creada",
          "Se ha creado la Cotización " + response.data,
          "success"
        )

      })
      .catch((error) => {
        console.log(error.response)
        this.errorsCreate = error.response.data.errors

        if (this.errorsCreate['detail'] != null) {
          Swal.fire("Algo salio mal", this.errorsCreate['detail'][0], "error")
        }
      })
    },
  }
}
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
.option__relative{
  position: relative;
  z-index: 99;
}
.option__contenedor{
  box-sizing: border-box;
  border-radius: 5px;
  width: 100%;
  max-height: 200px;
  box-shadow: 0 0 2px 0 rgb(128,189,255);
  background-color: #fff;
  box-sizing: border-box;
  cursor: pointer;
  overflow-y: scroll;
  position: absolute;
  z-index: 100;
}
.option__contenedor input,.search input{
  display: block;
  margin-left: auto;
  margin-right: auto;
  /*border-color: #93a8c3;*/
  outline-color: rgb(128,189,255);
  border-style: solid;
  border-width: 1px;
  /*color:rgb(172,173,182)*/
}
.option__contenedor table{
  width: 100%;
  padding:8px 10px ;
  margin: 0;
}
.option__contenedor::-webkit-scrollbar{
  width: 7px;
  background-color: rgb(128,189,255)
}
.option__contenedor::-webkit-scrollbar-thumb{
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  border-right: 1px solid rgb(128,189,255);
  border-left: 1px solid rgb(128,189,255);
}
.search .option__contenedor{
  top: 0;
}
.search input{
  width: 100%;
  height: 40px;
  border-radius: 5px;
}
</style>
