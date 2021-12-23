<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Comunicaciones de Baja</h1>
    </div>
  </div>

  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de comunicaciones de bajas</h3>

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
                    <th>Ticket</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th class="text-center">XML</th>
                    <th class="text-center">CDR</th>
                    <th class="text-center">Sunat</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="voided in voideds" :key="voided.id">
                    <td class="align-middle">{{ getTimestamp(voided.created_at) }}</td>
                    <td class="align-middle">
                      <span class="text-muted">BAJA: </span>{{ voided.identifier }}
                      <br>
                      <span class="badge bg-maroon">Afecta:</span> {{ voided.sale.serie.serie }} - {{ voided.sale.document_number }}
                    </td>
                    <td class="align-middle">{{ voided.ticket_number }}</td>
                    <td class="align-middle">
                      <span class="badge bg-maroon">{{ voided.sale.customer.identification_document_id = 6 ? "RUC:" : "DNI:" }}</span> {{ voided.sale.customer.document }}
                      <br>
                      <span class="badge bg-maroon">Nombre:</span> {{ voided.sale.customer.name }}
                    </td>
                    <td class="align-middle">S/. {{ voided.sale.total }}</td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Descargar el XML" target="_blank" href="#"><img src="../../../../../img/xml_cpe.svg" style="width: 30px"></a>
                    </td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Descargar el CDR" target="_blank" href="#"><img src="../../../../../img/xml_cdr.svg" style="width: 30px"></a>
                    </td>
                    <td class="align-middle text-center">
                      <i v-if="voided.state == 'ACEPTADO'" class="text-success fas fa-check"></i>
                      <i v-else-if="voided.state == 'RECHAZADO'" class="text-danger fas fa-ban"></i>
                      <i v-else-if="voided.state == 'PENDIENTE'" class="text-success fas fa-sync-alt"></i>
                      <i v-else-if="voided.state == 'ANULADO'" class="text-danger fas fa-window-close"></i>
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
                            class="dropdown-item"
                            href="#"
                            @click="getTicketStatus(voided)"
                            ><i class="col-1 mr-3 fas fa-eye"></i>Consultar estado de ticket</a
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
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
  components:{BaseUrl},
  async created(){
    this.showVoideds()
  },
  data(){
    return{
      loading: false,

      voideds: [],

    }
  },
  methods:{
    async showVoideds(){
      await BaseUrl.get(`api/voideds`).then( resp=>{
        this.voideds = resp.data.data
      })
    },
    getTimestamp(date){
      let dateString = new Date(Date.parse(date)).toLocaleString('en-US', { timeZone: 'America/Lima' })
      return dateString
    },
    getTicketStatus(voided){

      let dataTicket = {
        voided_id: voided.id
      }
      Swal.fire({
        title: "¿Desea consultar el ticket?",
        html: 
          `Comunicación de baja: <b> ${voided.identifier}</b><br>
          Nro. de ticket: <b>${voided.ticket_number}</b>`,
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, adelante",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async () => {

          try {
            const resp = await BaseUrl.post(`api/voideds/ticket-status`, dataTicket)
            Swal.fire("Correcto", resp.data.message, "success")

          } catch(error) {
            if (error.response.data.have_ticket) {
              Swal.fire(error.response.data.error, error.response.data.message, "warning")
            } else{
              Swal.fire(error.response.data.error, error.response.data.message, "error")
            }
          } finally {
            this.showVoideds()
          }

        },
      })
    }
  }
}
</script>

<style>

</style>