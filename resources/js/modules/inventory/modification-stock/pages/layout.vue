<template>
  <loader v-if="loader"></loader>
  <div class="pagina">
    <transition name="overlay">
      <div class="modal-overlay" v-if="show"></div>
    </transition>
    <transition name="fade">
      <div class="modal" v-if="show">
        <div class="subtitle">
          <h2>Ajuste de stock</h2>
        </div>
        <form class="form">
          <div class="form__element flex">
            <label>Local</label>
            <select
              @focus="focusSelect($event)"
              @blur="blureSelect($event)"
              v-model="selected"
            >
              <option v-for="ele in locales" :key="ele" :value="ele">
                {{ ele }}
              </option>
            </select>
          </div>
          <div class="form__element flex">
            <label>observaciones</label>
            <textarea
              name=""
              id=""
              cols="2"
              rows="2"
              @focus="focusSelect($event)"
              @blur="blureSelect($event)"
              v-model="textArea"
            ></textarea>
          </div>
          <h3>Agregar Producto</h3>
          <div class="form__element flex">
            <label>Codigo</label>
            <div class="container">
              <input
                type="text"
                v-model="filtrado"
                @keyup="filtrarSearch"
                @click="ocultarSearch"
                class="inputContent"
                @focus="focus2($event)"
                @blur="blur2($event)"
              />
              <div class="option__relative">
                <div class="option__contenedor">
                  <div
                    v-for="filSearch in elementoFiltradoSearch"
                    :key="filSearch"
                    @click="seleccionarSearch(filSearch)"
                  >
                    <p>{{ filSearch.name }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form__element form__product">
            <template v-if="showProduct">
              <div
                class="products"
                v-for="(product, index) in producto"
                :key="product"
              >
                <button class="products__name">{{ product.names }}</button>
                <p class="products__price">{{ product.price }}</p>
                <p class="products__result">{{ product.productResult }}</p>
                <select
                  class="products__sign"
                  v-model="product.signSelect"
                  @change="cambio($event, index)"
                >
                  <option disabled value="">+</option>
                  <option value="sum" selected>+</option>
                  <option value="rest">-</option>
                </select>
                <input
                  type="text"
                  placeholder="cantidad"
                  class="products__quantity"
                  v-model="product.productQuantity"
                  @keyup="cambio($event, index)"
                />
                <div class="product__delete" @click="DeleteProduct(index)">
                  <i class="fas fa-trash-alt"></i>
                </div>
              </div>
            </template>
          </div>
          <div class="form__element dashed" @click.prevent="$emit('selection')">
            <input
              type="submit"
              value="Guardar"
              class="form__guardar"
              @click.prevent="crearFamilia"
            />
          </div>
          <button class="modal__cerrar" @click="showModal"></button>
        </form>
      </div>
    </transition>
    <h1>Lista de stock</h1>
    <button class="boton" @click="showModal">
      <p>Nuevo</p>
      <div class="boton__img">
        <i class="fas fa-plus"></i>
      </div>
    </button>
    <form>
      <table class="newTable">
        <thead>
          <tr>
            <td></td>
            <td>Producto</td>
            <td>Categoria</td>
            <td>Usuario</td>
          </tr>
        </thead>
        <tbody>
          <tr class="firstTr">
            <td></td>
            <td>
              <div class="td__content">
                <input
                  type="text"
                  v-model="textoBusqueda"
                  @keyup.enter="filtrar"
                  class="inputContent"
                  placeholder="Busque por ciudad"
                />
                <div class="i">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </td>
            <td>
              <div class="td__content">
                <input
                  type="text"
                  v-model="textoBusquedaDate"
                  @keyup.enter="filtrar"
                  class="inputContent"
                  placeholder="Busque por fecha"
                />
                <div class="i">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </td>
            <td>
              <div class="td__content">
                <input
                  type="text"
                  v-model="textoBusquedaUser"
                  @keyup.enter="filtrar"
                  class="inputContent"
                  placeholder="Busque por nombre"
                />
                <div class="i">
                  <i class="fas fa-search"></i>
                </div>
              </div>
            </td>
          </tr>
          <tr
            v-for="fill in elementoFiltrado"
            :key="fill"
            class="tr"
            @click="seleccionar(fill)"
          >
            <td></td>
            <td>{{ fill.local }}</td>
            <td>{{ fill.date }}</td>
            <td>{{ fill.user }}</td>
          </tr>
        </tbody>
      </table>
    </form>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl.js";
// import datatable from "datatables.net";
// require("datatables.net-dt");
// require("datatables.net-buttons-dt");
// require("datatables.net-buttons/js/buttons.html5.js");
import Loader from "../components/Loader.vue";
export default {
  components: { BaseUrl, Loader },
  emits: ["selection"],
  async created() {
    await BaseUrl.get(`/stock`).then((response) => {
      this.datos = response.data;
      this.elementoFiltrado = response.data;
      $("#sampleTable").DataTable().destroy();
      this.tabla();
      let ind = [];
      let datosRespaldo = this.datos;
      datosRespaldo.map((element) => {
        if (!ind.includes(element.local)) {
          ind.push(element.local);
        }
      });
      this.locales = ind;
    });
    await BaseUrl.get(`/products`).then((resp) => {
      this.selectSearch = resp.data;
    });
    this.loader = false;
  },
  mounted() {
    this.tabla();
  },
  data() {
    return {
      idProduct: Number,
      datos: {},
      show: false,
      textoBusqueda: "",
      textoBusquedaDate: "",
      textoBusquedaUser: "",
      elementoFiltrado: {},
      locales: {},
      filtrado: "",
      selectSearch: {},
      elementoFiltradoSearch: {},
      producto: [],
      showProduct: false,
      selected: "",
      textArea: "",
      loader: true,
      //   addProduct:{},
      //   signSelect:'',
      //   productQuantity:'',
      //   productResult:Number
    };
  },
  methods: {
    //   changeSign(i){
    //       this.producto
    //   },
    focusSelect(e) {
      let label = e.target.previousElementSibling;
      label.classList.add("label--red");
    },
    blureSelect(e) {
      let label = e.target.previousElementSibling;
      label.classList.remove("label--red");
      console.log(this.selected);
    },
    focus2(e) {
      let label = e.target.parentElement.previousElementSibling;
      label.classList.add("label--red");
    },
    blur2(e) {
      let label = e.target.parentElement.previousElementSibling;
      label.classList.remove("label--red");
    },
    DeleteProduct(i) {
      this.producto.splice(i, 1);
    },
    cambio(e, i) {
      console.log(e.target.value);
      if (this.producto[i].signSelect == "rest") {
        this.producto[i].productResult =
          this.producto[i].price - parseInt(this.producto[i].productQuantity);
      } else {
        this.producto[i].productResult =
          this.producto[i].price + parseInt(this.producto[i].productQuantity);
      }

      console.log(this.producto[i]);
    },
    tabla() {
      this.$nextTick(() => {
        $("#sampleTable").DataTable({
          dom: "lfrtip",
          buttons: ["copy"],
        });
      });
    },
    regresar() {
      this.$router.go(-1);
    },
    async getUser() {
      await BaseUrl.get(`/stock`).then((response) => {
        this.datos = response.data;
        $("#sampleTable").DataTable().destroy();
        this.tabla();
      });
    },
    //  deleteElement(id){
    //          Swal.fire({
    //         title: '¿Estas seguro?',
    //         text: "No se podrá revertir",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Sí, borralo'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             BaseUrl.delete(`/products/${id}`).then(resp=>{
    //                 console.log(resp)
    //                 this.getUser()
    //             })
    //             Swal.fire(
    //             '¡Borrado!',
    //             'El dato fue borrado',
    //             )
    //         }
    //     })
    //   },
    showModal() {
      this.show = !this.show;
    },
    filtrar() {
      let palabraFiltrar =
        this.textoBusqueda.toLowerCase() ||
        this.textoBusquedaDate.toLowerCase() ||
        this.textoBusquedaUser.toLowerCase();
      let clientesRespaldo = this.datos;
      console.log(this.datos);
      console.log(clientesRespaldo);
      let clientesFiltrados = clientesRespaldo.filter(
        (clientes) =>
          clientes.local.toLowerCase().indexOf(palabraFiltrar) !== -1 ||
          clientes.date.toLowerCase().indexOf(palabraFiltrar) !== -1 ||
          clientes.user.toLowerCase().indexOf(palabraFiltrar) !== -1
        // (clientes.documento.toLowerCase().indexOf(palabraFiltrar) !== -1)
      );
      console.log(clientesFiltrados);
      this.elementoFiltrado = clientesFiltrados;
    },
    filtrarSearch() {
      let clientesRespaldo = this.selectSearch;
      let palabraFiltrar = this.filtrado.toLowerCase();
      if (palabraFiltrar === "") {
        this.elementoFiltradoSearch = "";
      } else {
        this.elementoFiltradoSearch = clientesRespaldo.filter(
          (clientes) =>
            clientes.name.toLowerCase().indexOf(palabraFiltrar) !== -1
        );
      }
    },
    seleccionarSearch(e) {
      let products = {
        local: this.selected,
        obs: this.textArea,
        names: e.name,
        price: e.precio,
        signSelect: "",
        productQuantity: "",
        productResult: 0,
      };
      this.producto.push(products);
      console.log(this.producto);
      if (this.producto != 0) {
        this.showProduct = true;
      }
      this.elementoFiltradoSearch = "";
      this.filtrado = "";
    },
    // crear(){
    //     BaseUrl.post(`/products/${id}`).then(resp=>{
    //         console.log(resp)
    //         this.getUser()
    //     })
    // }
    // async cargar(){
    //    console.log(this.datos)
    //     await BaseUrl.get(`/products?idLocal=${this.idProduct}`).then(response => {
    //         this.datos=response.data
    //     });
    // },
  },
};
</script>

<style scoped>
.pagina {
  width: 95%;
  margin-top: 50px;
  margin-left: auto;
  margin-right: auto;
  background-color: rgb(255, 255, 255);
  margin-bottom: 50px;
  padding-top: 15px;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 3px 8px -2px,
    rgba(0, 0, 0, 0.3) 0px 3px 8px -3px;
  border-radius: 5px;
}
.pagina h1 {
  font-size: 1.4rem;
  border-bottom: 1px solid rgb(222, 34, 69);
  color: rgb(172, 173, 182);
  font-weight: bold;
  transform: translateY(-10px);
  margin-bottom: 25px;
  width: 94%;
  margin-left: auto;
  margin-right: auto;
  padding: 10px 0;
}
table {
  width: 94%;
  border-collapse: separate;
  border-spacing: 0px 2px;
  margin-left: auto;
  margin-right: auto;
}
thead tr {
  color: rgb(172, 173, 182);
}
tbody tr {
  background-color: rgb(255, 255, 255);
  transition: all 300ms;
  color: rgb(65, 65, 65);
}
td {
  padding: 10px 0 10px 10px;
  border-bottom: 1px solid rgb(230, 230, 230);
}
.firstTr td {
  padding: 7px 0 7px 10px;
}
thead td {
  border-bottom: 1px solid rgb(173, 173, 173);
}
.newTable .tr:hover {
  background-color: rgb(214, 75, 100) !important;
  color: #fff;
}
form {
  width: 100%;
}
.td__content {
  display: flex;
  width: 100%;
}
.inputContent {
  border: none;
  width: 80%;
  outline: 1px solid rgb(212, 209, 209);
  color: rgb(151, 149, 149);
  font-size: 1.1rem;
  font-weight: lighter;
  padding-left: 5px;
}
.inputContent:focus {
  outline-color: rgb(214, 75, 100);
}
.i {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 15%;
  outline: 1px solid rgb(197, 194, 194);
  background-color: rgb(197, 194, 194);
  cursor: pointer;
  transition: all 300ms;
}
.i i {
  width: 50%;
  margin-left: auto;
  margin-right: auto;
  color: #fff;
}
.inputContent:focus ~ .i {
  outline-color: rgb(214, 75, 100);
  background-color: rgb(214, 75, 100);
}
.form__contenedor {
  width: 100%;
  height: 75%;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
}
.form {
  padding: 20px;
}
.form__element {
  width: 100%;
  display: flex;
  flex-direction: column;
}
.form__element label {
  color: rgb(172, 173, 182);
}
.form__element select,
.form__element textarea {
  border-color: rgb(172, 173, 182);
  outline-color: rgb(172, 173, 182);
  color: rgb(172, 173, 182);
}
.form__element option:hover {
  background-color: rgb(222, 34, 69);
}
.form__element select:focus,
.form__element textarea:focus {
  outline-color: rgb(222, 34, 69);
  border-color: rgb(222, 34, 69);
}
.form__element .label--red {
  color: rgb(222, 34, 69);
}
.dashed {
  width: 100%;
  padding-top: 20px;
  border-top: 1px dashed rgb(222, 34, 69);
}
.form__element .form__guardar {
  border: none;
  border-radius: 5px;
  width: 25%;
  padding: 10px 15px;
  color: #fff;
  font-weight: bold;
  box-shadow: 0 0 40px 40px rgb(222, 34, 69) inset, 0 0 0 0 rgb(222, 34, 69);
  transition: all 350ms ease-in-out;
}
.form__guardar:hover {
  color: rgb(222, 34, 69);
  box-shadow: 0 0 3px 0 rgb(222, 34, 69) inset, 0 0 3px 1px rgb(222, 34, 69);
}
.footer {
  display: flex;
  justify-content: space-between;
}
.buttons {
  display: inline-block;
  text-align: end;
  border: 1px solid black;
}
.button {
  padding: 10px 15px;
  border: 1px solid black;
  cursor: pointer;
}
.button:hover {
  background-color: rgb(222, 34, 69);
}
.boton {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 145px;
  height: 50px;
  border: none;
  background-color: transparent;
  transition: all 600ms;
  margin-left: 27px;
}
.boton:hover p,
.boton:hover .boton__img {
  box-shadow: 0 0 5px 0 rgb(222, 34, 69);
}
.boton p {
  border: 2px solid rgb(222, 34, 69);
  padding: 5px 20px;
  margin: 0;
  border-top-left-radius: 15px;
  font-size: bold;
  background-color: #fff;
  color: rgb(222, 34, 69);
}
.boton__img {
  width: 30%;
  border: 2px solid rgb(222, 34, 69);
  border-top-right-radius: 15px;
  border-bottom-right-radius: 15px;
  padding: 10px;
  background-color: #fff;
}
.boton__img i {
  display: block;
  width: 30%;
  color: rgb(222, 34, 69);
}

.modal-overlay {
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  z-index: 100;
  background-color: rgba(0, 0, 0, 0.6);
  backdrop-filter: blur(3px);
}
.modal {
  display: block;
  overflow-y: scroll;
  width: 40vw;
  height: 80vh;
  position: fixed;
  top: 10%;
  left: 30%;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: rgba(255, 255, 255, 0.5) 0px 30px 50px -20px,
    rgba(255, 255, 255, 0.5) 0px 10px 30px -20px,
    rgba(255, 255, 255, 0.5) 0px -2px 6px 0px inset;
  z-index: 20000;
}
.modal__cerrar {
  width: 40px;
  height: 40px;
  position: absolute;
  top: 0;
  right: 0;
  padding: 5px;
  border-radius: 50%;
  border: none;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgb(222, 34, 69);
}
.modal__cerrar img {
  display: block;
  width: 50%;
}
.subtitle {
  width: 100%;
  border-bottom: 1px solid rgba(222, 34, 68, 0.3);
  padding: 20px;
}
.subtitle h2 {
  font-size: 1.4rem;
  margin: 0;
  color: rgb(222, 34, 69);
}
.form h3 {
  font-size: 1.4rem;
  margin-bottom: 20px;
  color: rgb(222, 34, 69);
  padding-bottom: 10px;
  border-bottom: 1px dashed rgba(222, 34, 68, 0.3);
}
.container input,
.container .option__relative {
  width: 100%;
}
.option__relative {
  position: relative;
  width: 100%;
}
.option__contenedor {
  position: absolute;
  bottom: 0;
  max-height: 250px;
  width: 100%;
  overflow-y: scroll;
  background-color: #fff;
}
.option__contenedor p:hover {
  background-color: rgb(222, 34, 69);
}

.flex {
  width: 100%;
  display: flex;
  flex-direction: row;
  justify-content: center;
  margin-bottom: 15px;
}
.flex select,
.flex textarea,
.flex .container {
  width: 75%;
  margin-left: 30px;
}
.flex label {
  flex: 1;
  text-align: end;
}

.form__product {
  background-color: rgba(44, 187, 63, 0.65);
}
.products {
  display: flex;
  justify-content: space-around;
  align-items: center;
  height: 60px;
}

.products .products__name {
  border: none;
  background-color: rgb(209, 208, 208);
  width: 120px;
  height: 30px;
  margin: 0;
  font-size: 0.8rem;
}
.products .products__price {
  color: rgb(41, 131, 235);
  height: 30px;
  margin: 0;
}
.products .products__result {
  width: 30px;
  height: 30px;
  color: red;
  margin: 0;
  border: 1px solid black;
}
.products .products__sign {
  width: 50px;
  height: 30px;
  margin: 0;
}
.products__quantity {
  width: 100px;
  height: 30px;
  margin: 0;
}
.product__delete {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 30px;
  height: 30px;
  background-color: rgb(230, 89, 89);
  cursor: pointer;
  transition: all 300ms;
}
.product__delete:hover {
  background-color: #fff;
}
.product__delete i {
  color: #fff;
  transition: all 300ms;
}
.product__delete i:hover {
  color: red;
}
.overlay-leave-active {
  transition: all;
  transition-delay: 500ms;
}
.fade-leave-active,
.fade-enter-active {
  transition: all 0.6s ease;
}
.overlay-leave-to {
  opacity: 0;
}
.fade-enter-from,
.fade-leave-to {
  /* transform: scale(0); */
  transform: translateY(-60px);
  opacity: 0;
}
</style>