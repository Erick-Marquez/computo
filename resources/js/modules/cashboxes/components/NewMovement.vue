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
          <span
            class="text-danger"
            v-for="error in errors.type"
            :key="error.index"
          >
            {{ error }}
          </span>
          <!-- <div class="form-group" v-if="movement.type == 'expense'">
            <label for="">Tipo de movimiento</label>
            <select
              name=""
              id=""
              class="form-control"
              v-model="movement.description"
              key="movement-description"
            >
              <option value="servicio" selected="true">Servicios</option>
              <option value="remuneracion">Remuneración</option>
            </select>
          </div>

          <div class="form-group" v-if="movement.description == 'remuneracion'">
            <label for="">Empleado</label>
            <select
              name=""
              id=""
              class="form-control"
              v-model="movement.employed"
              key="movement-employed"
            >
              <option value="juan">Juan</option>
              <option value="roberto">Roberto</option>
            </select>
          </div> -->
          <div class="form-group">
            <label for="">Monto</label>
            <input
              type="number"
              step="0.0001"
              class="form-control"
              v-model.number="movement.amount"
            />
            <span
              class="text-danger"
              v-for="error in errors.amount"
              :key="error.index"
            >
              {{ error }}
            </span>
          </div>
          <div class="form-group">
            <label for="">Observación</label>
            <textarea
              name=""
              id=""
              cols="30"
              rows="5"
              class="form-control"
              v-model="movement.observation"
            ></textarea>
            <span
              class="text-danger"
              v-for="error in errors.observation"
              :key="error.index"
            >
              {{ error }}
            </span>
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
          <button type="submit" class="btn btn-dark">Guardar</button>
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
    return {
      errors: {
        amount: {},
        type: {},
        observation: {},
      },
    };
  },
  props: {
    movement: Object,
    errors: Object,
  },
};
</script>

<style>
</style>
