<template>
<form @submit.prevent="editProduct()">
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
                                                    <input type="checkbox" class="custom-control-input" id="customSwitchHaveWarranty" v-model="product.have_warranty">
                                                    <label class="custom-control-label" for="customSwitchHaveWarranty">{{ product.have_warranty ? 'Si' : 'No' }}</label>
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
                                        <input type="text" class="form-control" v-model="product.name" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tipo de IGV</label>
                                        <select class="form-control" v-model="product.igv_type_id">
                                            <option v-for="igvType in igvTypes" :key="igvType.id" :value="igvType.id">{{ igvType.description }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Linea</label>
                                        <select class="form-control" v-model="product.line_id">
                                            <option v-for="line in lines" :key="line.id" :value="line.id">{{ line.description }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Marca</label>
                                        <select class="form-control" v-model="product.brand_id">
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
                                        <textarea cols="30" rows="5" class="form-control" v-model="product.description"></textarea>
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
                                        <input type="text" class="form-control" v-model="product.cod">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" v-if="product.have_warranty">
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
                                        <select class="form-control" v-model="product.type_of_time_for_warranty">
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
                                        <input type="number" min="1" class="form-control" v-model="product.time_of_warranty" required>
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
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
    components: { BaseUrl },
    async created(){
        await BaseUrl.get(`api/products/edit/${this.$route.params.id}`).then((resp) => {

            this.lines = resp.data.data.lines
            this.brands = resp.data.data.brands
            this.currencyExchange = resp.data.data.currencyExchange.change
            this.igvTypes = resp.data.data.igvTypes

            this.product = resp.data.data.product
            this.product.have_warranty = Boolean(this.product.have_warranty)

            this.purchasePriceDollar = this.product.referential_purchase_price
            this.saleGainOne = this.product.sale_gain_one
            this.saleGainTwo = this.product.sale_gain_two
            this.saleGainThree = this.product.sale_gain_three

            this.changePurchasePriceSoles()
        })
    },
    data(){
        return{
            branches : [],
            lines : [],
            brands : [],
            igvTypes : [],

            product: {},

            /* Precios */
            currencyExchange: '',
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
        }
    },
    computed: {
        slug() {
            let lineBackup = this.lines
            let line = lineBackup.filter(
                (e) => e.id == this.product.line_id
            )
            let brandBackup = this.brands
            let brand = brandBackup.filter(
                (e) => e.id == this.product.brand_id
            )
            return `${line.length != 0 ? line[0].description : ''} ${brand.length != 0 ? brand[0].description : ''} ${this.product.name} `
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

        editProduct(){

            this.product.referential_purchase_price = this.purchasePriceDollar
            this.product.sale_gain_one = this.saleGainOne
            this.product.sale_gain_two = this.saleGainTwo
            this.product.sale_gain_three = this.saleGainThree

            BaseUrl.put(`api/products/${this.product.id}`, this.product)
            .then( resp => {
                
                this.$router.replace({ name: "product-list" });
                Swal.fire(
                    "Producto Actualizado",
                    "El producto ha sido actualizado satisfactoriamente",
                    "success"
                );

            })
            .catch((error) => {
                console.log(error);
            });
        }
    }
}
</script>

<style scoped>

</style>