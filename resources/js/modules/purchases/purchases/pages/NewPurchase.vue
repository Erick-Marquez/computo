<template>
  <div class="content-header">
    <h3>Registrar Nueva Venta</h3>
  </div>
  <div class="card">
    <div class="card-body">
      <h4>Comprobante</h4>
      <div class="row">
        <!-- TIPO DE COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-file-invoice"></i>
              Tipo comprobante
            </label>
            <select name="" id="" class="form-control rounded-pill">
              <option value="">Opcion1</option>
              <option value="">Opcion2</option>
            </select>
          </div>
        </div>

        <!-- SERIE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-barcode"></i>
              Serie</label
            >
            <input type="text" class="form-control rounded-pill" />
          </div>
        </div>

        <!-- N° COMPROBANTE -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-hashtag"></i>
              N° Comprobante</label
            >
            <input type="text" class="form-control rounded-pill" />
          </div>
        </div>
      </div>

      <h4>Documento de identidad</h4>
      <div class="row">
        <!-- TIPO DOCUMENTO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fas fa-address-card"></i>
              Tipo documento
            </label>
            <select name="" id="" class="form-control rounded-pill">
              <option value="">Opcion1</option>
              <option value="">Opcion2</option>
            </select>
          </div>
        </div>

        <!-- N° DOCUMENTO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fas fa-pen"></i>
              N° Documento</label
            >
            <div class="input-group">
              <input type="text" class="form-control rounded-pill" />
              <div class="input-group-append">
                <button class="btn btn-dark">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>

        <!-- NOMBRE/RAZON SOCIAL -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-id-badge"></i>
              Nombre/Razón Social:</label
            >
            <input type="text" class="form-control rounded-pill" />
          </div>
        </div>
      </div>

      <div class="row">
        <!-- DIRECCIÓN -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-map-marker-alt"></i>
              Dirección</label
            >
            <input
              type="text"
              class="form-control rounded-pill"
              name=""
              id=""
            />
          </div>
        </div>

        <!-- UBIGEO -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-globe"></i>
              Ubigeo</label
            >
            <select name="" id="" class="form-control rounded-pill">
              <option value="">Opcion1</option>
              <option value="">Opcion2</option>
            </select>
          </div>
        </div>

        <!-- N° CELULAR -->
        <div class="col-md-4">
          <div class="form-group">
            <label for="">
              <i class="text-danger fas fa-phone"></i>
              N° Celular</label
            >
            <input
              type="text"
              class="form-control rounded-pill"
              name=""
              id=""
            />
          </div>
        </div>
      </div>

      <!-- COMPONENTE PARA BUSCAR PRODUCTOS -->
      <div class="row">
        <div class="col-md">
          <h4>
            <i class="text-danger fas fa-box"></i>
            Productos
          </h4>
          <div class="input-group">
            <input
              type="search"
              class="form-control rounded-pill form-control rounded-pill-lg"
              placeholder="Escribe tu producto o código"
            />
          </div>
        </div>
      </div>

      <!-- VER PRODUCTOS SELECCIONADOS -->
      <div class="row">
        <div class="col-12 table-responsive mt-4">
          <table class="table table-striped">
            <thead>
              <tr>
                <th style="width: 40%">Descripción</th>
                <th style="width: 20%">Tipo IGV</th>
                <th style="width: 3%">Cantidad</th>
                <th style="width: 10%">Precio</th>
                <th style="width: 10%">Sub Total</th>
                <th style="width: 10%">Total</th>
                <th style="width: 5%">Series</th>
                <th style="width: 3%"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>

                <td>
                    <select name="" id="" class="form-control rounded-pill">
                        <option value="" default>Gravada</option>
                        <option value="">Exonerada</option>
                    </select>
                </td>
                <td>
                  <input class="form-control rounded-pill form-control rounded-pill-border"
                    type="text"
                    name=""
                    id=""
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    name=""
                    id=""
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    name=""
                    id=""
                  />
                </td>
                <td>
                  <input
                    class="
                      form-control
                      rounded-pill
                      form-control
                      rounded-pill-border
                    "
                    type="text"
                    name=""
                    id=""
                  />
                </td>
                <td>
                  <button class="btn btn-dark btn-sm">Series</button>
                </td>
                <td>
                  <button class="btn btn-flat bg-light">
                    <i class="text-danger fas fa-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Observación -->
      <div class="row">
        <div class="col-md-8">
          <h4>Detalle Documento</h4>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Descuento</label>
                <input class="form-control rounded-pill" type="text" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Total Recibido S/.</label>
                <input class="form-control rounded-pill" type="text" />
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Vuelto S/.</label>
                <input class="form-control rounded-pill" type="text" />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md">
              <div class="form-group">
                <h4>Observación</h4>
                <textarea
                  name=""
                  id=""
                  cols="30"
                  rows="4"
                  class="form-control rounded-pill px-5"
                ></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
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

      <!-- Resumen de ventas -->
      <div class="row no-print">
        <div class="col-12">
          <!-- <a
            href="invoice-print.html"
            rel="noopener"
            target="_blank"
            class="btn btn-default"
            ><i class="fas fa-print"></i> Print</a
          > -->
          <button type="button" class="btn btn-dark float-right">
            <i class="far fa-credit-card"></i> Guarda Documento Electronico
          </button>
          <!-- <button
            type="button"
            class="btn btn-primary float-right"
            style="margin-right: 5px"
          >
            <i class="fas fa-download"></i> Generate PDF
          </button> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.btn.btn-dark {
  border-top-right-radius: 23px;
  border-bottom-right-radius: 23px;
  background: #536976; /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to right,
    #292e49,
    #536976
  ); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to right,
    #292e49,
    #536976
  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}

label {
  color: rgba(48, 48, 48, 0.774);
  font-weight: 300;
}
</style>
