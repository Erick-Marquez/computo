<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Sucursales</h1>
    </div>
  </div>

  <div class="container-fluid">

    <router-link
      class="btn btn-lg btn-block btn-dark mb-4"
      :to="{ name: 'new-voucher' }"
    >
      <i class="fas fa-plus"></i>
      Nueva Sucursal
    </router-link>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Sucursales</h3>

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
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="branch in branches" :key="branch.id">
                    <td>{{ branch.id }}</td>
                    <td>{{ branch.description }}</td>
                    <td>{{ branch.direction }}</td>
                    <td>{{ branch.phone }}</td>
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
                            ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                          >
                          <router-link class="dropdown-item" :to="{ name:'show-product' ,params:{id:branch.id}}">
                            <i class="col-1 mr-3 fas fa-edit fas fa-plus"></i>
                            Productos
                          </router-link>
                          <a
                            class="dropdown-item"
                            :href="'print/vouchers/A4/' + branch.id"
                            target="_blank"
                            ><i class="col-1 mr-3 far fa-file-pdf"></i>PDF</a
                          >
                          <a
                            class="dropdown-item"
                            :href="'print/vouchers/WARRANTY/' + branch.id"
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
    await BaseUrl.get(`api/branches`).then( resp=>{
      console.log(resp.data)
      this.branches=resp.data.data
    })
  },
  data(){
    return{
      branches:{}
    }
  },
  methods:{
    
  }
}
</script>

<style>
</style>