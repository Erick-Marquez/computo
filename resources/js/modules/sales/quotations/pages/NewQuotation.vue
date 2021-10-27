<template>
  <div class="content-header">
    <h3>Registrar Nueva Cotizacion</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <!-- TIPO DE COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-calendar-times"></i>
              Valido Hasta
            </label>
            <input type="date" v-model="quotationData.quotation.date_due" required>
          </div>
        </div>
        
      </div>

      <h4>Documento de identidad</h4>
      <div class="row">
        <!-- TIPO DOCUMENTO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fas fa-address-card"></i>
              Tipo documento
            </label>
            <select name="" id="" class="form-control rounded-pill">
              <option v-for="identificationDocument in identificationDocuments" :key="identificationDocument.id" :value="identificationDocuments.id">{{ identificationDocument.description }}</option>
            </select>
          </div>
        </div>

        <!-- N° DOCUMENTO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fas fa-pen"></i>
              N° Documento</label
            >
            <div class="input-group">
              <input type="text" class="form-control rounded-pill" />
              <div class="input-group-append">
                <button class="btn btn-dark">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- NOMBRE/RAZON SOCIAL -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-id-badge"></i>
              Nombre/Razón Social:</label
            >
            <input type="text" class="form-control rounded-pill" />
          </div>
        </div>
      </div>

      <div class="row">
        <!-- DIRECCIÓN -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-map-marker-alt"></i>
              Dirección</label
            >
            <input
              type="text"
              class="form-control rounded-pill"
              name=""
              id=""
            >
          </div>
        </div>

        <!-- UBIGEO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-globe"></i>
              Ubigeo</label
            >
            <select name="" id="" class="form-control rounded-pill">
              <option value="">Opcion1</option>
              <option value="">Opcion2</option>
            </select>
          </div>
        </div>

        <!-- N° CELULAR -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-phone"></i>
              N° Celular</label
            >
            <input
              type="text"
              class="form-control rounded-pill"
              name=""
              id=""
            >
          </div>
        </div>
      </div>

      <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->
      <div class="row">
        <div class="col-md ">
          <h4>
            <i class="text-danger fas fa-box"></i>
            Productos
          </h4>
          <div class="">
            <input type="search"  v-model="productSearch" @keyup="searchProducts" 
                      class="form-control rounded-pill form-control rounded-pill-lg" placeholder="Escribe tu producto o código">
            <div class="option__relative">
              <div class="option__contenedor" >
                <div>
                  <table table class="table table-sm table-bordered table-hover bg-white shadow-lg">
                    <thead v-if="productSearchFilter.length > 0" class="thead-dark text-center">
                      <tr>
                        <td>Nombre</td>
                        <td>Marca</td>
                        <td>Precio 1</td>
                        <td>Precio 2</td>
                        <td>Precio 3</td>
                        <td>Stock</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="filSearch in productSearchFilter" :key="filSearch">
                        <td>{{ filSearch.name }}</td>
                        <td class="col-2 text-center">{{ filSearch.brand }}</td>
                        <td class="col-2 text-center">
                          <input class="btn btn-sm btn-success w-50" type="button" :value="filSearch.sale_price" v-on:click="priceOne(filSearch)">
                        </td> 
                        <td class="col-2 text-center">
                          <input class="btn btn-sm btn-warning w-50" type="button" :value="filSearch.referential_sale_price_one" v-on:click="priceTwo(filSearch)">
                        </td>
                        <td class="col-2 text-center">
                          <input class="btn btn-sm btn-info w-50" type="button" :value="filSearch.referential_sale_price_two" v-on:click="priceThree(filSearch)">
                        </td>
                        <td class="col-1 text-center">{{ filSearch.stock }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- VER PRODUCTOS SELECCIONADOS -->
      <div class="row">

        <!-- PARA EL CALCULO DE TOTALES-->
        <div v-show="false">
          {{ taxed = 0 }}
          {{ exonerated = 0 }}
          {{ subtotal = 0 }}
          {{ total = 0 }}
          {{ discount = 0 }}
        </div>
    
        <div class="col-12 table-responsive mt-4">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 40%">Descripción</th>
                <th style="width: 8%">Cantidad</th>
                <th style="width: 10%">Descuento</th>
                <th style="width: 13%">Precio</th>
                <th style="width: 13%">Sub Total</th>
                <th style="width: 13%">Total</th>
                <th style="width: 3%"></th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(detail, index) in quotationData.detail" :key="detail">
                <td>
                  {{ detail.description }} - {{ detail.brand }} - {{ detail.cod }}
                </td>
                <td>
                  <input class="form-control rounded-pill form-control rounded-pill-border" type="text" v-model="detail.quantity" @keypress="onlyNumber($event)">
                </td>
                <td>
                  <input class="form-control rounded-pill form-control rounded-pill-border" type="text" v-model="detail.discount" v-on:change="activateOrDesactivateGlobalDiscount" :disabled = "activateDetailDiscount">
                </td>
                <td>
                  <input class="form-control rounded-pill form-control rounded-pill-border" type="text" v-model="detail.sale_price" disabled>
                </td>
                <td>
                  <input class="form-control rounded-pill form-control rounded-pill-border" type="text" disabled :value="(detail.quantity * detail.sale_price) - detail.discount">
                </td>
                <td>
                  <input class="form-control rounded-pill form-control rounded-pill-border" type="text" disabled :value="(detail.quantity * detail.sale_price) - detail.discount">
                </td>
                <td>
                  <button class="btn btn-flat bg-light" v-on:click="deleteItem(index)">
                    <i class="text-danger fas fa-trash"></i>
                  </button>
                </td>

                <!-- CALCULANDO TOTALES-->
                <div v-show="false">
                  {{ subtotal += (detail.quantity * detail.sale_price) - detail.discount}}
                  {{ total += (detail.quantity * detail.sale_price) - detail.discount }}
                  {{ exonerated += (detail.quantity * detail.sale_price) - detail.discount }}
                  {{ discount += parseFloat(detail.discount) }}
                </div>

              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Observación -->
      <div class="row">
        <div class="col-md-8">
          <h4>Detalle Documento</h4>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <label for="">Descuento</label>
                <input class="form-control rounded-pill" type="text" v-model="quotationData.quotation.discount" v-on:change="activateOrDesactivateDetailDiscount" :disabled = "activateGlobalDiscount">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">Aplica Garantia</label>
                <input class=" form-control form-check-input bg-danger" type="checkbox" v-model="quotationData.quotation.warranty">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <h4>Observación</h4>
                <textarea cols="30" rows="4" class="form-control rounded-pill px-5" v-model="quotationData.quotation.observation"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="table-responsive">
            <table class="table">
              <tbody>
                <tr v-show="quotationData.quotation.discount > 0">
                  <th>Descuento:</th>
                  <td>S/. {{ quotationData.quotation.discount }}</td>
                </tr>
                <tr v-show="discount > 0">
                  <th>Descuento:</th>
                  <td>S/. {{ discount }}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>S/. {{ total - quotationData.quotation.discount }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Resumen de ventas -->
      <div class="row no-print">
        <div class="col-12">
          <form @submit.prevent="createQuotation()">
            <button type="submit" class="btn btn-dark float-right">
              <i class="far fa-credit-card"></i> Guardar Cotización
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
  components: { BaseUrl },
  async created() {

    await BaseUrl.get(`api/sales/identificationdocuments`).then((resp) => {
      this.identificationDocuments = resp.data.data;
    });

    await BaseUrl.get(`api/sales/products`).then((resp) => {
      this.products = resp.data.data;
    });

  },
  data() {
    return {

      productSearch:'',
      productSearchFilter: [],

      activateGlobalDiscount: false,
      activateDetailDiscount: false,

      identificationDocuments: {},
      products: {},
      quotationData: {
        customer: {
          customer_id: 1,
          identification_document: '6',
          number_document: '20604209987',
          name:'Razón social de tu cliente',
          email:'email_cliente@gmail.com',
          address: '',
          ubigeo: '',
          sexo: '',
          birth_date: '',
          phone: ''
        },
        quotation: {
          discount: 0,
          observation: '',
          warranty: true,
          date_due: null,
        },
        detail: []
      },
    };
  },
  mounted(){
    const contain = document.querySelector('.card')
    contain.addEventListener('click', (e)=> {
      if (e.target.className !='inputContent') {
        this.productSearchFilter=''
      }
    })
  },
  methods:{

    searchProducts(){
        
      let produtsBackup = this.products
      let wordFilter = this.productSearch.toLowerCase();

      if(wordFilter===''){
        this.productSearchFilter=''
      }else{
        this.productSearchFilter = produtsBackup.filter(products =>
          (products.name.toLowerCase().indexOf(wordFilter) !== -1) 
        );
      }

    },
    priceOne(filSearch){

      const product = {
        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : 20,
        discount : 0,
        description : filSearch.name,
        brand : filSearch.brand,
        sale_price : filSearch.sale_price,
        quantity : 1,
      }

      this.quotationData.detail.push(product)

      this.productSearch = ''
    },
    priceTwo(filSearch){

      const product = {
        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : 20,
        discount : 0,
        description : filSearch.name,
        brand : filSearch.brand,
        sale_price : filSearch.referential_sale_price_one,
        quantity : 1,
      }

      this.quotationData.detail.push(product)

      this.productSearch = ''

    },
    priceThree(filSearch){

      const product = {
        product_id : filSearch.id,
        cod : filSearch.cod,
        affect_icbper : false,
        igv_type_id : 20,
        discount : 0,
        description : filSearch.name,
        brand : filSearch.brand,
        sale_price : filSearch.referential_sale_price_two,
        quantity : 1,
      }

      this.quotationData.detail.push(product)

      this.productSearch = ''

    },
    deleteItem(index){
      this.quotationData.detail.splice(index, 1);
    },
    activateOrDesactivateGlobalDiscount() {
      // recorrer el array detalle en busca de un descuento
      let discount = 0
      this.quotationData.detail.forEach( e => {
        discount += (e.discount * 1)
      })

      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateGlobalDiscount = discount > 0 ? true : false

    },
    activateOrDesactivateDetailDiscount() {

      // Si descuento es mayor a cero entonces se desactiva el descuento global
      // de lo contrario se activa el descuento global
      this.activateDetailDiscount = this.quotationData.quotation.discount > 0 ? true : false

    },
    createQuotation() {

      BaseUrl.post("/api/quotations", this.quotationData).then((response) => {
        console.log(response)
        this.$router.push({ name: "quotation-list" });
        Swal.fire(
          "Cotización Creada",
          "Se ha creado la Cotizacion N° " + response.data.document_number,
          "success"
        );
      })
      .catch((error) => {
        console.log(error);
      });
    },

    onlyNumber(evt){ // peace of code from internet xd
      
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      console.log(charCode)
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();
      } else {
        return true;
      }
    }
  }
};
</script>

<style scoped>
.btn.btn-dark {
  border-top-right-radius: 23px;
  border-bottom-right-radius: 23px;
  background: #536976; /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to right,
    #292e49,
    #536976
  ); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to right,
    #292e49,
    #536976
  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

label {
  color: rgba(48, 48, 48, 0.774);
  font-weight: 300;
}
.option__relative{
  position: relative;
  z-index: 99;
}
.option__contenedor{
  box-sizing: border-box;
  border-radius: 5px;
  width: 100%;
  max-height: 200px;
  box-shadow: 0 0 2px 0 rgb(128,189,255);
  background-color: #fff;
  box-sizing: border-box;
  cursor: pointer;
  overflow-y: scroll;
  position: absolute;
  z-index: 100;
}
.option__contenedor input,.search input{
  display: block;
  margin-left: auto;
  margin-right: auto;
  /*border-color: #93a8c3;*/
  outline-color: rgb(128,189,255);
  border-style: solid;
  border-width: 1px;
  /*color:rgb(172,173,182)*/
}
.option__contenedor table{
  width: 100%;
  padding:8px 10px ;
  margin: 0;
}
.option__contenedor::-webkit-scrollbar{
  width: 7px;
  background-color: rgb(128,189,255)
}
.option__contenedor::-webkit-scrollbar-thumb{
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  border-right: 1px solid rgb(128,189,255);
  border-left: 1px solid rgb(128,189,255);
}
.search .option__contenedor{
  top: 0;
}
.search input{
  width: 100%;
  height: 40px;
  border-radius: 5px;
}
</style>
