<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Comprobantes</h1>
    </div>
  </div>

  <div class="container-fluid">
    <a href="nueva-venta" class="btn btn-lg btn-block btn-dark mb-4">
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
                    <td class="align-middle">
                      <span class="text-muted">{{ sale.serie.voucher_type.description }}: </span>{{ sale.serie.serie }}-{{ sale.document_number }}
                    </td>
                    <td class="align-middle">
                      <span class="badge bg-maroon">{{ sale.customer.identification_document_id = 6 ? "RUC:" : "DNI:" }}</span> {{ sale.customer.document }}
                      <br>
                      <span class="badge bg-maroon">Nombre:</span> {{ sale.customer.name }}
                    </td>
                    <td class="align-middle">S/. {{ sale.total }}</td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Visualizar el PDF" target="_blank" :href="'print/vouchers/A4/' + sale.id">
                        <img src="../../../../../../public/img/svg/pdf_cpe.svg" style="width: 30px">
                      </a>
                      <a title="Haz Click para Visualizar el Ticket" target="_blank" :href="'print/vouchers/TICKET/' + sale.id">
                        <img src="../../../../../../public/img/svg/ticket_cpe.svg" style="width: 30px">
                      </a>
                      <a title="Haz Click para Visualizar la Gatantía" target="_blank" :href="'print/vouchers/WARRANTY/' + sale.id">
                        <img src="../../../../../../public/img/svg/warranty_cpe.svg" style="width: 30px">
                      </a>
                    </td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Descargar el XML" target="_blank" :href="'download/vouchers/' + sale.serie.voucher_type.id + '/xml/' + sale.id"><img src="../../../../../../public/img/svg/xml_cpe.svg" style="width: 30px"></a>
                    </td>
                    <td class="align-middle text-center">
                      <a title="Haz Click para Descargar el CDR" target="_blank" :href="'download/vouchers/' + sale.serie.voucher_type.id + '/cdr/' + sale.id"><img src="../../../../../../public/img/svg/xml_cdr.svg" style="width: 30px"></a>
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
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-eye"></i>Crear Nota de Crédito</a
                          ><a
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-edit"></i>Crear Nota de Débito</a
                          ><a
                            class="dropdown-item"
                            :href="'print/vouchers/A4/' + sale.id"
                            target="_blank"
                            ><i class="col-1 mr-3 far fa-file-pdf"></i>PDF</a
                          >
                          <a
                            class="dropdown-item"
                            :href="'print/vouchers/WARRANTY/' + sale.id"
                            target="_blank"
                            ><i class="col-1 mr-3 fas fa-receipt"></i>Garantia</a
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
    await BaseUrl.get(`api/sales`).then( resp=>{
      console.log(resp.data)
      this.sales=resp.data.data
    })
  },
  data(){
    return{
      sales:{}
    }
  },
  methods:{
    getTimestamp(date){
      let prueba = new Date(Date.parse(date)).toLocaleString('en-US', { timeZone: 'America/Lima' })
      return prueba
    }
  }
}
</script>

<style>
</style>
