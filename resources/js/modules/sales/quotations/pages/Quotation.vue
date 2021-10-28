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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Cotizaciones</h3>

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
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Valido Hasta</th>
                    <th>Número</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="quotation in quotations" :key="quotation.id">
                    <td>{{ quotation.user.name }}</td>
                    <td>{{ getTimestamp(quotation.created_at) }}</td>
                    <!-- <td v-show="false">{{ q = new Date(Date.parse(quotation.updated_at)) }}</td>
                    <td>{{ q.getFullYear() }}-{{ q.getMonth() }}-{{ q.getDate() }}</td> -->
                    <td>
                      {{ quotation.date_due }}
                      <br>
                      <span :class="getElapsedTimeNumber(quotation.date_due) > 0 ? 'text-success' : 'text-danger'" >
                        {{ getElapsedTimeNumber(quotation.date_due) > 0 ? 'Faltan: ' : 'Días Vencidos: ' }} {{ getElapsedTime(quotation.date_due) }}
                      </span>
                    </td>
                    <td>{{ quotation.document_number }}</td>
                    <td>{{ quotation.customer.name }}</td>
                    <td>{{ quotation.total }}</td>
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
                            :href="'print/quotations/' + quotation.id"
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
    await BaseUrl.get(`api/quotations`).then( resp=>{
      this.quotations=resp.data.data
    })
  },
  data(){
    return{
      quotations:{}
    }
  },
  methods:{
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
    }
  }
}
</script>

<style>
</style>
