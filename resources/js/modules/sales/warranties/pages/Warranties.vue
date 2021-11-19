<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Garantias</h1>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Garantias</h3>

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
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Comprobante</th>
                  <th>Cliente</th>
                  <th>Tiempo Restante Aprox.</th>
                  <th>PDF</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="warranty in warranties" :key="warranty.id">
                  <td class="align-middle">{{ getTimestamp(warranty.created_at) }}</td>
                  <td class="align-middle">
                    <span class="text-muted">GARANTÍA: </span>{{ warranty.serie.serie }} - {{ warranty.document_number }}
                    <br>
                    <span class="badge bg-maroon">Afecta:</span> {{ warranty.sale.serie.serie }} - {{ warranty.sale.document_number }}
                  </td>
                  <td class="align-middle">
                    <span class="badge bg-maroon">{{ warranty.customer.identification_document_id = 6 ? "RUC:" : "DNI:" }}</span> {{ warranty.customer.document }}
                    <br>
                    <span class="badge bg-maroon">Nombre:</span> {{ warranty.customer.name }}
                  </td>
                  <td class="align-middle">
                    {{ warranty.date_due }}
                    <br>
                    <span :class="getElapsedTimeNumber(warranty.date_due) > 0 ? 'text-success' : 'text-danger'" >
                      {{ getElapsedTimeNumber(warranty.date_due) > 0 ? 'Faltan: ' : 'Fuera de tiempo: ' }} {{ getElapsedTime(warranty.date_due) }}
                    </span>
                  </td>
                  <td class="align-middle">
                    <a title="Haz Click para Visualizar la Gatantía" target="_blank" :href="'print/vouchers/WARRANTY/' + warranty.sale.id">
                      <img src="../../../../../../public/img/svg/warranty_cpe.svg" style="width: 30px">
                    </a>
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
                        <a class="dropdown-item" href="#">
                          <i class="col-1 mr-3 fas fa-eye"></i>Mostrar
                        </a>
                        <a class="dropdown-item" href="#">
                          <i class="col-1 mr-3 fas fa-edit"></i>Editar
                        </a>
                        <a class="dropdown-item" :href="'print/vouchers/A4/' + warranty.id" target="_blank">
                          <i class="col-1 mr-3 far fa-file-pdf"></i>PDF
                        </a>
                        <a class="dropdown-item" :href="'print/vouchers/WARRANTY/' + warranty.id" target="_blank">
                          <i class="col-1 mr-3 fas fa-receipt"></i>Garantia
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
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
    await BaseUrl.get(`api/warranties`).then( resp=>{
      console.log(resp.data)
      this.warranties=resp.data.data
    })
  },
  data(){
    return{
      warranties:{}
    }
  },
  methods:{
    getTimestamp(date){
      let dateString = new Date(Date.parse(date)).toLocaleString('en-US', { timeZone: 'America/Lima' })
      return dateString
    },
    getElapsedTime(endDate){

      let elapsedTime = this.getElapsedTimeNumber(endDate)

      let seconds = elapsedTime/1000
      let minutes = seconds/60
      let hours = minutes/60
      let days = hours/24
      let months = days/30
      let years = months/12

      // Si el numero es positivo esta a tiempo y si es negativo se paso de la fecha
      if (Math.abs(years) >= 1) {
        if (Math.abs(years).toFixed(0) == 1) {
          return Math.abs(years).toFixed(0)+" año"
        }
        return Math.abs(months).toFixed(0)+" años"
      }
      else if (Math.abs(months) >= 1) {
        if (Math.abs(months).toFixed(0) == 1) {
          return Math.abs(months).toFixed(0)+" mes"
        }
        return Math.abs(months).toFixed(0)+" meses"
      }
      else if (Math.abs(days) >= 1) {
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
    }
  }
}
</script>

<style>
</style>
