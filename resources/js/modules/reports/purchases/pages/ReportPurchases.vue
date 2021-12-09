<template>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label class="lead" for="">Tipo de comprobante</label>
            <select class="form-control rounded-pill">
              <option value="">TODOS</option>
              <option value="">BOLETA</option>
              <option value="">FACTURA</option>
              <option value="">NOTA DE VENTA</option>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label class="lead" for="">Desde:</label>
            <input
              type="date"
              class="form-control rounded-pill"
              :max="maxDate"
              v-model="fromDate"
            />
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label class="lead" for="">Hasta:</label>
            <input
              type="date"
              class="form-control rounded-pill"
              :max="maxDate"
              v-model="untilDate"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
