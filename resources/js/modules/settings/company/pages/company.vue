<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Configrurar empresa</h1>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row text-center justify-content-md-center">

      <div class="col col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 class="text-muted">Empresa</h5> 
            <h3>Chanquesito</h3>
          </div>
        </div>
      </div>

      <div class="col col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 class="text-muted">Modo</h5>
            <h3>Demo</h3>
          </div>
        </div>
      </div>
      
      <div class="col col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 class="text-muted">Versión Sistema</h5>
            <h3>V 2.1</h3>
          </div>
        </div>
      </div>
      
    </div>

    <div class="row justify-content-md-center">

      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4>Datos empresa generales</h4>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-user"></i>
                    RUC
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-briefcase"></i>
                    Razon Social
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-briefcase"></i>
                    Nombre Comercial
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-phone"></i>
                    Teléfono
                    </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-at"></i>
                    Email
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-map-marker-alt"></i>
                    Ubigeo
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-building"></i>
                    Urbanización
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-address-book"></i>
                    Direccion Fiscal
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      
    </div>

    <div class="row justify-content-md-center">

      <div class="col">
        <div class="card">
          <div class="card-header">
            <h4>Datos facturación SUNAT</h4>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-user"></i>
                    Usuario Sol
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-lock"></i>
                    Contraseña Sol
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-file-contract"></i>
                    Certificado Electrónico
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-lock"></i>
                    Contraseña Certificado
                  </label>
                  <input type="text" class="form-control" v-model="productName" required>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      
    </div>
    <input type="submit" class="btn btn-dark btn-block btn-lg mb-4" value="Guardar Configuración">
  </div>
  
</template>

<script>
export default {

}
</script>

<style>

</style>