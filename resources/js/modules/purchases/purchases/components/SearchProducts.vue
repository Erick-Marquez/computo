<template>
  <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->
  <div class="row">
    <div class="col-md">
      <h4>
        <i class="text-danger fas fa-box"></i>
        Productos
        <span class="text-sm text-danger">
          {{ $errorsPrint(errors["products"]) }}
        </span>
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
      <div class="autocomplete mt-0" v-show="toggle">
        <table
          class="table table-hover table-bordered list"
          v-show="productsFound.length"
        >
          <thead class="bg-danger">
            <tr>
              <th class="w-50">Nombre</th>
              <th class="w-25">Marca</th>
              <th class="w-25">Linea</th>
            </tr>
          </thead>
          <tbody>
            <tr
              class="item"
              v-for="product in productsFound"
              :key="product.id"
              @click="setProduct(product)"
              @mousedown.prevent
              tabindex="0"
            >
              <td>{{ product.name }}</td>
              <td>{{ product.brand }}</td>
              <td>{{ product.line }}</td>
            </tr>
          </tbody>
        </table>
      </div>
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
    errors: Object,
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
      if (this.productName !== "") {
        clearTimeout(this.searching);
        this.searching = setTimeout(this.getProducts, 300);
      }
    },

    setProduct(product) {
      product.quantity = 1;

      product.referential_purchase_price == null
        ? (product.referential_purchase_price = 0)
        : false;

      product.manager_series ? (product.series = []) : (product.series = null);
      product.igv = true;

      this.productsFound = [];
      this.productName = null;

      product.sale_price = product.referential_sale_price;
      product.discount = 0;

      let index = this.products.findIndex(
        (element) => element.id == product.id
      );

      if (index == -1) {
        this.products.push(product);
      }
    },
  },
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
