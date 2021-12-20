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
          </div>
          <div
            class="invalid-feedback ml-3"
            v-if="$errorsExists(errors['type'])"
          >
            {{ $errorsPrint(errors["type"]) }}
          </div>

          <slot> </slot>

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
export default {
  data() {
    return {};
  },
  props: {
    movement: Object,
    errors: Object,
    disabled: Boolean,
  },
};
</script>

<style>
</style>
