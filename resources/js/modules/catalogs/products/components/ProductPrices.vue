<template>
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
</template>

<script>
export default {
    props: {
        currencyExchange: Number,
        purchasePriceDollarProp: Number,
        saleGainOneProp: Number,
        saleGainTwoProp: Number,
        saleGainThreeProp: Number,
        errors: Object
    },
    emits: ["changePrices"],
    data() {
        return {

            purchasePriceSoles: '',
            purchasePriceDollar: this.purchasePriceDollarProp,

            saleGainOne: this.saleGainOneProp,
            salePriceOneSoles: '',
            salePriceOneDollar: '',

            saleGainTwo: this.saleGainTwoProp,
            salePriceTwoSoles: '',
            salePriceTwoDollar: '',

            saleGainThree: this.saleGainThreeProp,
            salePriceThreeSoles: '',
            salePriceThreeDollar: '',
        }
    },
    methods: {
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
    },
}
</script>

<style>

</style>