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
              v-for="(product, index) in productsFound"
              :key="product.id"
              @click="setProduct(product)"
              @mousedown.prevent
              :tabindex="index + 1"
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

  <!-- VER PRODUCTOS SELECCIONADOS -->
  <div class="row">
    <div class="col-12 table-responsive mt-4">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center" style="width: 40%">Descripción</th>
            <th class="text-center" style="width: 20%">Tipo IGV</th>
            <th class="text-center" style="width: 3%">Cantidad</th>
            <th class="text-center" style="width: 10%">Precio</th>
            <th class="text-center" style="width: 10%">Sub Total</th>
            <th class="text-center" style="width: 10%">Total</th>
            <th class="text-center" style="width: 5%">Series</th>
            <th class="text-center" style="width: 3%"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, index) in products" :key="product.id" >
            <td class="px-1">
              {{ product.name }}
            </td>

            <td class="px-1">
              <select name="" id="" class="form-control rounded-pill">
                <option value="" default>Gravada</option>
                <option value="">Exonerada</option>
              </select>
            </td>
            <td class="px-1">
              <input
                class="form-control form-control-border p-0 text-center"
                type="text"
                v-model="product.quantity"
              />
            </td>
            <td class="px-1">
              <input
                class="form-control form-control-border p-0 text-center"
                type="text"
                v-model="product.referential_purchase_price"
              />
            </td>
            <td class="px-1">
              <input
                class="form-control form-control-border p-0 text-center"
                type="text"
                :value="
                  parseFloat(
                    (product.referential_purchase_price * product.quantity) /
                      1.18
                  ).toFixed(2)
                "
                disabled
              />
            </td>
            <td class="px-1">
              <input
                class="form-control form-control-border p-0 text-center"
                type="text"
                :value="product.referential_purchase_price * product.quantity"
                disabled
              />
            </td>
            <td class="px-1">
              <button
                @click.prevent="showModalSeries(index)"
                class="btn btn-dark btn-sm"
              >
                Series
              </button>
            </td>
            <td>
              <button
                class="btn btn-flat bg-light"
                @click="removeProduct(index)"
              >
                <i class="text-danger fas fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- MODAL SERIES -->
  <div
    class="modal fade"
    id="modal-series"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Series</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div
            v-for="(serie, serieIndex) in Number(quantity)"
            :key="serie.id"
            class="form-group"
          >
            <input
              class="form-control"
              type="text"
              v-model="products[index].series[serieIndex]"
            />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
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
      index: null,
      quantity: null,
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
    showModalSeries(index) {
      this.index = index;
      $("#modal-series").modal("show");
      this.quantity = this.products[this.index].quantity;
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
      product.referential_purchase_price == null ? product.referential_purchase_price = 0 : false;
      product.series = [];

      this.productsFound = [];
      this.productName = null;

      let index = this.products.findIndex(
        (element) => element.id == product.id
      );

      if (index == -1) {
        this.products.push(product);
      }
    },

    removeProduct(index) {
      this.products.splice(index, 1);
    },
    subtotal() {
      return 2;
    },
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
