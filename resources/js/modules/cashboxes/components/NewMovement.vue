<template>
  <!-- MODAL PARA AGREGAR NUEVO MOVIMIENTO -->
  <div class="modal fade" id="new-movement" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo movimiento</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-around mb-2">
            <div class="custom-control custom-radio">
              <input
                class="custom-control-input custom-control-input-danger"
                type="radio"
                id="expenses"
                name="movements"
                value="EGRESO"
                v-model="movement.type"
                checked="true"
              />
              <label for="expenses" class="custom-control-label">Egreso</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                class="custom-control-input custom-control-input-danger"
                type="radio"
                id="incomes"
                name="movements"
                value="INGRESO"
                v-model="movement.type"
              />
              <label for="incomes" class="custom-control-label">Ingreso</label>
            </div>
            <div class="custom-control custom-radio">
              <input
                class="custom-control-input custom-control-input-danger"
                type="radio"
                id="remuneration"
                name="movements"
                value="REMUNERACION"
                v-model="movement.type"
              />
              <label for="remuneration" class="custom-control-label"
                >Remuneración</label
              >
            </div>
          </div>
          <div
            class="invalid-feedback ml-3"
            v-if="$errorsExists(errors['type'])"
          >
            {{ $errorsPrint(errors["type"]) }}
          </div>

          <div class="form-group">
            <label for="">Tipo de pago</label>
            <select
              name=""
              id=""
              class="form-control rounded-pill"
              v-model="movement.payment_type_id"
            >
              <option v-for="pt in paymentTypes" :key="pt.id" :value="pt.id">
                {{ pt.description }}
              </option>
            </select>
          </div>

          <div v-if="movement.type == 'REMUNERACION'" class="form-group">
            <label for="">Vendedor:</label>
            <v-select
              class="style-chooser"
              v-model="movement.seller"
              label="name"
              :reduce="(seller) => seller.name"
              :options="sellers"
            >
              <template v-slot:no-options="{ search, searching }">
                <template v-if="searching">
                  No se encontraron resultados para
                  <b
                    ><em>{{ search }}</em></b
                  >.
                </template>
              </template>
            </v-select>
          </div>

          <div class="form-group">
            <label for="">Monto</label>
            <input
              type="number"
              step="0.0001"
              :class="$errorsClass(errors['amount'])"
              v-model.number="movement.amount"
            />
            <div
              class="invalid-feedback ml-3"
              v-if="$errorsExists(errors['amount'])"
            >
              {{ $errorsPrint(errors["amount"]) }}
            </div>
          </div>
          <div class="form-group">
            <label for="">Observación</label>
            <textarea
              name=""
              id=""
              cols="30"
              rows="5"
              :class="$errorsClassSquare(errors['observation'])"
              v-model="movement.observation"
            ></textarea>
            <div
              class="invalid-feedback ml-3"
              v-if="$errorsExists(errors['observation'])"
            >
              {{ $errorsPrint(errors["observation"]) }}
            </div>
          </div>
        </div>

        <div class="modal-footer justify-content-between">
          <button
            type="button"
            class="btn btn-outline-danger"
            data-dismiss="modal"
          >
            Cerrar
          </button>
          <button type="submit" class="btn btn-dark" :disabled="disabled">
            Guardar
          </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
</template>

<script>
import BaseUrl from "../../../api/BaseUrl";
export default {
  data() {
    return {
      paymentTypes: [],
      sellers: [],
    };
  },
  props: {
    movement: Object,
    errors: Object,
    disabled: Boolean,
  },
  created() {
    this.getPaymentTypes();
    this.getSellers();
  },
  methods: {
    async getPaymentTypes() {
      await BaseUrl.get(`/api/payment-types`)
        .then((response) => {
          this.paymentTypes = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async getSellers() {
      await BaseUrl.get(`/api/users`)
        .then((response) => {
          this.sellers = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>

<style>
.style-chooser .vs__dropdown-toggle {
  border-radius: 50px;
  width: 100%;
  height: calc(2.25rem + 2px);
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border-color: #ced4da;
  box-shadow: inset 0 0 0 transparent;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
  fill: #394066;
}
</style>
