<template>
  <!-- VER PRODUCTOS SELECCIONADOS -->
  <div class="row">
    <div class="col-12 table-responsive mt-4">
      <table class="table">
        <thead>
          <tr>
            <th class="text-center" style="width: 40%">Descripción</th>
            <th class="text-center" style="width: 20%">Tipo IGV</th>
            <th class="text-center" style="width: 3%">Cantidad</th>
            <th class="text-center" style="width: 10%">Precio</th>
            <th class="text-center" style="width: 10%">Sub Total</th>
            <th class="text-center" style="width: 10%">Total</th>
            <th class="text-center" style="width: 5%">Series</th>
            <th class="text-center" style="width: 3%"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="8">
              <div class="image-without-products" v-if="!products.length">
                <img
                  src="/images/add_product.png"
                  alt=""
                  style="max-height: 120px"
                />
                <h1 class="display-4">Agregue productos</h1>
              </div>
            </td>
          </tr>
          <tr v-for="(product, index) in products" :key="product.id">
            <td class="px-1">
              {{ product.name }}
              <p v-if="$errorsExists(errors[`products.${index}.series`])" class="text-danger text-sm">
                {{
                  $errorsPrint(
                    errors[`products.${index}.series`]
                  )
                }}
                <i class="fas fa-exclamation-circle"></i>
              </p>
            </td>

            <td class="px-1">
              <select class="form-control rounded-pill" v-model="product.igv">
                <option :value="true" default>Gravada</option>
                <option :value="false">Exonerada</option>
              </select>
            </td>
            <td class="px-1">
              <input
                :class="[
                  $errorsClassSquare(
                    errors[`products.${index}.quantity`]
                  ),
                  'form-control-border p-0 text-center',
                ]"
                type="text"
                v-model="product.quantity"
              />
              <div
                v-if="
                  $errorsExists(
                    errors[`products.${index}.quantity`]
                  )
                "
                class="invalid-feedback"
              >
                {{
                  $errorsPrint(
                    errors[`products.${index}.quantity`]
                  )
                }}
              </div>
            </td>
            <td class="px-1">
              <input
                :class="[
                  $errorsClassSquare(
                    errors[`products.${index}.referential_purchase_price`]
                  ),
                  'form-control-border p-0 text-center',
                ]"
                type="text"
                v-model="product.referential_purchase_price"
              />
              <div
                v-if="
                  $errorsExists(
                    errors[`products.${index}.referential_purchase_price`]
                  )
                "
                class="invalid-feedback"
              >
                {{
                  $errorsPrint(
                    errors[`products.${index}.referential_purchase_price`]
                  )
                }}
              </div>
            </td>
            <td class="px-1">
              <input
                class="form-control form-control-border p-0 text-center"
                type="text"
                :value="
                  (product.subtotal = product.igv
                    ? parseFloat(
                        (product.referential_purchase_price *
                          product.quantity) /
                          1.18
                      ).toFixed(2)
                    : parseFloat(
                        (
                          product.referential_purchase_price * product.quantity
                        ).toFixed(2)
                      ))
                "
                disabled
              />
            </td>
            <td class="px-1">
              <input
                class="form-control form-control-border p-0 text-center"
                type="text"
                :value="
                  (product.total =
                    product.referential_purchase_price * product.quantity)
                "
                disabled
              />
            </td>
            <td class="px-1">
              <button
                @click.prevent="showModalSeries(index)"
                class="btn btn-dark btn-sm"
                v-show="product.manager_series"
              >
                Series
              </button>
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

  <!-- MODAL SERIES -->
  <!-- Este modal al cerrarse tiene que estar en su fase de inicial - para no causar errores -->
  <div
    class="modal fade"
    id="modal-series"
    tabindex="-1"
    data-backdrop="static"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Series</h5>
          <button
            type="button"
            class="close"
            aria-label="Close"
            @click="closeModalSeries()"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div
            v-for="(serie, serieIndex) in Number(quantity)"
            :key="serie.id"
            class="form-group"
          >
            <input
              class="form-control"
              type="text"
              v-model="products[index].series[serieIndex]"
            />
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-dark"
            @click.prevent="closeModalSeries()"
          >
            Guardar Series
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
  data() {
    return {
      index: null,
      quantity: null,
    };
  },
  props: {
    products: Object,
    errors: Object,
  },
  methods: {
    showModalSeries(index) {
      this.index = index;
      $("#modal-series").modal("show");
      this.quantity = this.products[this.index].quantity;
    },
    removeProduct(index) {
      this.products.splice(index, 1);
    },
    closeModalSeries() {
      this.index = null;
      this.quantity = null;
      $("#modal-series").modal("hide");
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

