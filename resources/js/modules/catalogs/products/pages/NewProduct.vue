<template>
<form @submit.prevent="createProduct()">
  <div class="row pt-3">
    <div class="col-md-7">
      <div class="row">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-6 col-md-3 col-lg-6">
                  <div>
                    <h4>Producto</h4>
                  </div>
                </div>
                <div class="col">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row justify-content-center">
                        <label class="mr-2">
                          ¿Tiene Grantía?
                        </label>
                        <div class="custom-control custom-switch custom-switch-on-danger is-invalid">
                          <input type="checkbox" class="custom-control-input" id="customSwitchHaveWarranty" v-model="haveWarranty">
                          <label class="custom-control-label" for="customSwitchHaveWarranty">{{ haveWarranty ? 'Si' : 'No' }}</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row justify-content-center">
                        <label class="mr-2">
                          ¿Maneja Series?
                        </label>
                        <div class="custom-control custom-switch custom-switch-on-danger is-invalid">
                          <input type="checkbox" class="custom-control-input" id="customSwitchManagerSeries" v-model="managerSeries">
                          <label class="custom-control-label" for="customSwitchManagerSeries">{{ managerSeries ? 'Si' : 'No' }}</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nombre del producto</label>
                    <input type="text" class="form-control" v-model="productName" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tipo de IGV</label>
                    <select class="form-control" v-model="igvTypeId">
                      <option v-for="igvType in igvTypes" :key="igvType.id" :value="igvType.id">{{ igvType.description }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Linea</label>
                    <select class="form-control" v-model="line">
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
                    <label for="">Slug</label>
                    <input class="form-control" type="text" :value="slug" disabled>
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
                  Solo se guarda el precio en dolares
                  <i class="fas fa-exclamation-triangle"></i>
                </small>
              </h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Tipo de cambio</label>
                    <input type="number" step="0.001" class="form-control" v-model="currencyExchange" @keyup="changePricesSoles()">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">P. Compra Soles</label>
                    <input type="number" step="0.001" class="form-control" v-model="purchasePriceSoles" @keyup="changePurchasePriceDollar()">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">P. Compra Dolares</label>
                    <input type="number" step="0.001" class="form-control" v-model="purchasePriceDollar" @keyup="changePurchasePriceSoles()">
                  </div>
                </div>
              </div>

              <div class="row">
                <p class="lead">
                  Precios de venta |
                  <small class="text-danger">
                    <i class="fas fa-hand-point-right"></i>
                    Respecto al precio de compra
                  </small>
                </p>
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
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="saleGainOne" @keyup="changeSalePriceSolesAndDollarOne()"></td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="salePriceOneSoles" @keyup="changeSalePriceDollarAndGainOne()"></td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="salePriceOneDollar" @keyup="changeSalePriceSolesAndGainOne()"></td>
                      </tr>
                      <tr>
                        <td class="align-middle">Precio 2</td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="saleGainTwo" @keyup="changeSalePriceSolesAndDollarTwo()"></td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="salePriceTwoSoles" @keyup="changeSalePriceDollarAndGainTwo()"></td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="salePriceTwoDollar" @keyup="changeSalePriceSolesAndGainTwo()"></td>
                      </tr>
                      <tr>
                        <td class="align-middle">Precio Tarjeta</td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="saleGainThree" @keyup="changeSalePriceSolesAndDollarThree()"></td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="salePriceThreeSoles" @keyup="changeSalePriceDollarAndGainThree()"></td>
                        <td class="align-middle"><input type="number" step="0.001" class="form-control" v-model="salePriceThreeDollar" @keyup="changeSalePriceSolesAndGainThree()"></td>
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
              <div class="row justify-content-center">
                  <img
                    class="img-fluid imagen d-flex"
                    style="height: 200px;"
                    src="https://icons-for-free.com/iconfiles/png/512/cloud+upload+file+storage+upload+icon-1320190558968694328.png"
                    alt="Photo"
                  >
              </div>

              <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <label for="">Código</label>
                    <input type="text" class="form-control" v-model="cod" @keydown.enter.prevent="">
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
                          <input type="number" min="0" class="form-control" v-model="selectedBranch.quantity" @change="addSeries(selectedBranch)">
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
                                  <input type="text" class="form-control" placeholder="Serie" v-model="obj.serie" @keydown.enter.prevent="">
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

      <div class="row" v-if="haveWarranty">
        <div class="col-md">
          <div class="card">
            <div class="card-header">
              <h4>Configuración de la garantía</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Lapsos</label>
                    <select class="form-control" v-model="typeOfTimeForWarranty">
                      <option value="days">Días</option>
                      <option value="weeks">Semanas</option>
                      <option value="months">Meses</option>
                      <option value="years">Años</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tiempo</label>
                    <input type="number" min="1" class="form-control" v-model="timeOfWarranty" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-dark btn-block btn-lg mb-4">
    <span><i class="fas fa-save"></i></span>
    Guardar Producto
  </button>
</form>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
  components: { BaseUrl },
  async created() {

    await BaseUrl.get(`api/products/create`).then((resp) => {

      this.branches = resp.data.data.branches;
      this.branches.forEach(e => {
        let tem = {
          id: e.id,
          description: e.description,
          quantity: 0,
          series : [],
          isAvailable: false
        }
        this.selectedBranches.push(tem)
      })

      this.lines = resp.data.data.lines
      this.brands = resp.data.data.brands
      this.currencyExchange = resp.data.data.currencyExchange.change;
      this.igvTypes = resp.data.data.igvTypes;

    })
  },
  data() {
    return {
      branches : [],
      lines : [],
      brands : [],
      igvTypes : [],

      cod: '',
      productName: '',
      description: '',
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

      igvTypeId: 10,

      haveWarranty: false,
      typeOfTimeForWarranty: 'months',
      timeOfWarranty: null,

    };
  },
  computed: {
    slug() {
      let lineBackup = this.lines
      let line = lineBackup.filter(
        (e) => e.id == this.line
      )
      let brandBackup = this.brands
      let brand = brandBackup.filter(
        (e) => e.id == this.brand
      )
      return `${line.length != 0 ? line[0].description : ''} ${brand.length != 0 ? brand[0].description : ''} ${this.productName} `
    }
  },
  methods:{
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
      this.saleGainThree = this.getGain(this.purchasePriceDollar, this.salePriceThreeDollar)
    },
    changeSalePriceDollarAndGainThree(){
      this.salePriceThreeDollar = this.changePriceDollar(this.salePriceThreeSoles)
      this.saleGainThree = this.getGain(this.purchasePriceDollar, this.salePriceThreeDollar)
    },
    changeSalePriceSolesAndDollarThree(){
      this.salePriceThreeDollar = this.getPrice(this.purchasePriceDollar, this.saleGainThree)
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
        sale_gain_one : this.saleGainOne,
        sale_gain_two : this.saleGainTwo,
        sale_gain_three : this.saleGainThree,
        manager_series : this.managerSeries,
        line_id : this.line,
        brand_id : this.brand,

        have_warranty: this.haveWarranty,
        type_of_time_for_warranty: this.haveWarranty ? this.typeOfTimeForWarranty : null,
        time_of_warranty: this.haveWarranty ? this.timeOfWarranty : null,

        igv_type_id: this.igvTypeId,

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
        
        this.$router.replace({ name: "product-list" });
        Swal.fire(
          "Producto Creado",
          "El producto ha sido creado satisfactoriamente",
          "success"
        );

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