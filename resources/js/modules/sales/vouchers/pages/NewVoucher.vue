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
              <option v-for="quotationSerie in quotationSeries" :key="quotationSerie.id" :value="quotationSerie.id">
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
          >
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
              v-model="voucherTypeSelect"
              v-on:change="loadSeries"
              class="form-control rounded-pill"
            >
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
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-barcode"></i>
              Serie</label
            >
            <select
              v-model="serieSelect"
              v-on:change="loadCurrentNumber"
              id=""
              class="form-control rounded-pill"
            >
              <option v-for="serie in series" :key="serie.id" :value="serie.id">
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

      <SearchCustomers :voucherType="voucherTypeSelect" :customer="saleData.customer" />

      <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->
      <div class="row">
        <div class="col-md">
          <h4>
            <i class="text-danger fas fa-box"></i>
            Productos
          </h4>
          <div class="">
            <input
              type="search"
              v-model="productSearch"
              @keyup="searchProducts"
              class="form-control rounded-pill form-control rounded-pill-lg"
              placeholder="Escribe tu producto o código"
            />
            <div class="option__relative">
              <div class="option__contenedor">
                <div>
                  <table
                    table
                    class="
                      table table-sm table-bordered table-hover
                      bg-white
                      shadow-lg
                    "
                  >
                    <thead
                      v-if="productSearchFilter.length > 0"
                      class="thead-dark text-center"
                    >
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
                      <tr
                        v-for="filSearch in productSearchFilter"
                        :key="filSearch"
                      >
                        <td>{{ filSearch.name }}</td>
                        <td class="col-2 text-center">{{ filSearch.brand }}</td>
                        <td class="col-2 text-center">
                          <input
                            class="btn btn-sm btn-success w-50"
                            type="button"
                            :value="filSearch.sale_price"
                            v-on:click="priceOne(filSearch)"
                          />
                        </td>
                        <td class="col-2 text-center">
                          <input
                            class="btn btn-sm btn-warning w-50"
                            type="button"
                            :value="filSearch.referential_sale_price_one"
                            v-on:click="priceTwo(filSearch)"
                          />
                        </td>
                        <td class="col-2 text-center">
                          <input
                            class="btn btn-sm btn-info w-50"
                            type="button"
                            :value="filSearch.referential_sale_price_two"
                            v-on:click="priceThree(filSearch)"
                          />
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
        <!-- PARA EL CALCULO DE TOTALES-->
        <div v-show="false">
          {{ (taxed = 0) }}
          {{ (exonerated = 0) }}
          {{ (subtotal = 0) }}
          {{ (total = 0) }}
          {{ (discount = 0) }}
        </div>

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
                <th style="width: 5%">Series</th>
                <th style="width: 3%"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detail, index) in saleData.detail" :key="detail">
                <td>{{ detail.description }} - {{ detail.cod }}</td>

                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    value="Exonerado"
                    disabled
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    v-on:change="addSeries(index)"
                    v-model="detail.quantity"
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    v-model="detail.discount"
                    v-on:change="activateOrDesactivateGlobalDiscount"
                    :disabled="activateDetailDiscount"
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    v-model="detail.sale_price"
                    disabled
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    disabled
                    :value="
                      detail.quantity * detail.sale_price - detail.discount
                    "
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    disabled
                    :value="
                      detail.quantity * detail.sale_price - detail.discount
                    "
                  />
                </td>
                <td>
                  <button
                    class="btn btn-dark btn-sm"
                    data-toggle="modal"
                    :data-target="'#seriesModal' + index"
                  >
                    Series
                  </button>
                </td>
                <td>
                  <button
                    class="btn btn-flat bg-light"
                    v-on:click="deleteItem(index)"
                  >
                    <i class="text-danger fas fa-trash"></i>
                  </button>
                </td>

                <!-- Modal Serie -->
                <div
                  class="modal fade"
                  :id="'seriesModal' + index"
                  tabindex="-1"
                  role="dialog"
                  aria-labelledby="seriesModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="seriesModalLabel">
                          Registrar series para {{ detail.description }} -
                          {{ detail.cod }}
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
                          class="row m-3"
                          v-for="(obj, j) in detail.series"
                          :key="obj"
                        >
                          <input
                            type="text"
                            class="form-control"
                            placeholder="Serie"
                            v-model="obj.serie"
                            @keyup="searchProductSeries(index, j)"
                          >
                          <div class="">
                            <div class="">
                              <div>
                                <p
                                  v-for="filSerieSearch in productSerieSearchFilter[
                                    index
                                  ][j]"
                                  :key="filSerieSearch"
                                  @click="
                                    selectSerieSearch(filSerieSearch, index, j)
                                  "
                                >
                                  {{ filSerieSearch.serie }}
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary"
                          data-dismiss="modal"
                        >
                          Cerrar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- CALCULANDO TOTALES-->
                <div v-show="false">
                  {{
                    (subtotal +=
                      detail.quantity * detail.sale_price - detail.discount)
                  }}
                  {{
                    (total +=
                      detail.quantity * detail.sale_price - detail.discount)
                  }}
                  {{
                    (exonerated +=
                      detail.quantity * detail.sale_price - detail.discount)
                  }}
                  {{ (discount += parseFloat(detail.discount)) }}
                </div>
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="">
                  <i class="text-danger fas fa-money-bill"></i>
                  Tipo de pago
                </label>
                <select v-model="saleData.voucher.warranty_serie_id" class="form-control rounded-pill">
                  <option v-for="warrantySerie in warrantySeries" :key="warrantySerie.id" :value="warrantySerie.id">
                    {{ warrantySerie.serie }}
                  </option>
                </select>
              </div>
            </div>
            <div class="col-md-2 m-auto">
              <div class="custom-control custom-checkbox">
                <input
                  class="custom-control-input custom-control-input-danger"
                  type="checkbox"
                  id="managerSeriesCheckbox"
                  v-model="saleData.voucher.warranty"
                >
                <label for="managerSeriesCheckbox" class="custom-control-label">¿Aplica garantía?</label>
              </div>
            </div>
            <div class="col-md-2" v-if="saleData.voucher.warranty">
              <div class="form-group">
                <label for="">Serie Garantia</label>
                <select v-model="saleData.voucher.warranty_serie_id" class="form-control rounded-pill">
                  <option v-for="warrantySerie in warrantySeries" :key="warrantySerie.id" :value="warrantySerie.id">
                    {{ warrantySerie.serie }}
                  </option>
                </select>
              </div>
            </div>
          </div>
          <!-- Tipo de pago -->
          <h4>Tipo de Pago</h4>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label for="">Descuento</label>
                <input
                  class="form-control rounded-pill"
                  type="text"
                  v-model="saleData.voucher.discount"
                  v-on:change="activateOrDesactivateDetailDiscount"
                  :disabled="activateGlobalDiscount"
                >
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label for="">Total Recibido S/.</label>
                <input
                  class="form-control rounded-pill"
                  type="text"
                  v-model="saleData.voucher.received_money"
                >
              </div>
            </div>
            <div class="col-md">
              <div class="form-group">
                <label for="">Vuelto S/.</label>
                <input
                  class="form-control rounded-pill"
                  type="text"
                  v-model="saleData.voucher.change"
                  disabled
                >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <h4>Observación</h4>
                <textarea
                  cols="30"
                  rows="4"
                  class="form-control rounded-pill px-5"
                  v-model="saleData.voucher.observation"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr v-show="taxed > 0">
                  <th>Gravada (18%)</th>
                  <td>S/. {{ taxed }}</td>
                </tr>
                <tr v-show="exonerated > 0">
                  <th>Exonerado</th>
                  <td>S/. {{ exonerated }}</td>
                </tr>
                <tr>
                  <th>Subtotal:</th>
                  <td>S/. {{ subtotal }}</td>
                </tr>
                <tr v-show="saleData.voucher.discount > 0">
                  <th>Descuento Global:</th>
                  <td>S/. {{ saleData.voucher.discount }}</td>
                </tr>
                <tr v-show="discount > 0">
                  <th>Descuento por Item:</th>
                  <td>S/. {{ discount }}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>S/. {{ total - saleData.voucher.discount }}</td>
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
          <form @submit.prevent="createSale()">
            <button type="submit" class="btn btn-dark float-right">
              <i class="far fa-credit-card"></i> Guarda Documento Electronico
            </button>
          </form>
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
import BaseUrl from "../../../../api/BaseUrl";
import SearchCustomers from "../../components/SearchCustomers.vue";
export default {
  components: { BaseUrl, SearchCustomers },
  async created() {
    await BaseUrl.get(`api/sales/vouchertypes`).then((resp) => {
      this.voucherTypes = resp.data.data;
      this.voucherTypeSelect = this.voucherTypes[0].id
      this.loadSeries()
    });

    await BaseUrl.get(`api/sales/identificationdocuments`).then((resp) => {
      this.identificationDocuments = resp.data.data;
    });

    await BaseUrl.get(`api/sales/products`).then((resp) => {
      this.products = resp.data.data;
    });

    await BaseUrl.get(`api/sales/series/8`).then((resp) => {
      this.quotationSeries = resp.data.data;
      this.quotationSerieSelect = this.quotationSeries[0].id
    });

    await BaseUrl.get(`api/sales/series/9`).then((resp) => {
      this.warrantySeries = resp.data.data;
      this.saleData.voucher.warranty_serie_id = this.warrantySeries[0].id
    });
  },
  data() {
    return {
      warrantySeries: {},

      quotationSerieSelect: null,
      quotationSeries: {},
      numberQuotation: null,
      contador: 0,

      voucherTypeSelect: null,
      serieSelect: null,
      currentNumber: "Selecciona una serie",

      productSearch: "",
      productSearchFilter: [],
      productSerieSearchFilter: [],
      voucherTypes: {},
      series: {},

      activateGlobalDiscount: false,
      activateDetailDiscount: false,

      identificationDocuments: {},
      products: {},
      productSeries: [],
      saleData: {
        customer: {
          id: null,
        },
        voucher: {
          document_type: "01",
          serie_id: "",
          moneda: "PEN",
          date_issue: "2021-10-17", //Año - mes - dia
          date_due: "2021-10-18",
          discount: 0,
          observation: "",
          received_money: 0,
          change: 0,
          warranty_serie_id: null,
          warranty: false,
        },
        detail: [],
      },
    };
  },
  mounted() {
    const contain = document.querySelector(".card");
    contain.addEventListener("click", (e) => {
      if (e.target.className != "inputContent") {
        this.productSearchFilter = "";
      }
    });
  },
  methods: {
    loadSeries() {
      BaseUrl.get(`api/sales/series/${this.voucherTypeSelect}`).then((resp) => {
        this.series = resp.data.data;
        this.serieSelect = this.series[0].id
        this.loadCurrentNumber()
      });
    },
    loadCurrentNumber() {
      let serieBackup = this.series;
      let serieFilter = serieBackup.filter(
        (series) => series.id == this.serieSelect
      );
      this.currentNumber = serieFilter[0].current_number + 1;
    },
    searchProducts() {
      let produtsBackup = this.products;
      let wordFilter = this.productSearch.toLowerCase();

      if (wordFilter === "") {
        this.productSearchFilter = "";
      } else {
        this.productSearchFilter = produtsBackup
          .filter(
            (products) => products.name.toLowerCase().indexOf(wordFilter) !== -1
          )
          .slice(0, 10);
      }
    },
    searchProductSeries(i, j) {
      let produtSeriesBackup = this.productSeries[i];
      let wordFilter = this.saleData.detail[i].series[j].serie.toLowerCase();

      if (wordFilter === "") {
        this.productSerieSearchFilter[i][j] = "";
      } else {
        this.productSerieSearchFilter[i][j] = produtSeriesBackup.filter(
          (productSeries) =>
            productSeries.serie.toLowerCase().indexOf(wordFilter) !== -1
        );
        if (this.productSerieSearchFilter[i][j].length === 0) {
          this.productSerieSearchFilter[i][j] = [
            { serie: "No hay resultados" },
          ];
        }
      }
    },
    priceOne(filSearch) {
      this.productSerieSearchFilter.push([]);

      const product = {
        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : filSearch.igv_type_id,
        discount : 0,
        description : filSearch.name,
        sale_price : filSearch.sale_price,
        quantity : 1,
        series : []
      }

      const series = {
        id: "",
        serie: "",
      };
      product.series.push(series);

      this.saleData.detail.push(product);

      this.productSearch = "";

      this.getSeries(filSearch.id);
    },
    priceTwo(filSearch) {
      this.productSerieSearchFilter.push([]);

      const product = {
        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : filSearch.igv_type_id,
        discount : 0,
        description : filSearch.name,
        sale_price : filSearch.referential_sale_price_one,
        quantity : 1,
        series : []
      }

      const series = {
        id: "",
        serie: "",
      };
      product.series.push(series);

      this.saleData.detail.push(product);

      this.productSearch = "";

      this.getSeries(filSearch.id);
    },
    priceThree(filSearch) {
      this.productSerieSearchFilter.push([]);

      const product = {
        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : filSearch.igv_type_id,
        discount : 0,
        description : filSearch.name,
        sale_price : filSearch.referential_sale_price_two,
        quantity : 1,
        series : []
      }

      const series = {
        id: "",
        serie: "",
      };
      product.series.push(series);

      this.saleData.detail.push(product);

      this.productSearch = "";

      this.getSeries(filSearch.id);
    },
    selectSerieSearch(filSerieSearch, i, j) {
      this.saleData.detail[i].series[j].id = filSerieSearch.id;
      this.saleData.detail[i].series[j].serie = filSerieSearch.serie;
      this.productSerieSearchFilter[i][j] = "";
    },
    deleteItem(index) {
      this.saleData.detail.splice(index, 1);
      this.productSeries.splice(index, 1);
      this.productSerieSearchFilter.splice(index, 1);
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

    addSeries(index) {
      const temp = [];
      for (let i = 0; i < this.saleData.detail[index].quantity; i++) {
        const series = {
          id: "",
          serie: "",
        };
        temp.push(series);
      }
      this.saleData.detail[index].series = temp;
    },
    getSeries(id) {
      BaseUrl.get(`api/sales/products/series/${id}`).then((resp) => {
        this.productSeries.push(resp.data.data);
      });
    },
    createSale() {

      this.saleData.voucher.document_type = this.voucherTypeSelect
      this.saleData.voucher.serie_id = this.serieSelect
      BaseUrl.post("/api/sales", this.saleData).then((response) => {
        console.log(response)
        this.$router.push({ name: "voucher-list" });
        Swal.fire(
          "Comprobante Creado",
          response.data,
          "success"
        );
      })
      .catch((error) => {
        console.log(error.response);
      });
    },
    getQuotation(){

      this.saleData.detail = []

      BaseUrl.get(`api/sales/quotation/${this.quotationSerieSelect}/${this.numberQuotation}`).then( resp=>{
        let quotation = resp.data.data

        this.saleData.voucher.discount = quotation.discount
        this.saleData.voucher.warranty = Boolean(quotation.have_warranty)
        this.saleData.voucher.observation = quotation.observation

        quotation.quotation_details.forEach((e, index) => {

          this.productSerieSearchFilter.push([])

          const product = {
            product_id : e.id,
            cod : e.branch_product.product.cod,
            affect_icbper : false,
            igv_type_id : e.branch_product.product.igv_type_id,
            discount : e.discount,
            description : e.branch_product.product.name,
            sale_price : e.price,
            quantity : e.quantity,
            series : []
          }

          this.saleData.detail.push(product)

          //Obtener y Añadir series
          this.getSeries(e.id)
          this.addSeries(index)

          //Activar descuento
          this.activateOrDesactivateGlobalDiscount()
          this.activateOrDesactivateDetailDiscount()
        });

        this.getQuotationDiscount(0)
        
      })
      .catch((error) => {
        if (error.response.status == 404) {
          Swal.fire({
            title: 'No encontrado', 
            html: 'No existe la cotización', 
            icon: 'warning' 
          });
        }
      })


    },
    getQuotationDiscount(dato){

      if (dato < this.saleData.detail.length) {
        if (this.saleData.detail[dato].discount > 0) {
          Swal.fire({
            title: "¿Aceptar Descuento?",
            html: 'El producto <b>' + this.saleData.detail[dato].description + '</b> ' +
            'tiene un precio <b>S/. ' + this.saleData.detail[dato].sale_price + '</b> ' +
            'y tiene un descuento por un total de <b>S/. ' + this.saleData.detail[dato].discount + '</b> ' +
            'el precio final es de <b>S/. ' + (this.saleData.detail[dato].sale_price - this.saleData.detail[dato].discount) + '</b>',
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, adelante",
            cancelButtonText: "Cancelar",
            allowOutsideClick: false
          })
          .then((result) => {
            if (result.isConfirmed) {
              Swal.fire({
                title: 'Confirmado',
                html: 'El descuento para el producto <b>' + this.saleData.detail[dato].description + '</b> ' + 
                'por un total de <b>S/. ' + this.saleData.detail[dato].discount + '</b> '  +
                'ha sido aceptado el precio final es <b>S/. ' + this.saleData.detail[dato].sale_price + '</b>',
                icon: 'success',
                allowOutsideClick: false
              }).then((result) => {
                if (result.value) {
                  dato++
                  this.getQuotationDiscount(dato)
                }
              })

            } else if (result.dismiss === Swal.DismissReason.cancel || result.dismiss === Swal.DismissReason.backdrop) {
              let discount = this.saleData.detail[dato].discount
              this.saleData.detail[dato].discount = 0
              Swal.fire({
                title: 'Cancelado',
                html: 'El descuento para el producto <b>' + this.saleData.detail[dato].description + '</b> ' + 
                'por un total de <b>S/. ' + discount +  '</b> ' + 
                'ha sido eliminado el precio final es <b>S/. ' + this.saleData.detail[dato].sale_price + '</b>',
                icon: 'error',
                allowOutsideClick: false
              }).then((result) => {
                if (result.value) {
                  dato++
                  this.getQuotationDiscount(dato)
                }
              })
            }
          })
        }
        else {
          dato++
          this.getQuotationDiscount(dato)
        }
      } else {
        //Activar descuento
        this.activateOrDesactivateGlobalDiscount()
        this.activateOrDesactivateDetailDiscount()
        return true
      }

    },

  }
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
</style>
