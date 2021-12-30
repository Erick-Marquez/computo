<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Productos</h1>
    </div>
  </div>

  <div class="container-fluid">
    <router-link
      class="btn btn-lg btn-block btn-dark mb-4"
      :to="{ name: 'new-product' }"
    >
      <i class="fas fa-plus"></i>
      Nuevo Producto
    </router-link>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Productos</h3>

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
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Price</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.cod }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.referential_purchase_price }}</td>
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
                          <router-link
                            class="dropdown-item"
                            :to="{ name: 'edit-product', params: { id: product.id } }"
                          >
                            <i class="col-1 mr-3 fas fa-edit"></i>
                            Editar
                          </router-link>
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
                  @click ="(link.url == null || link.active) ? null : showPaginateProducts(link.url)" 
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
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
  components: { BaseUrl },
  async created(){
    this.showProducts()
  },
  data(){
    return{
      meta: {},
      perPage: 10,

      products: [],
    }
  },
  methods:{
    async showProducts(){
      await BaseUrl.get(`api/products?page=1&perPage=${this.perPage}`).then( resp=>{
        this.products = resp.data.data
        this.meta = resp.data.meta
      })
    },
    async showPaginateProducts(url){
      await axios.get(`${url}&perPage=${this.perPage}`)
      .then( resp => {
        this.products = resp.data.data
        this.meta = resp.data.meta
      })
    },
  }
}
</script>

<style>
</style>
