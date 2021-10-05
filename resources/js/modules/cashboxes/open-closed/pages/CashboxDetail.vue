<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-info">
            <i class="fas fa-money-check-alt"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Ventas</span>
            <span class="info-box-number">1,410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-success">
            <i class="fas fa-hand-holding-usd"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Ingresos</span>
            <span class="info-box-number">410</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-4 col-sm-6 col-12">
        <div class="info-box">
          <span class="info-box-icon bg-warning">
            <i class="fas fa-file-invoice-dollar"></i>
          </span>

          <div class="info-box-content">
            <span class="info-box-text">Egresos</span>
            <span class="info-box-number">13,648</span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-sm-6 col-12">
        <button
          type="button"
          class="btn btn-primary btn-lg btn-block mb-3"
          @click="showModal('#new-income')"
        >
          <i class="fas fa-plus"></i>
          Nuevo Ingreso
        </button>
      </div>
      <div class="col-md-6 col-sm-6 col-12">
        <button type="button" class="btn btn-danger btn-lg btn-block mb-3">
          <i class="fas fa-minus"></i>
          Nuevo Egreso
        </button>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Detalle de balance de caja</h3>

        <div class="card-tools">
          <ul class="pagination pagination-sm float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <table class="table">
          <thead>
            <tr>
              <th>Fecha y Hora</th>
              <th>Concepto</th>
              <th>Comentario</th>
              <th>Monto</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>25 Jul 8:23</td>
              <td>Venta</td>
              <td>Efectivo</td>
              <td>S/. 30.00</td>
            </tr>
            <tr>
              <td>25 Jul 8:23</td>
              <td>Venta</td>
              <td>Efectivo</td>
              <td>S/. 30.00</td>
            </tr>
            <tr>
              <td>25 Jul 8:23</td>
              <td>Venta</td>
              <td>Efectivo</td>
              <td>S/. 30.00</td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3" class="text-right"><strong>Balance:</strong></td>
              <td>S/. 457.00</td>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>

  <!-- Modales -->
  <div class="modal fade" id="new-income" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Ingreso</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="newInconme()">
          <div class="modal-body">
            <div class="form-group">
              <label for="">Importe</label>
              <input
                type="number"
                class="form-control"
                v-model="inconme.amount"
                required
              />
            </div>
            <div class="form-group">
              <label for="">Observacion</label>
              <textarea
                class="form-control"
                rows="5"
                placeholder="Observacion..."
                v-model="inconme.observation"
              ></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="new-expense" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo Egreso</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="newInconme()">
          <div class="modal-body">
            <div class="form-group">
              <label for="">Importe</label>
              <input
                type="number"
                class="form-control"
                v-model="inconme.amount"
                required
              />
            </div>
            <div class="form-group">
              <label for="">Observacion</label>
              <textarea
                class="form-control"
                rows="5"
                placeholder="Observacion..."
                v-model="inconme.observation"
              ></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      inconme: {},
      expense: {},
    };
  },
  props: {
    cashbox: Number,
  },
  methods: {
    newInconme() {},
    showModal(modal, cashbox = null) {
      if (cashbox !== null) {
        this.cashbox = cashbox;
      }
      $(modal).modal("show");
    },
  },
};
</script>

<style>
</style>
