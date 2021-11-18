<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Crear una Nueva Configuración</h1>
    </div>
  </div>

  <div class="container-fluid">
    <form @submit.prevent="storeAssembly()">
      <div class="row">
        <div class="col-md-7">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="">Nombre</label>
                <input
                  type="text"
                  name=""
                  id=""
                  :class="$errorsClass(errors[''])"
                  v-model="newAssembly.name"
                />
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Código</label>
                    <input
                      type="text"
                      name=""
                      id=""
                      :class="$errorsClass(errors[''])"
                      v-model="newAssembly.cod"
                    />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Precio</label>
                    <input
                      type="text"
                      name=""
                      id=""
                      :class="$errorsClass(errors[''])"
                      v-model="newAssembly.price"
                      disabled
                    />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="">Descripcion</label>
                <textarea
                  class="form-control rounded-left"
                  name=""
                  id=""
                  rows="5"
                  v-model="newAssembly.description"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md">
                  <img
                    class="img-fluid imagen d-flex justify-content-center"
                    src="https://icons-for-free.com/iconfiles/png/512/cloud+upload+file+storage+upload+icon-1320190558968694328.png"
                    alt="Photo"
                    style="height: 300px"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <!-- <input
                type="search"
                class="form-control rounded-pill form-control rounded-pill-lg"
                placeholder="Escribe tu producto o código"
                v-model="productName"
                @keyup="searchProduct"
                @blur="toggle = false"
                @focus="toggle = true"
              /> -->

              <search-products
                :products="newAssembly.products"
                :errors="errors"
              ></search-products>
            </div>
            <div class="card-body">
              <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th style="width: 65%">Producto</th>
                    <th style="width: 10%">Cantidad</th>
                    <th style="width: 15%">Precio Referencial</th>
                    <th style="width: 15%">Descuento</th>
                    <th style="width: 5%">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(product, index) in newAssembly.products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>
                      <input
                        class="form-control form-control-border p-0 text-center"
                        type="text"
                        v-model="product.quantity"
                      />
                    </td>
                    <td>
                      <input
                        class="form-control form-control-border p-0 text-center"
                        type="text"
                        v-model="product.referential_purchase_price"
                      />
                    </td>
                    <td>
                      <input
                        class="form-control form-control-border p-0 text-center"
                        type="text"
                        v-model="product.discount"
                      />
                    </td>
                    <td>
                      <button
                        class="btn btn-flat bg-light"
                        @click.prevent="removeProduct(index)"
                      >
                        <i class="text-danger fas fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-lg btn-outline-dark btn-block mb-4">
        <i class="fas fa-save"></i>
        Guardar
      </button>
    </form>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import SearchProducts from "../../../purchases/purchases/components/SearchProducts.vue";

export default {
  components: { BaseUrl, SearchProducts },
  data() {
    return {
      newAssembly: {
        name: null,
        cod: null,
        description: null,
        price: 0,
        products: [],
      },
      errors: [],
    };
  },
  created() {},
  methods: {
    async storeAssembly() {
      await BaseUrl.post(`/api/assemblies`, this.newAssembly)
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          this.errors = error.response.data.errors;
          console.log(error.response);
        });
    },
    removeProduct(index) {
      this.products.splice(index, 1);
    },
  },
};
</script>

<style>
</style>
