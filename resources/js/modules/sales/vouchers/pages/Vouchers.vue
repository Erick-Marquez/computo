<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Comprobantes</h1>
    </div>
  </div>

  <div class="container-fluid">
    <a v-if="$can('vouchers.create')" href="nueva-venta" class="btn btn-lg btn-block btn-dark mb-4">
      <i class="fas fa-plus"></i>
      Nueva venta
    </a>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de comprobantes</h3>

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
                    <th>Total</th>
                    <th class="text-center">PDF/Ticket</th>
                    <th class="text-center">XML</th>
                    <th class="text-center">CDR</th>
                    <th class="text-center">Sunat</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="sale in sales" :key="sale.id">
                    <td class="align-middle">{{ getTimestamp(sale.created_at) }}</td>
                    <td :class="['align-middle', sale.state == 'ANULADO' ? 'voided' : null]">
                      <span class="text-muted">{{ sale.voucher_type }}: </span>{{ sale.serie }}-{{ sale.document_number }}
                    </td>
                    <td class="align-middle">
                      <span class="badge bg-maroon">{{ sale.customer_identification_document }}</span> {{ sale.customer_document }}
                      <br>
                      <span class="badge bg-maroon">Nombre:</span> {{ sale.customer_name }}
                    </td>
                    <td class="align-middle">S/. {{ sale.total }}</td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Visualizar el PDF" target="_blank" :href="'print/vouchers/A4/' + sale.id">
                        <img src="../../../../../img/pdf_cpe.svg" style="width: 30px">
                      </a>
                      <a title="Haz Click para Visualizar el Ticket" target="_blank" :href="'print/vouchers/TICKET/' + sale.id">
                        <img src="../../../../../img/ticket_cpe.svg" style="width: 30px">
                      </a>
                      <a v-if="sale.have_warranty" title="Haz Click para Visualizar la Gatantía" target="_blank" :href="'print/vouchers/WARRANTY/' + sale.id">
                        <img src="../../../../../img/warranty_cpe.svg" style="width: 30px">
                      </a>
                    </td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Descargar el XML" target="_blank" :href="'download/vouchers/' + sale.voucher_type_cod + '/xml/' + sale.id"><img src="../../../../../img/xml_cpe.svg" style="width: 30px"></a>
                    </td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Descargar el CDR" target="_blank" :href="'download/vouchers/' + sale.voucher_type_cod + '/cdr/' + sale.id"><img src="../../../../../img/xml_cdr.svg" style="width: 30px"></a>
                    </td>
                    <td class="align-middle text-center">
                      <i v-if="sale.state == 'ACEPTADO'" class="text-success fas fa-check"></i>
                      <i v-else-if="sale.state == 'RECHAZADO'" class="text-danger fas fa-ban"></i>
                      <i v-else-if="sale.state == 'PENDIENTE'" class="text-success fas fa-sync-alt"></i>
                      <i v-else-if="sale.state == 'ANULADO'" class="text-danger fas fa-window-close"></i>
                    </td>
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
                            v-if="sale.state == 'ACEPTADO'"
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-eye"></i>Crear Nota de Crédito</a
                          ><a
                            v-if="sale.state == 'ACEPTADO'"
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-edit"></i>Crear Nota de Débito</a
                          >
                          <a
                            v-if="sale.state == 'ACEPTADO'"
                            class="dropdown-item"
                            href="#"
                            @click="prepareVoided(sale)"
                            ><i class="col-1 mr-3 fas fa-window-close"></i>Anular Comprobante</a
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

          <div class="card-footer">
            <ul class="pagination pagination-sm m-0 float-right">
              <li v-for="(link, index) in meta.links" :key="link.index" 
              :class="link.url == null ? 'page-item disabled' : link.active ? 'page-item active' : 'page-item'">
                <button type="button"
                  class="page-link"
                  @click="(link.url == null || link.active) ? null : showPaginateVouchers(link.url)" 
                >
                  {{ index == 0 ? 'Anterior' : index == meta.links.length - 1 ? 'Siguiente' : link.label }}
                </button>
              </li>
            </ul>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>

  <!-- Modal Anulacion -->
  <div class="modal fade" id="modal-voided" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Anular - {{ voided.voucher_type + ': ' + voided.serie + '-' + voided.document_number }} </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="sendVoided()">
          <div class="modal-body">
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="color: #0c5460; background-color: #d1ecf1; border-color: #bee5eb;">
              <strong>Si existen FACTURAS Y BOLETAS DE VENTA ELECTRÓNICAS que no han sido entregadas a sus clientes, pueden ser dadas de baja a través de una comunicación a la SUNAT, siempre que se cumpla lo siguiente:</strong>
              <ul class="mt-2">
                <li>Que previamente hayan sido informadas a SUNAT y cuente con un CDR – ACEPTADO (Constancia de Recepción – Aceptada).</li>
                <li>Plazo para enviar la comunicación de baja: hasta las 7 días, contados desde el día siguiente de la fecha consignada en la Constancia de Recepción.</li>
                <li>Las Boletas, Notas Crédito y Débito relaciona a una Boleta son anuladas con un Resumen Diario a partir de la <a href="" class="alert-link" style="text-decoration: none">R. Superintendencia N° 117-2017.</a></li>
              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form-group">
              <label for="name">Motivo de la Anulación: </label>
              <textarea cols="30" rows="4" class="form-control" v-model="voided.description" required placeholder="Escribe aquí el motivo para anular este documento"></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>
            <button v-if="!loading" type="submit" class="btn btn-primary">Crear Comunicacion de Baja</button>

            <button v-else class="btn btn-primary" :disabled="loading">
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
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
  components:{ BaseUrl },
  async created(){
    this.showVouchers()
  },
  data(){
    return{
      loading: false,

      meta: {},
      perPage: 10,

      sales: [],
      voided: {
        sale_id: null,
        description: null,

        voucher_type: null,
        serie: null,
        document_number: null
      }
    }
  },
  methods:{
    async showVouchers(){
      await BaseUrl.get(`api/sales?page=1&perPage=${this.perPage}`).then( resp=>{
        this.sales = resp.data.data
        this.meta = resp.data.meta
      })
    },
    async showPaginateVouchers(url){
      await axios.get(`${url}&perPage=${this.perPage}`)
      .then( resp => {
        this.sales = resp.data.data
        this.meta = resp.data.meta
      })
    },
    getTimestamp(date){
      let dateString = new Date(Date.parse(date)).toLocaleString('en-US', { timeZone: 'America/Lima' })
      return dateString
    },
    showModal(modal) {
      $(modal).modal("show");
    },
    prepareVoided(sale){

      this.voided.sale_id = sale.id
      this.voided.description = null

      this.voided.voucher_type = sale.voucher_type
      this.voided.serie = sale.serie
      this.voided.document_number = sale.document_number

      if (sale.voucher_type_cod == "01") {
        this.showModal("#modal-voided")
      }
      else if (sale.voucher_type_cod == "03") {
        
      }

    },
    sendVoided(){
      this.loading = true

      BaseUrl.post("/api/voideds", this.voided).then((resp) => {
        Swal.fire(
          "Comprobante Anulado",
          resp.data.message,
          "success"
        );
      })
      .catch((error) => {
        if (!error.response.data.have_ticket) {
          Swal.fire(
            error.response.data.error,
            error.response.data.message,
            "error"
          )
        } else{
          Swal.fire(
            error.response.data.error,
            error.response.data.message,
            "warning"
          )
        }
      })
      .finally(() => {
        this.loading = false;
        this.showVouchers()
        $("#modal-voided").modal("hide");
      });
    }

  }
}
</script>

<style scoped>

.voided{

  text-decoration:line-through;
  text-decoration-color: red;

}
</style>
