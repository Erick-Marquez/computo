<template>
  <div class="content-header">
    <div class="container-fluid">

    </div>
  </div>

  <div class="container-fluid">
    <div class="card card-danger card-tabs">
      <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="custom-tabs-one-family-tab" data-toggle="pill" href="#custom-tabs-families" role="tab" aria-controls="custom-tabs-families" aria-selected="true"><h4>Familias</h4></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-line-tab" data-toggle="pill" href="#custom-tabs-lines" role="tab" aria-controls="custom-tabs-lines" aria-selected="false"><h4>Lineas</h4></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="custom-tabs-one-brand-tab" data-toggle="pill" href="#custom-tabs-brands" role="tab" aria-controls="custom-tabs-brands" aria-selected="false"><h4>Marcas</h4></a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">
          
          <!-- Families -->
          <div class="tab-pane fade active show" id="custom-tabs-families" role="tabpanel" aria-labelledby="custom-tabs-families-tab">

            <button class="btn btn-lg btn-block btn-dark my-2 mb-4" data-toggle="modal" data-target="#modal-family-create">
              <span><i class="fas fa-plus"></i></span>
              Nueva Familia
            </button>
            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lista de Familias</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px">
                        <input
                          type="text"
                          name="table_search"
                          class="form-control float-right"
                          placeholder="Search"
                        >

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="family in families" :key="family.id">
                            <td>{{ family.id }}</td>
                            <td>{{ family.cod }}</td>
                            <td>{{ family.description }}</td>
                            <td>
                              <div class="dropdown">
                                <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#">
                                    <i class="col-1 mr-3 fas fa-eye"></i>Mostrar
                                  </a>
                                  <a class="dropdown-item" href="#" @click="showModal('#modal-family-edit', 'F', family)">
                                    <i class="col-1 mr-3 fas fa-edit"></i>Editar
                                  </a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>
          </div>
          <!-- /.Families -->

          <!-- Lines -->
          <div class="tab-pane fade" id="custom-tabs-lines" role="tabpanel" aria-labelledby="custom-tabs-lines-tab">

            <button class="btn btn-lg btn-block btn-dark my-2" data-toggle="modal" data-target="#modal-lines-create">
              <span><i class="fas fa-plus"></i></span>
              Nueva Linea
            </button>
            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lista de Lineas</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px">
                        <input
                          type="text"
                          name="table_search"
                          class="form-control float-right"
                          placeholder="Search"
                        >

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="line in lines" :key="line.id">
                            <td>{{ line.id }}</td>
                            <td>{{ line.cod }}</td>
                            <td>{{ line.description }}</td>
                            <td>
                              <div class="dropdown">
                                <button
                                  class="btn btn-danger dropdown-toggle"
                                  type="button"
                                  id="dropdownMenuButton"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  Acciones
                                </button>
                                <div
                                  class="dropdown-menu"
                                  aria-labelledby="dropdownMenuButton"
                                  style=""
                                >
                                  <a
                                    class="dropdown-item"
                                    href="#"
                                    ><i class="col-1 mr-3 fas fa-eye"></i>Mostrar</a
                                  ><a
                                    class="dropdown-item"
                                    href="#"
                                    ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                                  >
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>

          </div>
          <!-- /.Lines -->

          <!-- Brands -->
          <div class="tab-pane fade" id="custom-tabs-brands" role="tabpanel" aria-labelledby="custom-tabs-brands-tab">

            <button class="btn btn-lg btn-block btn-dark my-2" data-toggle="modal" data-target="#modal-brands-create">
              <span><i class="fas fa-plus"></i></span>
              Nueva Marca
            </button>
            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Lista de Marcas</h3>

                    <div class="card-tools">
                      <div class="input-group input-group-sm" style="width: 150px">
                        <input
                          type="text"
                          name="table_search"
                          class="form-control float-right"
                          placeholder="Search"
                        >

                        <div class="input-group-append">
                          <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Codigo</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="brand in brands" :key="brand.id">
                            <td>{{ brand.id }}</td>
                            <td>{{ brand.cod }}</td>
                            <td>{{ brand.description }}</td>
                            <td>
                              <div class="dropdown">
                                <button
                                  class="btn btn-danger dropdown-toggle"
                                  type="button"
                                  id="dropdownMenuButton"
                                  data-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  Acciones
                                </button>
                                <div
                                  class="dropdown-menu"
                                  aria-labelledby="dropdownMenuButton"
                                  style=""
                                >
                                  <a
                                    class="dropdown-item"
                                    href="#"
                                    ><i class="col-1 mr-3 fas fa-eye"></i>Mostrar</a
                                  ><a
                                    class="dropdown-item"
                                    href="#"
                                    ><i class="col-1 mr-3 fas fa-edit"></i>Editar</a
                                  >
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
            </div>

          </div>
          <!-- /.Brands -->
        </div>
      </div>
  </div>
  </div>

  <!-- Modal Nueva Familia -->
  <div class="modal fade" id="modal-family-create" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nueva Familia</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createFamily()">
          <div class="modal-body">
          
            <div class="form-group">
              <label for="name">Código</label>
              <input type="text" class="form-control" v-model="family.cod">
            </div>

            <div class="form-group">
              <label for="name">Descripción</label>
              <input type="text" class="form-control" v-model="family.description" required>
            </div>

          </div>

          <div class="modal-footer justify-content-between">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal Editar Familia -->
  <div class="modal fade" id="modal-family-edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Familia</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="editFamily()">
          <div class="modal-body">
          
            <div class="form-group">
              <label for="name">Código</label>
              <input type="text" class="form-control" v-model="familyEdit.cod">
            </div>

            <div class="form-group">
              <label for="name">Descripción</label>
              <input type="text" class="form-control" v-model="familyEdit.description" required>
            </div>

          </div>

          <div class="modal-footer justify-content-between">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
  components:{BaseUrl},
  async created(){
    this.showFamilies()
    this.showLines()
    this.showBrands()
  },
  data(){
    return{
      families: {},
      family: {
        cod: '',
        description: '',
      },
      familyEdit: {
        id: '',
        cod: '',
        description: '',
      },

      lines: {},
      line: {
        cod: '',
        description: '',
      },
      lineEdit: {
        id: '',
        cod: '',
        description: '',
      },

      brands: {},
      brand: {
        cod: '',
        description: '',
      },
      brandEdit: {
        id: '',
        cod: '',
        description: '',
      },
    }
  },
  methods:{
    async showFamilies(){
      await BaseUrl.get(`api/families`).then( resp => {
        this.families=resp.data.data
      })
    },
    async showLines(){
      await BaseUrl.get(`api/lines`).then( resp => {
        this.lines=resp.data.data
      })
    },
    async showBrands(){
      await BaseUrl.get(`api/brands`).then( resp => {
        this.brands=resp.data.data
      })
    },

    showModal(modal, type, data = null) {
      
      if (data !== null) {

        type == 'F' ? this.familyEdit = data : 
        type == 'L' ? this.LineEdit = data : 
        type == 'B' ? this.brandEdit = data : false
      
      }
      $(modal).modal("show");
    },

    createFamily(){
      BaseUrl.post(`api/families`, this.family).then( resp => {
        
        console.log(resp)
        $("#modal-family-create").modal("hide")
        this.showFamilies()
        this.family = {
          cod: '',
          description: '',
        },
        Swal.fire("Creado", "La familia ha sido creada", "success");
      })
      .catch((error) => {
        console.log(error);
      });
    },
    editFamily(){
      BaseUrl.put(`api/families/${this.familyEdit.id}`, this.familyEdit).then( resp => {
        
        console.log(resp)
        $("#modal-family-edit").modal("hide")
        this.showFamilies()
        this.familyEdit = {}

        Swal.fire("Actualizado", "La familia ha sido actualizada", "success");
      })
      .catch((error) => {
        console.log(error);
      });
    },
    deleteFamily(id) {
      Swal.fire({
        title: "¿Estas Seguro?",
        text: "Esta acción no puede revertirse",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, adelante",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`api/currencyexchanges/${id}`).then( resp => {
              this.showCurrencyExchanges();
            })
            .catch((error) => {
              console.log(error);
            });

          Swal.fire("Eliminado", "El Cambio de Divisa ha sido eliminado", "success");
        }
      });
    },

    /* --------------------CRUD Lineas----------------------------- */
    createFamily(){
      BaseUrl.post(`api/lines`, this.line).then( resp => {
        
        console.log(resp)
        $("#modal-line-create").modal("hide")
        this.showLines()
        this.lines = {
          cod: '',
          description: '',
        },
        Swal.fire("Creado", "La familia ha sido creada", "success");
      })
      .catch((error) => {
        console.log(error);
      });
    },
    editFamily(){
      BaseUrl.put(`api/families/${this.familyEdit.id}`, this.familyEdit).then( resp => {
        
        console.log(resp)
        $("#modal-family-edit").modal("hide")
        this.showFamilies()
        this.familyEdit = {}

        Swal.fire("Actualizado", "La familia ha sido actualizada", "success");
      })
      .catch((error) => {
        console.log(error);
      });
    },
    deleteFamily(id) {
      Swal.fire({
        title: "¿Estas Seguro?",
        text: "Esta acción no puede revertirse",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, adelante",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`api/currencyexchanges/${id}`).then( resp => {
              this.showCurrencyExchanges();
            })
            .catch((error) => {
              console.log(error);
            });

          Swal.fire("Eliminado", "El Cambio de Divisa ha sido eliminado", "success");
        }
      });
    },
  }
}
</script>

<style>
</style>
