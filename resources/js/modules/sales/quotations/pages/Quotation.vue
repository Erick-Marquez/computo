<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Cotizaciones</h1>
    </div>
  </div>

  <div class="container-fluid">
    <router-link
      class="btn btn-lg btn-block btn-dark mb-4"
      :to="{ name: 'new-quotation' }"
    >
      <i class="fas fa-plus"></i>
      Nueva Cotización
    </router-link>
    <div class="row mb-3">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de cotizaciones disponibles</h3>

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
          <div class="card-body p-0 table-custom-quotation">
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th style="width: 10%">Fecha</th>
                    <th class="text-center" style="width: 5%">Cotización</th>
                    <th style="width: 15%">Cliente</th>
                    <th class="text-center" style="width: 10%">Total</th>
                    <th class="text-center" style="width: 5%">PDF</th>
                    <th class="text-center" style="width: 10%">Valido Hasta</th>
                    <th class="text-center" style="width: 10%">Vendedor</th>
                    <th class="text-center" style="width: 5%">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="availableQuotation in availableQuotations" :key="availableQuotation.id">
                    <td class="align-middle">{{ getTimestamp(availableQuotation.created_at) }}</td>
                    <td class="align-middle text-center">{{availableQuotation.serie.serie}}-{{ availableQuotation.document_number }}</td>
                    <td class="align-middle">
                      <span class="badge bg-maroon">{{ availableQuotation.customer.identification_document_id = 6 ? "RUC:" : "DNI:" }}</span> {{ availableQuotation.customer.document }}
                      <br>
                      <span class="badge bg-maroon">Nombre:</span> {{ availableQuotation.customer.name }}
                    </td>
                    <td class="align-middle text-center">S/. {{ availableQuotation.total - availableQuotation.discount }}</td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Visualizar el PDF" target="_blank" :href="'print/quotations/' + availableQuotation.id">
                        <img src="../../../../../img/pdf_cpe.svg" style="width: 30px">
                      </a>
                    </td>
                    <td class="align-middle text-center">
                      {{ availableQuotation.date_due }}
                      <br>
                      <span :class="getElapsedTimeNumber(availableQuotation.date_due) > 0 ? 'text-success' : 'text-danger'" >
                        {{ getElapsedTimeNumber(availableQuotation.date_due) > 0 ? 'Faltan: ' : 'Días Vencidos: ' }} {{ getElapsedTime(availableQuotation.date_due) }}
                      </span>
                    </td>
                    <td class="align-middle text-center">{{ availableQuotation.user.name }}</td>
                    <td class="align-middle text-center">
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
                        <div
                          class="dropdown-menu"
                          aria-labelledby="dropdownMenuButton"
                          style=""
                        >
                          <a
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-eye"></i>Mostrar</a
                          ><a
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                          ><a
                            class="dropdown-item"
                            href="#"
                            @click="showModal('#modal-advance', availableQuotation)"
                            ><i class="col-1 mr-3 far fa-money-bill-alt"></i>Anticipo</a
                          ><a
                            class="dropdown-item"
                            :href="'print/quotations/' + availableQuotation.id"
                            target="_blank"
                            ><i class="col-1 mr-3 far fa-file-pdf"></i>PDF</a
                          >
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
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de cotizaciones convertidas o fuera de plazo</h3>

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
          <div class="card-body p-0 table-custom-quotation">
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th class="" style="width: 10%">Fecha</th>
                    <th class="text-center" style="width: 5%">Cotización</th>
                    <th class="" style="width: 15%">Cliente</th>
                    <th class="text-center" style="width: 10%">Total</th>
                    <th class="text-center" style="width: 5%">PDF</th>
                    <th class="text-center" style="width: 10%">Valido Hasta</th>
                    <th class="text-center" style="width: 10%">Vendedor</th>
                    <th class="text-center" style="width: 5%">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="unavailableQuotation in unavailableQuotations" :key="unavailableQuotation.id">
                    <td class="align-middle">{{ getTimestamp(unavailableQuotation.created_at) }}</td>
                    <td class="align-middle text-center">{{unavailableQuotation.serie.serie}}-{{ unavailableQuotation.document_number }}</td>
                    <td class="align-middle">
                      <span class="badge bg-maroon">{{ unavailableQuotation.customer.identification_document_id = 6 ? "RUC:" : "DNI:" }}</span> {{ unavailableQuotation.customer.document }}
                      <br>
                      <span class="badge bg-maroon">Nombre:</span> {{ unavailableQuotation.customer.name }}
                    </td>
                    <td class="align-middle text-center">S/. {{ unavailableQuotation.total }}</td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Visualizar el PDF" target="_blank" :href="'print/quotations/' + unavailableQuotation.id">
                        <img src="../../../../../img/pdf_cpe.svg" style="width: 30px">
                      </a>
                    </td>
                    <td class="align-middle text-center">
                      {{ unavailableQuotation.date_due }}
                      <br>
                      <span :class="getElapsedTimeNumber(unavailableQuotation.date_due) > 0 ? 'text-success' : 'text-danger'" >
                        {{ getElapsedTimeNumber(unavailableQuotation.date_due) > 0 ? 'Faltan: ' : 'Días Vencidos: ' }} {{ getElapsedTime(unavailableQuotation.date_due) }}
                      </span>
                    </td>
                    <td class="align-middle text-center">{{ unavailableQuotation.user.name }}</td>
                    <td class="align-middle text-center">
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
                        <div
                          class="dropdown-menu"
                          aria-labelledby="dropdownMenuButton"
                          style=""
                        >
                          <a
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-eye"></i>Mostrar</a
                          ><a
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                          ><a
                            class="dropdown-item"
                            :href="'print/quotations/' + unavailableQuotation.id"
                            target="_blank"
                            ><i class="col-1 mr-3 far fa-file-pdf"></i>PDF</a
                          >
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
      </div>
    </div>
  </div>

  <!-- Modal Anticipo -->
  <div class="modal fade" id="modal-advance" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Añadir Anticipo para {{ advancePayment.serie }} - {{ advancePayment.document_number }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createAdvancePayment()">
          <div class="modal-body">

            <AdvancePayment
              :paymentTypes="paymentTypes"
              :payments="advancePayment.payments"
              :errors="errorsAdvancePayment"
            ></AdvancePayment>

          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>

            <button v-if="!loadingAdvancePayment" type="submit" class="btn btn-primary">Guardar</button>
            <button v-else class="btn btn-primary" :disabled="loadingAdvancePayment">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js';
import AdvancePayment from "../../components/AdvancePayment.vue";
export default {
  components: { BaseUrl, AdvancePayment },
  async created(){
    this.showQuotations();

    await BaseUrl.get(`api/sales/paymenttypes`).then((resp) => {
      this.paymentTypes = resp.data.data;
    });
  },
  data(){
    return{
      availableQuotations: [],
      unavailableQuotations: [],

      paymentTypes: [],
      advancePayment: {
        id_quotation: null,
        payments: []
      },
      errorsAdvancePayment: {},

      loadingAdvancePayment: false,

    }
  },
  methods:{

    async showQuotations(){
      await BaseUrl.get(`api/quotations`).then( resp=>{
        this.availableQuotations = resp.data.availableQuotations
        this.unavailableQuotations = resp.data.unavailableQuotations
      });
    },

    getElapsedTime(endDate){

      let elapsedTime = this.getElapsedTimeNumber(endDate)

      let seconds = elapsedTime/1000
      let minutes = seconds/60
      let hours = minutes/60
      let days = hours/24

      // Si el numero es positivo esta a tiempo y si es negativo se paso de la fecha

      if (Math.abs(days) >= 1) {
        if (Math.abs(days).toFixed(0) == 1) {
          return Math.abs(days).toFixed(0)+" día"
        }
        return Math.abs(days).toFixed(0)+" días"
      }
      else if (Math.abs(hours) >= 1){
        if (Math.abs(hours).toFixed(0) == 1) {
          return Math.abs(hours).toFixed(0)+" hora"
        }
        return Math.abs(hours).toFixed(0)+" horas"
      }
      else {
        return Math.abs(minutes).toFixed(0)+" minutos"
      }

    },
    getElapsedTimeNumber(date){
      let today = Date.now()
      let tem = new Date(Date.parse(date))
      tem.setDate(tem.getDate()+1)
      tem.setHours(0)
      return tem - today
    },
    getTimestamp(date){
      let prueba = new Date(Date.parse(date)).toLocaleString('en-US', { timeZone: 'America/Lima' })
      return prueba
    },

    showModal(modal, quotation = null) {
      if (quotation !== null) {

        let advancePaymentTemp = {
          id_quotation: quotation.id,
          serie: quotation.serie.serie,
          document_number: quotation.document_number,

          payments: []
        }
        
        quotation.payment_types.forEach(e => {

          let temp = {
            payment_type_id: e.pivot.payment_type_id,
            amount: e.pivot.amount
          }

          advancePaymentTemp.payments.push(temp)

        });

        this.advancePayment = advancePaymentTemp

      }
      $(modal).modal("show")
    },

    createAdvancePayment(){

      this.loadingAdvancePayment = true;

      BaseUrl.post(`api/advance-payments`, this.advancePayment).then( resp => {
        
        $("#modal-advance").modal("hide")

        this.showQuotations()

        Swal.fire("Creado", "El Anticipo ha sido creado", "success");

      })
      .catch((error) => {
        this.errorsAdvancePayment = error.response.data.errors
      })
      .finally(() => {
        this.loadingAdvancePayment = false;
      });

    }
  }
}
</script>

<style scoped>

.table-custom-quotation{
  min-height: 300px;
}

</style>
