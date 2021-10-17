<template>
  <loader v-if="loader"></loader>
  <div class="pagina">
    <transition name="fade">
      <div class="modal-overlay" v-if="show"></div>
    </transition>
    <transition name="fade">
      <div class="modal" v-if="show">
        <h2>Agregar Producto</h2>
        <!-- <select v-model="n">
          <option value=""></option>
        </select> -->
        <form>
          <table class="newTable" id="sampleTable">
            <thead>
              <tr>
                <td></td>
                <td>Producto</td>
                <td>Categoria</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td>
                  <input
                    type="text"
                    v-model="textoBusqueda"
                    @keyup.enter="filtrar"
                    class="inputContent"
                  />
                </td>
                <td>
                  <input
                    type="text"
                    v-model="textoBusquedaCategory"
                    @keyup.enter="filtrar"
                    class="inputContent"
                  />
                </td>
              </tr>
              <template
                v-for="(fill, index) in elementoFiltrado"
                :key="index"
                @click="seleccionar(fill)"
              >
                <tr v-if="index < n && index >= m" class="tr">
                  <td>{{ fill.id }}/{{ index + 1 }}</td>
                  <td>{{ fill.name }}</td>
                  <td>{{ fill.category }}</td>
                </tr>
              </template>
            </tbody>
          </table>
          <div class="modal__footer">
            <div>
              <input
                type="submit"
                value="Guardar"
                class="form__guardar"
                @click.prevent="crear"
              />
            </div>
            <div class="buttonsModal" @click.prevent="buttons($event)">
              <button v-for="i in amountButtons" :key="i">{{ i }}</button>
            </div>
          </div>
        </form>
        <button class="modal__cerrar" @click="showModal"></button>
      </div>
    </transition>
    <button class="boton" @click="showModal">
      <p>Nuevo</p>
      <div class="boton__img"></div>
    </button>
    <table id="sampleTable">
      <thead>
        <tr>
          <td>ID</td>
          <td>Código</td>
          <td>Nombre</td>
          <td>Descripción</td>
          <td>Stock</td>
          <td>Precio</td>
          <td>Acciones</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(dato, i) in datos" :key="dato.id">
          <td>{{ dato.id }}/{{ i + 1 }}</td>
          <td>{{ dato.code }}</td>
          <td>{{ dato.name }}</td>
          <td>{{ dato.description }}</td>
          <td>{{ dato.stock }}</td>
          <td>{{ dato.precio }}</td>
          <td>
            <div class="delete" @click.prevent="deleteElement(dato.id)">
              <i class="fas fa-trash-alt"></i>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl.js";
// import datatable from'datatables.net'
// require( 'datatables.net-dt' );
// require( 'datatables.net-buttons-dt' );
// require( 'datatables.net-buttons/js/buttons.html5.js' );
import Loader from "../components/Loader.vue";
export default {
  components: { BaseUrl, Loader },
  async created() {
    const id = this.$route.params.id;
    this.idProduct = this.$route.params.id;
    await BaseUrl.get(`branches/products/${id}`).then((response) => {
      this.datos = response.data.data;
      this.elementoFiltrado = response.data.data;
      //$('#sampleTable').DataTable().destroy()
      this.tabla();
      //cantida de botones
      let residuo = this.elementoFiltrado.length % 7;
      if (residuo == 0) {
        this.amountButtons = this.elementoFiltrado.length / 7;
      } else {
        this.amountButtons = Math.ceil(this.elementoFiltrado.length / 7);
      }
    });
    this.loader = false;
  },
  // beforeMount(){
  //   this.buttons()
  //   console.log('hola')
  // },
  async mounted() {
    await this.tabla();
  },
  data() {
    return {
      m: 0,
      n: 7,
      amountButtons: Number,
      idProduct: Number,
      datos: {},
      show: false,
      textoBusqueda: "",
      textoBusquedaCategory: "",
      elementoFiltrado: {},
      datosGuardados: {
        name: this.textoBusqueda,
        category: this.textoBusquedaCategory,
      },
      loader: true,
    };
  },
  methods: {
    buttons(e) {
      let iter = parseInt(e.target.textContent);
      this.n = 7 * iter;
      this.m = 7 * (iter - 1);
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
      await BaseUrl.get(`branches/products/${this.idProduct}`).then(
        (response) => {
          this.datos = response.data.data;
          $("#sampleTable").DataTable().destroy();
          this.tabla();
        }
      );
    },
    deleteElement(id) {
      Swal.fire({
        title: "¿Estas seguro?",
        text: "No se podrá revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, borralo",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`branches/products/${id}`).then((resp) => {
            console.log(resp);
            this.getUser();
          });
          Swal.fire("¡Borrado!", "El dato fue borrado");
        }
      });
    },
    showModal() {
      this.show = !this.show;
    },
    filtrar() {
      let palabraFiltrar =
        this.textoBusqueda.toLowerCase() ||
        this.textoBusquedaCategory.toLowerCase();
      let clientesRespaldo = this.datos;
      console.log(clientesRespaldo);
      let clientesFiltrados = clientesRespaldo.filter(
        (clientes) =>
          clientes.name.toLowerCase().indexOf(palabraFiltrar) !== -1 ||
          clientes.category.toLowerCase().indexOf(palabraFiltrar) !== -1
        // (clientes.documento.toLowerCase().indexOf(palabraFiltrar) !== -1)
      );
      this.elementoFiltrado = clientesFiltrados;
    },
    // seleccionar(e){
    //     this.textoBusqueda=e.name
    //     this.textoBusquedaCategory=e.category
    //   console.log(e)
    // },
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
h1 {
  font-size: 1.4rem;
  border-bottom: 1px solid rgb(172, 173, 182);
  color: rgb(172, 173, 182);
  font-weight: bold;
  transform: translateY(-10px);
  margin-bottom: 25px;
  width: 95%;
  margin-left: auto;
  margin-right: auto;
}
table {
  width: 93%;
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
  /* box-shadow: rgba(172, 173, 182, 0.4) 0px 7px 15px 0px; */
  transition: all 300ms;
  color: rgb(65, 65, 65);
}
td {
  padding: 10px 0 10px 10px;
}
tbody td:first-of-type {
  color: rgb(222, 34, 69);
  font-weight: bold;
  width: 50px;
}
/* td.colorActive{
        color: rgb(60, 112, 255);
        font-weight: bold;
    } */
td {
  border-bottom: 1px solid rgb(230, 230, 230);
}
thead td {
  border-bottom: 1px solid rgb(151, 149, 149);
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
  /* display: inline-block; */
  /* width: 50px;
      height: 50px; */
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
.boton__img img {
  display: block;
  width: 100%;
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
}
.modal {
  display: block;
  width: 80vw;
  height: 100vh;
  position: fixed;
  top: 0;
  right: 0;
  background-color: #fff;
  padding: 20px;
  border-radius: 2px;
  z-index: 20000;
}
.modal__footer {
  display: flex;
  justify-content: space-between;
}
.modal h1 {
  text-align: center;
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
  background-color: rgb(233, 67, 67);
}
.modal__cerrar img {
  display: block;
  width: 50%;
}
.buttonsModal button {
  padding: 5px 10px;
  border: 1px solid rgb(233, 67, 67);
  margin: 0 5px;
  background-color: transparent;
}
.buttonsModal button:hover {
  background-color: rgb(173, 172, 172);
}
form {
  width: 100%;
  height: 100%;
}
.form__contenedor {
  width: 100%;
  height: 75%;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
}
.form__element {
  width: 100%;
  display: flex;
  flex-direction: column;
}
.form__guardar {
  border: none;
  border-radius: 5px;
  width: 100%;
  padding: 10px 15px;
  background-color: rgb(222, 34, 69);
  color: #fff;
  font-size: bold;
}
.option__contenedor {
  max-height: 150px;
  overflow-y: scroll;
}
.option__contenedor p:hover {
  background-color: rgb(222, 34, 69);
}
.newTable .tr:hover {
  background-color: rgb(222, 34, 69);
  color: #fff;
}
.delete {
  display: inline-block;
  cursor: pointer;
  position: relative;
  width: 40px;
  height: 40px;
  margin-left: 8px;
  margin-right: 8px;
  border-radius: 50%;
  overflow: hidden;
  box-shadow: inset 0 0 0 1px rgb(222, 34, 69);
  background-color: #fff;
}

.delete::after,
.delete::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  transition: all 0.25s ease;
  border-radius: 50%;
  border: 0px solid transparent;
}
.delete::before {
  transition-duration: 0.5s;
  box-shadow: inset 0 0 0 1px rgb(222, 34, 69);
}
.delete:hover::before {
  box-shadow: inset 0 0 0 40px rgb(222, 34, 69);
}
/* .delete:hover::before {
  transition: border-top-width 0.5s ease, border-top-color 0.5s ease;
  border-width: 60px;
  border-top-color: rgb(222, 34, 69);
}
.delete:hover::after {
  transition: border-left-width 0.5s ease, border-left-color 0.5s ease;
  border-width: 60px;
  border-left-color: rgb(222, 34, 69);
}
.delete:hover {
  transition: background 0.003s ease 0.2s;
  background: rgb(222, 34, 69);
} */
.delete:hover i {
  color: #fff;
}
.delete i {
  position: relative;
  color: rgb(222, 34, 69);
  font-size: 20px;
  margin-top: 10px;
  margin-left: 10px;
  transition: all 0.5s ease;
  z-index: 1;
}
.fade-enter-from {
  opacity: 0;
  transform: translateX(10px);
}
/*se omite x lo mismo 
.fade-enter-to{
  opacity: 1;
} */
.fade-leave-active,
.fade-enter-active {
  transition: all 0.6s ease;
}
/* se omite xq opacity 1 es una propiedad predeterminada asi que en este caso se omite ,pero no pasa con
todas las propiedades 
.fade-leave-from{
  opacity: 0;
} */
.fade-leave-to {
  transform: translateX(10px);
  opacity: 0;
}
</style>