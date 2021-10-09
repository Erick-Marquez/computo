<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Nueva Venta</h1>
    </div>
  </div>

  <div class="container-fluid">
    <form action="">
      <div class="card">
        <form action="">
          <div class="card-header">
            <h3 class="card-title">Card Tools</h3>

            <div class="card-tools">
              <!-- This will cause the card to maximize when clicked -->
              <button type="button" class="btn btn-outline-info ml-2">
                <i class="fas fa-file-invoice"></i>
                Crear Factura
              </button>
              <!-- This will cause the card to collapse when clicked -->
              <button type="button" class="btn btn-outline-info ml-2">
                <i class="fas fa-file-invoice-dollar"></i>
                Crear Boleta
              </button>
              <!-- This will cause the card to be removed when clicked -->
              <button type="button" class="btn btn-tool btn-outline-info ml-2">
                <i class="fas fa-receipt"></i>
                Nota de Venta
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="border rounded mt-5 mb-3 pb-3">
              <p class="lead">Listas :</p>
              <div class="row m-3">
                <h5 class="col-md-5">Descripción</h5>
                <h5 class="col">Cantidad</h5>
                <h5 class="col">Precio</h5>
                <h5 class="col">Sub Total</h5>
                <h5 class="col">Total</h5>
                <h5 class="col">Series</h5>
              </div>
            </div>

            <div class="row">
              <div class="col-8">
                <p class="lead">Observación:</p>
                <textarea
                  name=""
                  id=""
                  cols="30"
                  rows="4"
                  class="form-control"
                ></textarea>
              </div>
              <div class="col-4">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th>Subtotal:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Tax (9.3%)</th>
                        <td>$10.34</td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$265.24</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="row no-print">
              <div class="col-12">
                <a
                  href="invoice-print.html"
                  rel="noopener"
                  target="_blank"
                  class="btn btn-default"
                  ><i class="fas fa-print"></i> Print</a
                >
                <button type="button" class="btn btn-success float-right">
                  <i class="far fa-credit-card"></i> Submit Payment
                </button>
                <button
                  type="button"
                  class="btn btn-primary float-right"
                  style="margin-right: 5px"
                >
                  <i class="fas fa-download"></i> Generate PDF
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </form>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
