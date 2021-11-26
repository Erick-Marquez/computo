<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Series de los productos</h1>
    </div>
  </div>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de productos que manejan series</h3>

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
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Inventario</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td>{{ product.cod }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.brand_line.brand.description }}</td>
                    <td>
                        Disponible en {{ product.branch_products_count }} sucursales
                        <br>
                        Series Disponibles: {{ product.branchProductSerieAvailables }}
                        <br>
                        Series Vendidas: {{ product.branchProductSerieSolds }}
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
    await BaseUrl.get(`api/productseries`).then( resp=>{
      console.log(resp.data)
      this.products=resp.data.data
    })
  },
  data(){
    return{
      products:{}
    }
  },
  methods:{
    
  }
}
</script>

<style>
</style>
