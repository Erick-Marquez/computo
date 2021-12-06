<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Crear una Nueva Configuración</h1>
    </div>
  </div>

  <div class="container-fluid">
    <form @submit.prevent="storeAssembly()">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <label for="">Nombre</label>
                <input
                  type="text"
                  name=""
                  id=""
                  :class="$errorsClass(errors['name'])"
                  v-model="newAssembly.name"
                />
                <div
                  class="invalid-feedback ml-3"
                  v-if="$errorsExists(errors['name'])"
                >
                  {{ $errorsPrint(errors["name"]) }}
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Código</label>
                    <input
                      type="text"
                      name=""
                      id=""
                      :class="$errorsClass(errors['cod'])"
                      v-model="newAssembly.cod"
                    />
                    <div
                      class="invalid-feedback ml-3"
                      v-if="$errorsExists(errors['cod'])"
                    >
                      {{ $errorsPrint(errors["cod"]) }}
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Precio</label>
                    <input
                      type="text"
                      name=""
                      id=""
                      :class="$errorsClass(errors['price'])"
                      :value="
                        (newAssembly.price = newAssembly.products
                          .reduce((previousValue, currentValue) => {
                            return (
                              parseFloat(previousValue) +
                              parseFloat(currentValue.sale_price) *
                                parseFloat(currentValue.quantity)
                            );
                          }, 0)
                          .toFixed(2))
                      "
                      disabled
                    />
                    <div
                      class="invalid-feedback ml-3"
                      v-if="$errorsExists(errors['price'])"
                    >
                      {{ $errorsPrint(errors["price"]) }}
                    </div>
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
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md">
                  <img
                    v-if="hasImage"
                    class="rounded mx-auto d-block mb-4"
                    :src="imageUpload.imgDataUrl"
                    style="width: 100%"
                  />
                  <img
                    v-else
                    class="img-fluid"
                    src="/images/imageUpload.png"
                    alt=""
                  />

                  <a class="btn btn-block btn-outline-dark" @click="toggleShow">
                    <i class="fas fa-upload"></i>
                    Subir Imagen
                  </a>
                  <my-upload
                    field="img"
                    @crop-success="cropSuccess"
                    @srcFileSet="srcFileSet"
                    v-model="imageUpload.show"
                    :langExt="imageUpload.idioma"
                    :params="imageUpload.params"
                    :width="500"
                    :height="400"
                    :headers="imageUpload.headers"
                    img-format="png"
                  ></my-upload>
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
                    <th class="text-center" style="width: 70%">Producto</th>
                    <th class="text-center" style="width: 10%">Cantidad</th>
                    <th class="text-center" style="width: 10%">
                      Precio Referencial
                    </th>
                    <th class="text-center" style="width: 10%">Del</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="4">
                      <div
                        class="image-without-products"
                        v-if="!newAssembly.products.length"
                      >
                        <img
                          src="/images/add_product.png"
                          alt=""
                          style="max-height: 120px"
                        />
                        <h1 class="display-4">Agregue productos</h1>
                      </div>
                    </td>
                  </tr>
                  <tr
                    v-for="(product, index) in newAssembly.products"
                    :key="product.id"
                  >
                    <td>{{ product.name }} - {{ product.brand }}</td>
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
                        v-model="product.sale_price"
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
      <button
        type="submit"
        class="btn btn-lg btn-outline-dark btn-block mb-4"
        :disabled="disabled"
      >
        <i class="fas fa-save"></i>
        Guardar
      </button>
    </form>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import SearchProducts from "../../../purchases/purchases/components/SearchProducts.vue";
import myUpload from "vue-image-crop-upload";

export default {
  components: { BaseUrl, SearchProducts, myUpload },
  data() {
    return {
      newAssembly: {
        name: null,
        cod: null,
        description: null,
        price: 0,
        image: null,
        products: [],
      },
      imageUpload: {
        idioma: {
          hint: "Selecciona o arrastra una imagen",
          loading: "Subiendo...",
          noSupported:
            "Tu navegador no es soportado, por favor usa IE10+ u otros navegadores más recientes",
          success: "Subido exitosamente",
          fail: "Sucedió un error",
          preview: "Vista previa",
          btn: {
            off: "Cancelar",
            close: "Cerrar",
            back: "Atrás",
            save: "Guardar",
          },
          error: {
            onlyImg: "Únicamente imágenes",
            outOfSize: "La imagen excede el tamaño maximo:",
            lowestPx: "La imagen es demasiado pequeña. Se espera por lo menos:",
          },
        },
        show: false,
        imgDataUrl: "", // the datebase64 url of created image
      },
      errors: [],
      disabled: false,
    };
  },
  created() {},
  methods: {
    async storeAssembly() {
      this.disabled = true;
      await BaseUrl.post(`/api/assemblies`, this.newAssembly)
        .then((response) => {
          this.disabled = false;
          this.$router.push({ name: "assemblies-list" });
          Swal.fire("Ensamblaje Registrado", ":)", "success");
        })
        .catch((error) => {
          this.disabled = false;
          this.errors = error.response.data.errors;
          console.log(error.response);
        });
    },

    //* * METODOS PARA IMAGENES
    toggleShow() {
      this.imageUpload.show = !this.imageUpload.show;
    },
    cropSuccess(imgDataUrl, field) {
      console.log("-------- crop success --------");
      this.imageUpload.imgDataUrl = imgDataUrl;
      this.newAssembly.image = imgDataUrl;
    },
    srcFileSet(fileName, fileType, fileSize) {
      console.log(fileSize);
    },
    removeProduct(index) {
      this.newAssembly.products.splice(index, 1);
    },
  },
  computed: {
    hasImage() {
      return this.imageUpload.imgDataUrl != "" ? true : false;
    },
  },
};
</script>

<style>
.image-without-products {
  display: flex;
  justify-content: center;
  align-items: center;
  align-content: center;
  opacity: 0.7;
  height: 150px;
  width: 100%;
  min-width: 850px;
}
.image-without-products img {
  margin-bottom: 0.5rem;
  margin-right: 0.5rem;
}
</style>
