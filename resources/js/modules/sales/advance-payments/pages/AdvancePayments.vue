<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Ancipos de venta</h1>
    </div>
  </div>

  <div class="container-fluid">
    <button
      type="button"
      class="btn btn-lg btn-block btn-dark mb-4"
      @click="showModal('#modal-advance-create')"
    >
      <i class="fas fa-plus"></i>
      Nuevo Anticipo
    </button>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de anticipos de venta</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                >

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Comprobante</th>
                    <th>Cliente</th>
                    <th>Total Cotización</th>
                    <th>Total Anticipo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="advancePayment in advancePayments" :key="advancePayment.id">
                    <td class="align-middle">{{ getTimestamp(advancePayment.last_created_at_advance_payment) }}</td>
                    <td class="align-middle">
                      <span class="text-muted">COTIZACIÓN: </span>{{ advancePayment.serie.serie }} - {{ advancePayment.document_number }}
                      <br>
                      
                    </td>
                    <td class="align-middle">
                      <span class="badge bg-maroon">{{ advancePayment.customer.identification_document_id = 6 ? "RUC:" : "DNI:" }}</span> {{ advancePayment.customer.document }}
                      <br>
                      <span class="badge bg-maroon">Nombre:</span> {{ advancePayment.customer.name }}
                    </td>
                    <td class="align-middle">
                      S/. {{ advancePayment.total - advancePayment.total_discount}}
                    </td>
                    <td class="align-middle">
                      S/. {{ Number(advancePayment.total_advance_payment) }}
                    </td>
                    <td>
                      <div class="dropdown">
                        <button
                          class="btn btn-danger dropdown-toggle"
                          type="button"
                          id="dropdownMenuButton"
                          data-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#" @click="showModal('#modal-advance-print', advancePayment)">
                            <i class="col-1 mr-3 fas fa-print"></i>Imprimir
                          </a>
                          <a class="dropdown-item" href="#" @click="showModal('#modal-advance-update', advancePayment)">
                            <i class="col-1 mr-3 far fa-money-bill-alt"></i>Anticipo
                          </a>
                          <a class="dropdown-item" href="#" @click="showModal('#modal-advance-edit', advancePayment)">
                            <i class="col-1 mr-3 fas fa-edit"></i>Editar
                          </a>
                          <a class="dropdown-item" href="#" @click="showModal('#modal-advance-delete', advancePayment)">
                            <i class="col-1 mr-3 fas fa-trash"></i>Eliminar
                          </a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>

  <!-- Modal Anticipo Update-->
  <div class="modal fade" id="modal-advance-update" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Añadir Anticipo para {{ advancePaymentCreate.serie }} - {{ advancePaymentCreate.document_number }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createAdvancePayment('#modal-advance-update')">
          <div class="modal-body">
            <ShowQuotationInfo
              v-if="advancePaymentCreate.quotation != null"
              :quotation="advancePaymentCreate.quotation"
            ></ShowQuotationInfo>

            <AdvancePayment
              :paymentTypes="paymentTypes"
              :payments="advancePaymentCreate.payments"
              :newPayments="advancePaymentCreate.newPayments"
              :errors="errorsAdvancePaymentCreate"
            ></AdvancePayment>

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>

            <button v-if="!loadingAdvancePaymentCreate" type="submit" class="btn btn-primary">Guardar</button>
            <button v-else class="btn btn-primary" :disabled="loadingAdvancePaymentCreate">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Anticipo Create-->
  <div class="modal fade" id="modal-advance-create" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Añadir Anticipo para {{ advancePaymentCreate.serie }} - {{ advancePaymentCreate.document_number }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createAdvancePayment('#modal-advance-create')">
          <div class="modal-body">
            
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-barcode"></i>
                    Serie
                  </label>
                  <select
                    v-model="serieQuotation"
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
              <div class="col">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-hashtag"></i>
                    N° Cotización
                    <span v-show="responseApi" :class="'text-sm font-weight ' + (responseApi === 'EXISTE' ? 'text-success' : 'text-danger')">
                      | {{ responseApi }}
                    </span>
                  </label>

                  <input
                    v-model="numberQuotation"
                    type="text"
                    class="form-control rounded-pill"
                  />
                </div>
              </div>
              <div class="col d-flex align-items-center justify-content-center">
                <button v-if="!loadingSearchQuotation" type="button" class="btn btn-md btn-block btn-dark" @click="searchQuotation()">Buscar</button>
                
                <button v-else class="btn btn-md btn-block btn-dark" :disabled="loadingSearchQuotation">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </button>
              </div>
            </div>

            <ShowQuotationInfo
              v-if="showAdvancePaymentsTable && advancePaymentCreate.quotation != null"
              :quotation="advancePaymentCreate.quotation"
            ></ShowQuotationInfo>

            <AdvancePayment
              v-if="showAdvancePaymentsTable"
              :paymentTypes="paymentTypes"
              :payments="advancePaymentCreate.payments"
              :newPayments="advancePaymentCreate.newPayments"
              :errors="errorsAdvancePaymentCreate"
            ></AdvancePayment>
            
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>

            <button v-if="!loadingAdvancePaymentCreate" type="submit" class="btn btn-primary">Guardar</button>
            <button v-else class="btn btn-primary" :disabled="loadingAdvancePaymentCreate">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Anticipo Print-->
  <div class="modal fade" id="modal-advance-print" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Anticipos: {{ advancePaymentCreate.serie }} - {{ advancePaymentCreate.document_number }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <ShowQuotationInfo
            v-if="advancePaymentCreate.quotation != null"
            :quotation="advancePaymentCreate.quotation"
          ></ShowQuotationInfo>

          <div class="table-responsive">
            <table class="table table-bordered" style="min-width: 600px;">
              <thead class="thead-dark text-center">
                <tr>
                  <th scope="col" class="col-2">Descripción</th>
                  <th scope="col" class="col-3">Fecha</th>
                  <th scope="col" class="col-4">Tipo de pago</th>
                  <th scope="col" class="col-3">Monto S/.</th>
                  <th scope="col" >Imprimir</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(payment, index) in advancePaymentCreate.payments" :key="index">
                  <td class="text-center align-middle">Anticipo {{ index + 1 }}</td>
                  <td class="align-middle">
                    <span class="badge bg-maroon">Día:</span> {{ payment.date_updated_at }}
                    <br>
                    <span class="badge bg-maroon">Hora:</span> {{ payment.time_updated_at }}
                  </td>
                  <td class="align-middle">
                    <select :value="payment.payment_type_id" class="form-control rounded-pill"  disabled>
                      <option v-for="paymentType in paymentTypes" :key="paymentType.id" :value="paymentType.id">
                        {{ paymentType.description }}
                      </option>
                    </select>
                  </td>
                  <td class="align-middle">
                    <input class="form-control rounded-pill" type="number" min="0" step="0.01" :value="payment.amount" disabled>
                  </td>
                  <td class="text-center align-middle">
                    <a title="Haz Click para Visualizar el Ticket" target="_blank" :href="`print/advance-payments/A4/${payment.id}`">
                      <img src="../../../../../img/ticket_cpe.svg" style="width: 30px">
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Anticipo Edit-->
  <div class="modal fade" id="modal-advance-edit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Anticipos: {{ advancePaymentCreate.serie }} - {{ advancePaymentCreate.document_number }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <ShowQuotationInfo
            v-if="advancePaymentCreate.quotation != null"
            :quotation="advancePaymentCreate.quotation"
          ></ShowQuotationInfo>

          <div class="table-responsive">
            <table class="table table-bordered" style="min-width: 600px;">
              <thead class="thead-dark text-center">
                <tr>
                  <th scope="col" class="col-2">Descripción</th>
                  <th scope="col" class="col-3">Fecha</th>
                  <th scope="col" class="col-4">Tipo de pago</th>
                  <th scope="col" class="col-3">Monto S/.</th>
                  <th scope="col">Guardar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(payment, index) in advancePaymentCreate.payments" :key="index">
                  <td class="text-center align-middle">Anticipo {{ index + 1 }}</td>
                  <td class="align-middle">
                    <span class="badge bg-maroon">Día:</span> {{ payment.date_updated_at }}
                    <br>
                    <span class="badge bg-maroon">Hora:</span> {{ payment.time_updated_at }}
                  </td>
                  <td class="align-middle">
                    <select v-model="payment.payment_type_id" class="form-control rounded-pill">
                      <option v-for="paymentType in paymentTypes" :key="paymentType.id" :value="paymentType.id">
                        {{ paymentType.description }}
                      </option>
                    </select>
                  </td>
                  <td class="align-middle">
                    <input class="form-control rounded-pill" type="number" min="0" step="0.01" v-model="payment.amount">
                  </td>
                  <td class="text-center align-middle">
                    <button
                      type="button"
                      class="btn btn-dark"
                      @click="editPayment(payment)"
                    >
                      Guardar
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Anticipo Delete-->
  <div class="modal fade" id="modal-advance-delete" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Anticipos: {{ advancePaymentCreate.serie }} - {{ advancePaymentCreate.document_number }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

          <ShowQuotationInfo
            v-if="advancePaymentCreate.quotation != null"
            :quotation="advancePaymentCreate.quotation"
          ></ShowQuotationInfo>
          
          <div class="table-responsive">
            <table class="table table-bordered" style="min-width: 600px;">
              <thead class="thead-dark text-center">
                <tr>
                  <th scope="col" class="col-2">Descripción</th>
                  <th scope="col" class="col-3">Fecha</th>
                  <th scope="col" class="col-4">Tipo de pago</th>
                  <th scope="col" class="col-3">Monto S/.</th>
                  <th scope="col" >Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(payment, index) in advancePaymentCreate.payments" :key="index">
                  <td class="text-center align-middle">Anticipo {{ index + 1 }}</td>
                  <td class="align-middle">
                    <span class="badge bg-maroon">Día:</span> {{ payment.date_updated_at }}
                    <br>
                    <span class="badge bg-maroon">Hora:</span> {{ payment.time_updated_at }}
                  </td>
                  <td class="align-middle">
                    <select :value="payment.payment_type_id" class="form-control rounded-pill"  disabled>
                      <option v-for="paymentType in paymentTypes" :key="paymentType.id" :value="paymentType.id">
                        {{ paymentType.description }}
                      </option>
                    </select>
                  </td>
                  <td class="align-middle">
                    <input class="form-control rounded-pill" type="number" min="0" step="0.01" :value="payment.amount" disabled>
                  </td>
                  <td class="text-center align-middle">
                    <button
                      type="button"
                      class="btn btn-flat"
                      @click="deletePayment(payment.id, index)"
                    >
                      <i class="text-danger fas fa-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js';
import AdvancePayment from "../../components/AdvancePayment.vue";
import ShowQuotationInfo from "../components/ShowQuotationInfo.vue";
export default {
  components: { BaseUrl, AdvancePayment, ShowQuotationInfo },
  async created(){

    await BaseUrl.get(`api/sales/paymenttypes`).then((resp) => {
      this.paymentTypes = resp.data.data;
    });

    await BaseUrl.get(`api/sales/series/8`).then((resp) => {
      this.quotationSeries = resp.data.data;
    });

    this.showAdvancePayments();
  },
  data(){
    return{

      serieQuotation: null,
      numberQuotation: null,

      quotationSeries: [],
      paymentTypes: [],
      advancePayments: [],

      advancePaymentCreate: {},
      errorsAdvancePaymentCreate: {},

      loadingAdvancePaymentCreate: false,
      loadingSearchQuotation: false,

      showAdvancePaymentsTable: false,
      responseApi: null
    }
  },
  methods:{
    getTimestamp(date){
      let dateString = new Date(Date.parse(date)).toLocaleString('en-US', { timeZone: 'America/Lima' })
      return dateString
    },

    async showAdvancePayments(){

      await BaseUrl.get(`api/advance-payments`).then( resp=>{
        this.advancePayments = resp.data.data
      })

    },

    searchQuotation(){

      this.loadingSearchQuotation = true;

      BaseUrl.get(`api/advance-payments/quotation/${this.serieQuotation}/${this.numberQuotation}`).then( resp=>{

        this.showAdvancePaymentsTable = true;
        this.advancePaymentCreate = this.getAdvancePaymentFormat(resp.data.data)

        this.responseApi = "EXISTE";

      })
      .catch((error) => {

        this.showAdvancePaymentsTable = false;
        this.advancePaymentCreate = {};

        this.responseApi = "NO EXISTE";
      })
      .finally(() => {
        this.loadingSearchQuotation = false;
      });

    },

    showModal(modal, quotation = null) {

      this.advancePaymentCreate = {}
      this.showAdvancePaymentsTable = false
      this.responseApi = null

      if (quotation !== null) {

        this.advancePaymentCreate = this.getAdvancePaymentFormat(quotation)

      }
      $(modal).modal("show")
    },

    getAdvancePaymentFormat(quotation){
      let advancePaymentTemp = {
        quotation: quotation,
        id_quotation: quotation.id,
        serie: quotation.serie.serie,
        document_number: quotation.document_number,

        payments: [],
        newPayments: []
      }
      
      quotation.payment_type_quotations.forEach(e => {

        let temp = {
          id: e.id,
          payment_type_id: e.payment_type_id,
          amount: e.amount,
          date_updated_at: new Date(Date.parse(e.updated_at)).toLocaleDateString('en-US', { timeZone: 'America/Lima' }),
          time_updated_at: new Date(Date.parse(e.updated_at)).toLocaleTimeString('en-US', { timeZone: 'America/Lima' })
        }

        advancePaymentTemp.payments.push(temp)

      });

      return advancePaymentTemp
    },

    createAdvancePayment(modal){

      this.loadingAdvancePaymentCreate = true;

      BaseUrl.post(`api/advance-payments`, this.advancePaymentCreate).then( resp => {
        
        this.errorsAdvancePaymentCreate = {},
        $(modal).modal("hide")

        this.showAdvancePayments()

        Swal.fire("Creado", "El Anticipo ha sido creado", "success");

      })
      .catch((error) => {
        this.errorsAdvancePaymentCreate = error.response.data.errors
      })
      .finally(() => {
        this.loadingAdvancePaymentCreate = false;
      });

    },

    editPayment(payment){
      Swal.fire({
        title: "¿Estas Seguro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, adelante",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async () => {

          try {
            const resp=await BaseUrl.put(`api/advance-payments/${payment.id}`, payment)
            this.showAdvancePayments()
            Swal.fire("Editado", "El anticipo ha sido editado.", "success")

          } catch(error) {
            console.log(error.response.data.error)
            Swal.fire("Cancelado", "No se puede editar el anticipo.", "error")
          }

        }
      })
    },

    deletePayment(id, index){
      Swal.fire({
        title: "¿Estas Seguro?",
        text: "Esta acción no puede revertirse",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, adelante",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async () => {

          try {
            const resp=await BaseUrl.delete(`api/advance-payments/${id}`)
            this.showAdvancePayments()
            this.advancePaymentCreate.payments.splice(index, 1)
            Swal.fire("Eliminado", "El anticipo ha sido eliminado.", "success")

          } catch(error) {
            console.log(error.response.data.error)
            Swal.fire("Cancelado", "No se puede eliminar el anticipo.", "error")
          }

        }
      })
    }
  }
}
</script>

<style>
</style>
