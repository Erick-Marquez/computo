<template>
<form @submit.prevent="createProduct()" @submit="checkForm">
  <div class="row">
    <div class="col-md-7">
      <div class="row">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <div class="card-title">
                  <h4>Producto</h4>
              </div>
              <div class="card-tools">
                <div class="custom-control custom-checkbox">
                  <input
                    class="custom-control-input custom-control-input-danger"
                    type="checkbox"
                    id="managerSeriesCheckbox"
                    v-model="managerSeries"
                  >
                  <label for="managerSeriesCheckbox" class="custom-control-label"
                    >¿Maneja Series?</label
                  >
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="">Nombre del producto</label>
                    <input type="text" class="form-control" v-model="productName" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Linea</label>
                    <select class="form-control" v-model="line" @change="getBrands()">
                      <option v-for="line in lines" :key="line.id" :value="line.id">{{ line.description }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Marca</label>
                    <select class="form-control" v-model="brand">
                      <option value="" v-if="line == null">Seleccione una linea</option>
                      <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.description }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea
                      name=""
                      id=""
                      cols="30"
                      rows="5"
                      class="form-control"
                      v-model="description"
                    ></textarea>
                  </div>
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
              <h4>
                Precios |
                <small class="text-danger">
                  Solo se guarda el precio en dolares</small
                >
              </h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Tipo de cambio</label>
                    <input type="number" class="form-control" v-model="currencyExchange" @keyup="changePricesSoles()">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">P. Compra Soles</label>
                    <input type="number" class="form-control" v-model="purchasePriceSoles" @keyup="changePurchasePriceDollar()">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">P. Compra Dolares</label>
                    <input type="number" class="form-control" v-model="purchasePriceDollar" @keyup="changePurchasePriceSoles()">
                  </div>
                </div>
              </div>

              <div class="row">
                <p class="lead">Precios de venta</p>
                <div class="table-responsive">
                  <table class="table table-bordered table-prices">
                    <thead class="thead-dark text-center">
                      <tr>
                        <th scope="col">Tipo</th>
                        <th scope="col" class="col-2">Ganancia(%)</th>
                        <th scope="col">Soles</th>
                        <th scope="col">Dolares</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="align-middle">Precio 1</td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="saleGainOne" @keyup="changeSalePriceSolesAndDollarOne()"></td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="salePriceOneSoles" @keyup="changeSalePriceDollarAndGainOne()"></td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="salePriceOneDollar" @keyup="changeSalePriceSolesAndGainOne()"></td>
                      </tr>
                      <tr>
                        <td class="align-middle">Precio 2</td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="saleGainTwo" @keyup="changeSalePriceSolesAndDollarTwo()"></td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="salePriceTwoSoles" @keyup="changeSalePriceDollarAndGainTwo()"></td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="salePriceTwoDollar" @keyup="changeSalePriceSolesAndGainTwo()"></td>
                      </tr>
                      <tr>
                        <td class="align-middle">Precio Tarjeta
                          <br>
                          <small class="text-danger">(Respecto al precio 1)</small>
                        </td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="saleGainThree" @keyup="changeSalePriceSolesAndDollarThree()"></td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="salePriceThreeSoles" @keyup="changeSalePriceDollarAndGainThree()"></td>
                        <td class="align-middle"><input type="number" class="form-control" v-model="salePriceThreeDollar" @keyup="changeSalePriceSolesAndGainThree()"></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5">
      <div class="row">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h4>Agregar Foto</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md">
                  <img
                    class="img-fluid imagen d-flex justify-content-center"
                    src="https://icons-for-free.com/iconfiles/png/512/cloud+upload+file+storage+upload+icon-1320190558968694328.png"
                    alt="Photo"
                  >
                </div>
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="">Código</label>
                    <input type="text" class="form-control" v-model="cod">
                  </div>
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
              <h4>Disponibilidad en Sucursales</h4>
            </div>
            <div class="card-body">
              <template v-for="(branch, index) in branches" :key="branch.id">
                <div class="custom-control custom-checkbox">
                  <input
                    class="custom-control-input custom-control-input-danger"
                    type="checkbox"
                    :id="'branchCheckbox'+branch.id"
                    v-model="selectedBranches[index].isAvailable"
                    @change="activeOrDesactiveInventory()"
                  >
                  <label :for="'branchCheckbox'+branch.id" class="custom-control-label">{{ branch.description }}</label>
                </div>
              </template>
            </div>
          </div>
        </div>
      </div>
      <div class="row" v-if="showInventory">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h4>Inventario Inicial</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <table class="table table-bordered">
                  <thead class="thead-dark text-center">
                    <tr>
                      <th scope="col">Sucursal</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col" v-if="managerSeries">Series</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                    <template v-for="selectedBranch in selectedBranches" :key="selectedBranch.id">
                      <tr v-if="selectedBranch.isAvailable">
                        <td class="align-middle">{{ selectedBranch.description }}</td>
                        <td class="align-middle">
                          <input type="number" class="form-control" v-model="selectedBranch.quantity" @change="addSeries(selectedBranch)">
                        </td>
                        <td v-if="managerSeries" class="align-middle">
                          <input type="button" class="btn btn-dark btn-sm btn-series" data-toggle="modal" :data-target="'#seriesModal'+selectedBranch.id" value="Series">
                        </td>

                        <!-- Modal Serie -->
                        <div class="modal fade" :id="'seriesModal'+selectedBranch.id" tabindex="-1" role="dialog" aria-labelledby="seriesModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="seriesModalLabel">Registrar series para {{ productName }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row m-3" v-for="obj in selectedBranch.series" :key="obj">
                                  <input type="text" class="form-control" placeholder="Serie" v-model="obj.serie">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </tr>
                    </template>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <input type="submit" class="btn btn-dark btn-block btn-lg mb-4" value="Guardar Producto">
</form>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
  components: { BaseUrl },
  async created() {
    await BaseUrl.get(`api/products/branches`).then((resp) => {
      this.branches = resp.data.data;
      resp.data.data.forEach(e => {
        let tem = {
          id: e.id,
          description: e.description,
          quantity: 0,
          series : [],
          isAvailable: false
        }
        this.selectedBranches.push(tem)
      });
    });
    await BaseUrl.get(`api/products/lines`).then((resp) => {
      this.lines = resp.data.data;
    });
    await BaseUrl.get(`api/products/currencyexchange`).then((resp) => {
      this.currencyExchange = resp.data.change;
    });
  },
  data() {
    return {
      cod: '',
      productName: '',
      description: '',
      branches : {},
      lines : {},
      brands : {},

      line : null,
      brand : '',

      /* Precios */
      currencyExchange : '',
      purchasePriceSoles: '',
      purchasePriceDollar: '',

      saleGainOne: '',
      salePriceOneSoles: '',
      salePriceOneDollar: '',

      saleGainTwo: '',
      salePriceTwoSoles: '',
      salePriceTwoDollar: '',

      saleGainThree: '',
      salePriceThreeSoles: '',
      salePriceThreeDollar: '',

      managerSeries: false,

      selectedBranches: [],
      showInventory: false,

    };
  },
  methods:{
    getBrands(){
      BaseUrl.get(`api/products/brands/${this.line}`).then( resp=>{
        this.brands = resp.data.data;
      })
    },
    //Precio compra
    changePricesSoles(){
      this.purchasePriceSoles = this.changePriceSoles(this.purchasePriceDollar)
      this.salePriceOneSoles = this.changePriceSoles(this.salePriceOneDollar)
      this.salePriceTwoSoles = this.changePriceSoles(this.salePriceTwoDollar)
      this.salePriceThreeSoles = this.changePriceSoles(this.salePriceThreeDollar)
    },
    changePurchasePriceSoles(){
      this.purchasePriceSoles = this.changePriceSoles(this.purchasePriceDollar)
      this.changeSalePriceSolesAndDollarOne()
      this.changeSalePriceSolesAndDollarTwo()
      this.changeSalePriceSolesAndDollarThree()
    },
    changePurchasePriceDollar(){
      this.purchasePriceDollar = this.changePriceDollar(this.purchasePriceSoles)
      this.changeSalePriceSolesAndDollarOne()
      this.changeSalePriceSolesAndDollarTwo()
      this.changeSalePriceSolesAndDollarThree()
    },
    //Precio 1
    changeSalePriceSolesAndGainOne(){
      this.salePriceOneSoles = this.changePriceSoles(this.salePriceOneDollar)
      this.saleGainOne = this.getGain(this.purchasePriceDollar, this.salePriceOneDollar)
    },
    changeSalePriceDollarAndGainOne(){
      this.salePriceOneDollar = this.changePriceDollar(this.salePriceOneSoles)
      this.saleGainOne = this.getGain(this.purchasePriceDollar, this.salePriceOneDollar)
    },
    changeSalePriceSolesAndDollarOne(){
      this.salePriceOneDollar = this.getPrice(this.purchasePriceDollar, this.saleGainOne)
      this.salePriceOneSoles = this.changePriceSoles(this.salePriceOneDollar)
    },
    // Precio 2
    changeSalePriceSolesAndGainTwo(){
      this.salePriceTwoSoles = this.changePriceSoles(this.salePriceTwoDollar)
      this.saleGainTwo = this.getGain(this.purchasePriceDollar, this.salePriceTwoDollar)
    },
    changeSalePriceDollarAndGainTwo(){
      this.salePriceTwoDollar = this.changePriceDollar(this.salePriceTwoSoles)
      this.saleGainTwo = this.getGain(this.purchasePriceDollar, this.salePriceTwoDollar)
    },
    changeSalePriceSolesAndDollarTwo(){
      this.salePriceTwoDollar = this.getPrice(this.purchasePriceDollar, this.saleGainTwo)
      this.salePriceTwoSoles = this.changePriceSoles(this.salePriceTwoDollar)
    },
    //Precio 3
    changeSalePriceSolesAndGainThree(){
      this.salePriceThreeSoles = this.changePriceSoles(this.salePriceThreeDollar)
      this.saleGainThree = this.getGain(this.salePriceOneDollar, this.salePriceThreeDollar)
    },
    changeSalePriceDollarAndGainThree(){
      this.salePriceThreeDollar = this.changePriceDollar(this.salePriceThreeSoles)
      this.saleGainThree = this.getGain(this.salePriceOneDollar, this.salePriceThreeDollar)
    },
    changeSalePriceSolesAndDollarThree(){
      this.salePriceThreeDollar = this.getPrice(this.salePriceOneDollar, this.saleGainThree)
      this.salePriceThreeSoles = this.changePriceSoles(this.salePriceThreeDollar)
    },
    //Funciones generales para precios
    changePriceSoles(valueDollar){
      let tem = valueDollar * this.currencyExchange
      return tem.toFixed(3)
    },
    changePriceDollar(valueSoles){
      let tem = valueSoles / this.currencyExchange
      return tem.toFixed(3)
    },
    getGain(valuePurchasePrice, valueDollar){
      let tem = ((valueDollar / valuePurchasePrice) * 100) - 100
      return tem.toFixed(3)
    },
    getPrice(valuePurchasePrice, valueGain){
      let dollar = parseFloat(valuePurchasePrice)
      let tem = dollar + ((valueGain * dollar)/100)
      return tem.toFixed(3)
    },
    // Inventory
    activeOrDesactiveInventory(){
      let numberOfSelectedBranches = 0
      this.selectedBranches.forEach(e => {
        if (e.isAvailable) {
          numberOfSelectedBranches++
        }
      });

      this.showInventory = numberOfSelectedBranches > 0 ? true : false
    },
    addSeries(item){
      const temp = []
      for (let i = 0; i < item.quantity; i++) {
        const series = {
          serie: ''
        }
        temp.push(series) 
      }
      item.series = temp
    },
    createProduct(){

      const product = {
        cod : this.cod,
        name : this.productName,
        description : this.description,
        referential_purchase_price : this.purchasePriceDollar,
        referential_sale_price : this.salePriceOneDollar,
        referential_sale_price_one : this.salePriceTwoDollar,
        referential_sale_price_two : this.salePriceThreeDollar,
        manager_series : this.managerSeries,
        line_id : this.line,
        brand_id : this.brand,

        branches : []
      }
      
      const temp = []

      this.selectedBranches.forEach(e => {
        if (e.isAvailable) {
          const series = {
            id : e.id,
            quantity : e.quantity,
            series : e.series
          }
          temp.push(series) 
          
          //Validar si maneja serie debe ingresar las series para continuar
          if (this.managerSeries) {

            e.series.forEach( elem => {
              //Verificar si el campo esta vacio
              if (elem.serie === '') {
                
              }
              
            })

          }
        }
      });

      product.branches = temp

      BaseUrl.post(`api/products`, product)
      .then( resp => {
        
        console.log(resp)

        //Swal.fire("Creado", "El Cambio de Divisa ha sido creado", "success");
      })
      .catch((error) => {
        console.log(error);
      });

    }
  }
};
</script>

<style scoped>
.btn-series {
  background: linear-gradient(to right, #292e49, #536976);
  border-top-right-radius: 23px;
  border-bottom-right-radius: 23px;
}
.table-prices{
  min-width: 600px;
}
</style>