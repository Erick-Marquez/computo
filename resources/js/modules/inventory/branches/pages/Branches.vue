<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Sucursales</h1>
    </div>
  </div>

  <div class="container-fluid">

    <button
      class="btn btn-lg btn-block btn-dark my-2"
      data-toggle="modal" 
      data-target="#modal-create"
    >
      <span><i class="fas fa-plus"></i></span>
      Nueva Sucursal
    </button>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Sucursales</h3>

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
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="branch in branches" :key="branch.id">
                    <td>{{ branch.id }}</td>
                    <td>{{ branch.description }}</td>
                    <td>{{ branch.direction }}</td>
                    <td>{{ branch.phone }}</td>
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
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                          <a class="dropdown-item" href="#" @click="showModal('#modal-edit', branch)"><i class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                          <router-link class="dropdown-item" :to="{ name:'show-product' ,params:{id:branch.id}}">
                            <i class="col-1 mr-3 fas fa-edit fas fa-plus"></i>
                            Productos
                          </router-link>
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


  <!-- Modal Nuevo -->
  <div class="modal fade" id="modal-create" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear Nueva Sucursal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createBranch()">
          <div class="modal-body">

            <div class="card card-danger card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-branch" role="tab" aria-controls="custom-tabs-branch" aria-selected="true"><i class="fas fa-hotel"></i> Info. Sucursal</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-series" role="tab" aria-controls="custom-tabs-series" aria-selected="false"><i class="fas fa-qrcode"></i> Series/Correlativos</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <!-- info-branch -->
                  <div class="tab-pane fade active show" id="custom-tabs-branch" role="tabpanel" aria-labelledby="custom-tabs-branch-tab">
                    
                    <div class="form-group">
                      <label for="name">Código SUNAT</label>
                      <input type="text" :class="'form-control' + (errorsCreate['cod_sunat'] == null ? '' : ' is-invalid')" 
                      v-model="branch.codSunat" required>
                      <div class="invalid-feedback" v-if="errorsCreate['cod_sunat']">
                        {{ errorsCreate['cod_sunat'][0] }}
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="name">Nombre de la sucursal</label>
                      <input type="text" :class="'form-control' + (errorsCreate['description'] == null ? '' : ' is-invalid')" 
                      v-model="branch.description" required>
                      <div class="invalid-feedback" v-if="errorsCreate['description']">
                        {{ errorsCreate['description'][0] }}
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="name">Dirección</label>
                      <input type="text" :class="'form-control' + (errorsCreate['direction'] == null ? '' : ' is-invalid')" 
                      v-model="branch.direction" required>
                      <div class="invalid-feedback" v-if="errorsCreate['direction']">
                        {{ errorsCreate['direction'][0] }}
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="name">Ubigeo</label>
                      <input type="text" :class="'form-control' + (errorsCreate['ubigeo'] == null ? '' : ' is-invalid')" 
                      v-model="branch.ubigeo" required>
                      <div class="invalid-feedback" v-if="errorsCreate['ubigeo']">
                        {{ errorsCreate['ubigeo'][0] }}
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="name">Teléfono</label>
                      <input type="text" class="form-control" v-model="branch.phone" required>
                    </div>

                  </div>
                  <!-- /.info-branch -->
                  <!-- Series -->
                  <div class="tab-pane fade" id="custom-tabs-series" role="tabpanel" aria-labelledby="custom-tabs-series-tab">

                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="color: #856404; background-color: #fff3cd; border-color: #ffeeba;">
                      <strong>Importante! </strong>Las series y correlativos de tus comprobantes no se deben repetir entre sucursales, una vez creada la sucursal ya no podrás cambiar las series!. Si vas a crear una segunda sucursal, cambié el número 1 de cada serie por el número dos, y si fuese una tercera sucursal cambia por el número tres, y así sucesivamente...
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="table-responsive">
                      <table class="table table-bordered" style="min-width: 650px;">
                        <thead class="thead-dark text-center">
                          <tr>
                            <th scope="col" class="col-5">Tipo de Comprobante</th>
                            <th scope="col" class="col-2">Serie</th>
                            <th scope="col" class="col-2">Numero</th>
                            <th scope="col" class="col-2">Afectación IGV</th>
                            <th scope="col" class="col-1">Eliminar</th>
                          </tr>    
                        </thead>
                        <tbody>
                          <tr v-for="(branchSerie, index) in branch.series" :key="branchSerie.id">
                            <td class="align-middle">
                              <select :class="'form-control' + (errorsCreate['series.'+ index +'.voucher_type_id'] == null ? '' : ' is-invalid')" 
                              v-model="branchSerie.voucherTypeId" @change="getExample(branchSerie)" :disabled="branchSerie.isDisable">
                                <option v-for="voucherType in voucherTypes" :key="voucherType.id" :value="voucherType.id">
                                  {{ voucherType.description }}
                                </option>
                              </select>
                              <div class="invalid-feedback" v-if="errorsCreate['series.'+ index +'.voucher_type_id']">
                                {{ errorsCreate['series.'+ index +'.voucher_type_id'][0] }}
                              </div>
                            </td>
                            <td class="align-middle">
                              <input :class="'form-control' + (errorsCreate['series.'+ index +'.serie'] == null ? '' : ' is-invalid')" 
                              type="text" :placeholder="branchSerie.example" v-model="branchSerie.serie" required>
                              <div class="invalid-feedback" v-if="errorsCreate['series.'+ index +'.serie']">
                                {{ errorsCreate['series.'+ index +'.serie'][0] }}
                              </div>
                            </td>
                            <td class="align-middle">
                              <input :class="'form-control' + (errorsCreate['series.'+ index +'.current_number'] == null ? '' : ' is-invalid')" 
                              type="number" min="1" v-model="branchSerie.number" required>
                              <div class="invalid-feedback" v-if="errorsCreate['series.'+ index +'.current_number']">
                                {{ errorsCreate['series.'+ index +'.current_number'][0] }}
                              </div>
                            </td>
                            <td class="align-middle text-center">
                              <div class="custom-control custom-switch custom-switch-on-danger">
                                <input type="checkbox" class="custom-control-input" :id="'customSwitchCreate' + index" v-model="branchSerie.haveIgv">
                                <label class="custom-control-label" :for="'customSwitchCreate' + index">{{ branchSerie.haveIgv ? 'Si' : 'No' }}</label>
                              </div>
                            </td>
                            <td class="align-middle text-center">
                              <button type="button" class="btn btn-flat" @click="branchSerie.isDisable ? null : deleteBranchSerie(index)" :disabled="branchSerie.isDisable">
                                <i class="text-danger fas fa-trash"></i>
                              </button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <button type="button" class="btn btn-md btn-block btn-dark my-2" @click="addBranchSerie()">
                      <span><i class="fas fa-plus"></i></span>
                      Añadir otra serie
                    </button>
                  </div>
                  <!-- /.Series -->
                </div>
              </div>
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

  <!-- Modal Editar -->
  <div class="modal fade" id="modal-edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Sucursal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="editBranch()">
          <div class="modal-body">
          
            <div class="form-group">
              <label for="name">Código SUNAT</label>
              <input type="text" class="form-control" v-model="branchEdit.cod_sunat" required>
            </div>

            <div class="form-group">
              <label for="name">Nombre de la sucursal</label>
              <input type="text" class="form-control" v-model="branchEdit.description" required>
            </div>

            <div class="form-group">
              <label for="name">Dirección</label>
              <input type="text" class="form-control" v-model="branchEdit.direction" required>
            </div>

            <div class="form-group">
              <label for="name">Ubigeo</label>
              <input type="text" class="form-control" v-model="branchEdit.ubigeo" required>
            </div>

            <div class="form-group">
              <label for="name">Teléfono</label>
              <input type="text" class="form-control" v-model="branchEdit.phone">
            </div>

          </div>

          <div class="modal-footer justify-content-between">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cerrar">
            <button type="submit" class="btn btn-primary">Actualizar</button>
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
    this.showBranches()
    this.getVoucherTypes()
  },
  data(){
    return{
      branches: [],
      voucherTypes: [],
      branch: {
        codSunat: '0000',
        description: '',
        direction: '',
        ubigeo: '',
        phone: '',
        series: []
      },
      branchEdit: {},
      errorsCreate: {}
    }
  },
  methods:{
    async showBranches(){
      await BaseUrl.get(`api/branches`).then( resp => {
        this.branches=resp.data.data
      })
    },
    async getVoucherTypes(){
      await BaseUrl.get(`api/series/voucherTypes`).then( resp=>{
        this.voucherTypes = resp.data.data

        this.voucherTypes.forEach(element => {

          let temp = {
            voucherTypeId: element.id,
            example: element.example,
            serie: element.example,
            number: 1,
            haveIgv: false,
            isDisable: true,
          }

          this.branch.series.push(temp);
        
        });

      })
    },
    showModal(modal, branch = null) {
      if (branch !== null) {

        this.branchEdit.id = branch.id
        this.branchEdit.cod_sunat = branch.cod_sunat
        this.branchEdit.description = branch.description
        this.branchEdit.direction = branch.direction
        this.branchEdit.ubigeo = branch.ubigeo
        this.branchEdit.phone = branch.phone

      }
      $(modal).modal("show");
    },
    createBranch(){

      let createBranch = {
        cod_sunat: this.branch.codSunat,
        description: this.branch.description,
        direction: this.branch.direction,
        ubigeo: this.branch.ubigeo,
        phone: this.branch.phone,
        series: []
      }

      let series = []

      this.branch.series.forEach(element => {

        let temp = {
          voucher_type_id: element.voucherTypeId,
          serie: element.serie,
          current_number: element.number,
          have_igv: element.haveIgv,
        }

        series.push(temp);
      });

      createBranch.series = series

      console.log(createBranch)
      BaseUrl.post(`api/branches`, createBranch).then( resp => {
        
        this.errorsCreate = {}
      
        $("#modal-create").modal("hide")

        this.showBranches()

        this.branch = {
          codSunat: '0000',
          description: '',
          direction: '',
          ubigeo: '',
          phone: '',
          series: []
        }
        this.voucherTypes.forEach(element => {

          let temp = {
            voucherTypeId: element.id,
            example: element.example,
            serie: element.example,
            number: 1,
            haveIgv: false,
            isDisable: true,
          }

          this.branch.series.push(temp);
        
        });

        Swal.fire("Creado", "La sucursal ha sido creada", "success");
        
      })
      .catch((error) => {
        this.errorsCreate = error.response.data.errors
      });

    },
    getExample(branchSerie){

      let voucherTypesBackup = this.voucherTypes

      let voucherTypeFilter = voucherTypesBackup.filter(
        (voucherTypes) => voucherTypes.id == branchSerie.voucherTypeId
      );

      branchSerie.example = 'Ej: ' + voucherTypeFilter[0].example
    },
    addBranchSerie(){

      let temp = {
        voucherTypeId: null,
        example: '👈 Selecciona',
        serie: null,
        number: 1,
        haveIgv: false,
        isDisable: false,
      }

      this.branch.series.push(temp);

    },
    deleteBranchSerie(index) {

      this.branch.series.splice(index, 1);

    },
    editBranch(){

      BaseUrl.put(`api/branches/${this.branchEdit.id}`, this.branchEdit).then( resp => {
        
        $("#modal-edit").modal("hide")
        this.showBranches()
        this.branchEdit = {}

        Swal.fire("Actualizado", "La sucursal ha sido actualizado", "success");

      })
      .catch((error) => {
        console.log(error);
      });

    },
    deleteBranch(id) {
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
          BaseUrl.delete(`api/branches/${id}`).then( resp => {
              this.showBranches();
              Swal.fire("Eliminado", "La sucursal ha sido eliminado", "success");
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    }
  }
}
</script>

<style>
</style>