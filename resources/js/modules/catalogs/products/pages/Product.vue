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
                  v-model="search"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                  @keydown.enter.prevent="showSearchProducts()"
                >

                <div class="input-group-append">
                  <button type="button" class="btn btn-default" @click="showSearchProducts()">
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
                    <th>Precio Compra</th>
                    <th>Precio 1</th>
                    <th>Precio 2</th>
                    <th>Precio 3</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in products" :key="product.id">
                    <td>{{ product.cod }}</td>
                    <td>{{ product.slug }}</td>
                    <td>S/. {{ roundToTwo(product.referential_purchase_price * currencyExchange.change) }}</td>
                    <td>S/. {{ product.price_one }}</td>
                    <td>S/. {{ product.price_two }}</td>
                    <td>S/. {{ product.price_three }}</td>
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
    await BaseUrl.get(`api/currencyexchanges/current`).then( resp=>{
      this.currencyExchange = resp.data.data
    })
    this.showProducts()
  },
  data(){
    return{
      meta: {},
      perPage: 10,

      currencyExchange: {},

      search: '',

      products: [],
    }
  },
  methods:{
    async showProducts(){
      await BaseUrl.get(`api/products?page=1&perPage=${this.perPage}`).then( resp=>{
        this.products = resp.data.data
        this.products.forEach(e => {
          e.price_one = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_one/100) * this.currencyExchange.change)
          e.price_two = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_two/100) * this.currencyExchange.change)
          e.price_three = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_three/100) * this.currencyExchange.change)
        })
        this.meta = resp.data.meta
      })
    },
    async showPaginateProducts(url){
      await axios.get(`${url}&perPage=${this.perPage}&search=${this.search}`)
      .then( resp => {
        this.products = resp.data.data
        this.products.forEach(e => {
          e.price_one = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_one/100) * this.currencyExchange.change)
          e.price_two = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_two/100) * this.currencyExchange.change)
          e.price_three = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_three/100) * this.currencyExchange.change)
        })
        this.meta = resp.data.meta
      })
    },

    async showSearchProducts(){
      await BaseUrl.get(`api/products?page=1&perPage=${this.perPage}&search=${this.search}`).then( resp=>{
        this.products = resp.data.data
        this.products.forEach(e => {
          e.price_one = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_one/100) * this.currencyExchange.change)
          e.price_two = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_two/100) * this.currencyExchange.change)
          e.price_three = this.roundToTwo(e.referential_purchase_price * (1 + e.sale_gain_three/100) * this.currencyExchange.change)
        })
        this.meta = resp.data.meta
      })
    },

    roundToTwo(num) {
      return +(Math.round(num + "e+2") + "e-2");
    },
  }
}
</script>

<style>
</style>
