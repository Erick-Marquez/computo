<template>
  <div class="input-group">
    <input
      v-model.number="installments.number"
      @keyup="arrayDates()"
      type="number"
      class="form-control rounded-pill-left"
    />
    <span class="input-group-append">
      <button
        type="button"
        class="btn btn-dark btn-flat rounded-pill-right"
        data-toggle="modal"
        data-target="#exampleModal"
      >
        Fechas
      </button>
    </span>
  </div>
  <span v-if="errors['installments.dates'] != undefined" class="text-danger">
      {{ errors['installments.dates'][0] }}
  </span>

  <!-- Modal -->
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    data-backdrop="static"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Fecha y Monto de cuotas
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
            @click="arrayDates()"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div
            v-for="(number, index) in installments.number"
            :key="number.id"
            class="row"
          >
            <div class="col-md">
              <input
                type="date"
                v-model="installments.dates[index]"
                class="form-control rounded-pill mb-3"
              />
            </div>
            <div class="col-md">
              <input
                type="number"
                :value="(installments.amounts[index] = total_installment)"
                class="form-control rounded-pill mb-3"
              />
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-outline-dark"
            data-dismiss="modal"
            @click="arrayDates()"
          >
            Guardar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: { installments: Object, total_installment: String, errors: Object },
  methods: {
    arrayDates() {
      this.installments.dates = this.installments.dates.slice(
        0,
        this.installments.number
      );
    },
  },
  computed: {
    dateToday() {
      return moment().format("YYYY-MM-DD");
    },
  },
};
</script>

<style>
</style>
