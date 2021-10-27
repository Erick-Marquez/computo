<template>
  <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->
  <div class="row">
    <div class="col-md">
      <h4>
        <i class="text-danger fas fa-box"></i>
        Productos
      </h4>
      <input
        type="search"
        class="form-control rounded-pill form-control rounded-pill-lg"
        placeholder="Escribe tu producto o código"
        v-model="productName"
        @keyup="searchProduct"
        @blur="toggle = false"
        @focus="toggle = true"
      />

      <!-- AUTOCOMPLETE -->
      <div  class="autocomplete mt-0" v-show="toggle">
        <table class="table table-hover list" v-show="productsFound.length">
          <thead class="bg-danger">
            <tr>
              <th class="w-50">Nombre</th>
              <th class="w-25">Marca</th>
              <th class="w-25">Linea</th>
            </tr>
          </thead>
          <tbody >
            <tr
              class="item"
              v-for="product in productsFound"
              :key="product.id"
              @click="setData(product)"
              @mousedown.prevent
            >
              <td>{{product.name}}</td>
              <td>{{product.brand}}</td>
              <td>{{product.line}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- VER PRODUCTOS SELECCIONADOS -->
  <div class="row">
    <div class="col-12 table-responsive mt-4">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 40%">Descripción</th>
            <th style="width: 20%">Tipo IGV</th>
            <th style="width: 3%">Cantidad</th>
            <th style="width: 10%">Precio</th>
            <th style="width: 10%">Sub Total</th>
            <th style="width: 10%">Total</th>
            <th style="width: 5%">Series</th>
            <th style="width: 3%"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>

            <td>
              <select name="" id="" class="form-control rounded-pill">
                <option value="" default>Gravada</option>
                <option value="">Exonerada</option>
              </select>
            </td>
            <td>
              <input
                class="form-control form-control-border p-0"
                type="text"
                name=""
                id=""
              />
            </td>
            <td>
              <input
                class="form-control form-control-border p-0"
                type="text"
                name=""
                id=""
              />
            </td>
            <td>
              <input
                class="form-control form-control-border p-0"
                type="text"
                disabled
              />
            </td>
            <td>
              <input
                class="form-control form-control-border p-0"
                type="text"
                disabled
              />
            </td>
            <td>
              <button class="btn btn-dark btn-sm">Series</button>
            </td>
            <td>
              <button class="btn btn-flat bg-light">
                <i class="text-danger fas fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
  data() {
    return {
      toggle: false,
      loading: false,
      max_length: 8,
      productName: null,
      searching: [],
      productsFound: [],
    };
  },
  props: {
    products: Object,
  },
  methods: {
    async getProducts() {
      await BaseUrl.get(
        `/api/products?filter[name]=${this.productName}&perPage=10`
      )
        .then((response) => {
          this.productsFound = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    // metodo para buscar productos
    searchProduct() {
      clearTimeout(this.searching);
      this.searching = setTimeout(this.getProducts, 200);
    },

    setData(product) {
        this.productsFound = [];
        this.product = null;
    }
  },
  computed: {},
};
</script>

<style scoped>
.autocomplete {
  position: relative;
  cursor: pointer;
}

.list {
  position: absolute;
  background: #fff;
  width: 100%;
  padding: 0;
  z-index: 1000;
}

.rounded-pill-left {
  border-top-left-radius: 50px;
  border-bottom-left-radius: 50px;
}

.rounded-pill-right {
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
}
</style>
