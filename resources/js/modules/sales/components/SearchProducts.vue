<template>
    <div class="row">
        <div class="col-md">
            <div class="">
                <input
                    type="search"
                    v-model="search"
                    @keyup="searchProducts"
                    @blur="toggle = false"
                    @focus="toggle = true"
                    class="form-control rounded-pill form-control rounded-pill-lg"
                    placeholder="Escribe tu producto o código"
                />
                <div class="option__relative">
                    <div class="option__contenedor" >
                        <div v-show="toggle">
                            <table table class="table table-sm table-bordered table-hover bg-white shadow-lg" @mousedown.prevent>
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <td>Nombre</td>
                                        <td class="col-2">Marca</td>
                                        <td class="col-2">Precio 1</td>
                                        <td class="col-2">Precio 2</td>
                                        <td class="col-2">Precio 3</td>
                                        <td class="col-1">Stock</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="search.length == 0">
                                        <td colspan="6">
                                            <div style="height: 65px;" class="d-flex justify-content-center align-items-center">
                                                <h3 style="font-weight: 300;" class="d-flex align-items-center">
                                                    <i class="fas fa-keyboard mr-2"></i>
                                                    Escribe el nombre o codigo de tu producto para empezar a buscar.
                                                </h3>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr v-else-if="loading">
                                        <td colspan="6">
                                            <div style="height: 65px;" class="d-flex justify-content-center align-items-center">
                                                <h3 style="font-weight: 300;" class="d-flex align-items-center">
                                                    <div class="spinner-border text-danger mr-2" role="status" style="font-size: 0.8rem">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                    Buscando...
                                                </h3>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr v-else-if="productsNotFound">
                                        <td colspan="6">
                                            <div style="height: 65px;" class="d-flex justify-content-center align-items-center">
                                                <h3 style="font-weight: 300;" class="d-flex align-items-center">
                                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                                    No se encontraron productos
                                                </h3>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr
                                        v-else
                                        v-for="product in products"
                                        :key="product"
                                    >
                                        <td>{{ product.name }}</td>
                                        <td class="col-2 text-center">{{ product.brand }}</td>
                                        <td class="col-2 text-center">
                                            <input
                                                class="btn btn-sm btn-success w-50"
                                                type="button"
                                                :value="product.sale_price"
                                                @click="selectProduct(product, product.sale_price)"
                                            >
                                        </td>
                                        <td class="col-2 text-center">
                                            <input
                                                class="btn btn-sm btn-warning w-50"
                                                type="button"
                                                :value="product.referential_sale_price_one"
                                                @click="selectProduct(product, product.referential_sale_price_one)"
                                            >
                                        </td>
                                        <td class="col-2 text-center">
                                            <input
                                                class="btn btn-sm btn-info w-50"
                                                type="button"
                                                :value="product.referential_sale_price_two"
                                                @click="selectProduct(product, product.referential_sale_price_two)"
                                            >
                                        </td>
                                        <td class="col-1 text-center">{{ product.stock }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BaseUrl from "../../../api/BaseUrl";
export default {
    components: { BaseUrl },
    props: {
        currencyExchange: Number,
    },
    emits: ["setProduct"],
    data() {
        return {
            toggle: false,
            loading: false,
            searching: null,
            productsNotFound: false,

            search: "",
            products: [],
        }
    },
    methods: {
        getProducts(){

            BaseUrl.get(`api/sales/products/${this.search}`).then((resp) => {

                let products = resp.data.data

                if (products.length > 0) {
                    products.forEach(product => {

                        product.sale_price = (product.referential_purchase_price * (1 + (product.sale_gain_one/100))).toFixed(2)
                        product.referential_sale_price_one = (product.referential_purchase_price * (1 + (product.sale_gain_two/100))).toFixed(2)
                        product.referential_sale_price_two = (product.referential_purchase_price * (1 + (product.sale_gain_three/100))).toFixed(2)

                        product.sale_price = (product.sale_price * this.currencyExchange).toFixed(2)
                        product.referential_sale_price_one = (product.referential_sale_price_one * this.currencyExchange).toFixed(2)
                        product.referential_sale_price_two = (product.referential_sale_price_two * this.currencyExchange).toFixed(2)

                    })
                    this.products = products
                } else {
                    this.productsNotFound = true
                }

            })
            .finally(() => {
                this.loading = false
            })

        },
        searchProducts(){

            this.loading = true
            this.productsNotFound = false
            clearTimeout(this.searching)

            if(this.search.length !== 0) {
                this.searching = setTimeout(this.getProducts, 400)
            }
            else{
                this.products = []
                this.loading = false
            }

        },
        selectProduct(product, price){
            this.products = []
            this.search = ''
            this.$emit("setProduct", product, price);
        }
    }
}
</script>

<style scoped>
.option__relative {
  position: relative;
  z-index: 99;
}
.option__contenedor {
  box-sizing: border-box;
  border-radius: 5px;
  width: 100%;
  max-height: 200px;
  box-shadow: 0 0 2px 0 rgb(255, 128, 128);
  background-color: #fff;
  box-sizing: border-box;
  cursor: pointer;
  overflow-y: scroll;
  position: absolute;
  z-index: 100;
}
.option__contenedor input,
.search input {
  display: block;
  margin-left: auto;
  margin-right: auto;
  /*border-color: #93a8c3;*/
  outline-color: rgb(255, 128, 128);
  border-style: solid;
  border-width: 1px;
  /*color:rgb(172,173,182)*/
}
.option__contenedor table {
  width: 100%;
  padding: 8px 10px;
  margin: 0;
}
.option__contenedor::-webkit-scrollbar {
  width: 7px;
  background-color: rgb(255, 128, 128);
}
.option__contenedor::-webkit-scrollbar-thumb {
  background-color: rgb(255, 255, 255);
  border-radius: 10px;
  border-right: 1px solid rgb(255, 128, 128);
  border-left: 1px solid rgb(255, 128, 128);
}
.search .option__contenedor {
  top: 0;
}
.search input {
  width: 100%;
  height: 40px;
  border-radius: 5px;
}
</style>
