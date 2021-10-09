<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Comprobantes</h1>
    </div>
  </div>

  <div class="container-fluid">
    <router-link class="btn btn-lg btn-block btn-primary mb-4" :to="{ name: 'new-voucher' }">
      <i class="fas fa-plus"></i>
      Nueva venta
    </router-link>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de comprobantes</h3>

            <div class="card-tools">
              <div class="input-group input-group-sm" style="width: 150px">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                />

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Tipo de documento</th>
                  <th>Número de documento</th>
                  <th>Cliente</th>
                  <th>Total</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>
