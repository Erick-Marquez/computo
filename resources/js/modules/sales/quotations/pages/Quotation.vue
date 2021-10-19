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
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Usuario</th>
                  <th>Fecha</th>
                  <th>Número de cotización</th>
                  <th>Cliente</th>
                  <th>Total</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="quotation in quotations" :key="quotation.id">
                  <td>{{ quotation.user.name }}</td>
                  <td>{{ quotation.updated_at }}</td>
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
                          :href="'print/vouchers/A4/' + quotation.id"
                          target="_blank"
                          ><i class="col-1 mr-3 far fa-file-pdf"></i>PDF</a
                        >
                        <a
                          class="dropdown-item"
                          :href="'print/vouchers/WARRANTY/' + quotation.id"
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
      console.log(resp.data)
      this.quotations=resp.data.data
    })
  },
  data(){
    return{
      quotations:{}
    }
  },
  methods:{
    
  }
}
</script>

<style>
</style>
