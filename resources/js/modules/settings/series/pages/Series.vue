<template>
  <div class="content-header">
    <div class="container-fluid">
      <h1>Series</h1>
    </div>
  </div>

  <div class="container-fluid">
    <button
      class="btn btn-lg btn-block btn-dark my-2"
      data-toggle="modal" 
      data-target="#modal-create"
    >
      <span><i class="fas fa-plus"></i></span>
      Nueva Serie
    </button>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Series</h3>

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
                    <th>Tipo</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Serie</th>
                    <th class="text-center">Numero Actual</th>
                    <th class="text-center">Sucursal</th>
                    <th class="text-center">Afectación IGV</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="serie in series" :key="serie.id">
                    <td class="align-middle">{{ serie.id }}</td>
                    <td class="align-middle">{{ serie.voucher_type.description }}</td>
                    <td class="align-middle text-center">{{ serie.active == 1 ? 'Activo' : 'Inactivo' }}</td>
                    <td class="align-middle text-center">{{ serie.serie }}</td>
                    <td class="align-middle text-center">{{ serie.current_number }}</td>
                    <td class="align-middle text-center">{{ serie.branch.description }}</td>
                    <td class="align-middle text-center">{{ serie.have_igv == 1 ? 'Si' : 'No' }}</td>
                    <td class="align-middle text-center">
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
                          <a
                            class="dropdown-item"
                            href="#"
                            ><i class="col-1 mr-3 fas fa-trash"></i>Eliminar</a
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

  <!-- Modal Nuevo -->
  <div class="modal fade" id="modal-create" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nueva Serie</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createSerie()">
          <div class="modal-body">
            <div class="form-group">
              <label for="">Sucursal</label>
              <select class="form-control" v-model="serieCreate.branch_id" required>
                <option v-for="branch in branches" :key="branch.id" :value="branch.id">
                  {{ branch.description }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="">Tipo de documento</label>
              <select class="form-control" v-model="serieCreate.voucher_type_id" @change="getExample()" required>
                <option v-for="voucherType in voucherTypes" :key="voucherType.id" :value="voucherType.id">
                  {{ voucherType.description }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label>Serie</label>
              <input type="text" :class="errorsCreate.serie == null ? 'form-control' : 'form-control is-invalid'" v-model="serieCreate.serie" :placeholder="serieExample" required>
              <div class="invalid-feedback" v-if="errorsCreate.serie">
                {{ errorsCreate.serie[0] }}
              </div>
            </div>
            <div class="form-group">
              <label>Correlativo Inicial</label>
              <input type="number" min="0" class="form-control" v-model="serieCreate.current_number" required>
            </div>
            <div v-if="serieCreate.voucher_type_id < 8 " class="form-group">
              <label>Afectación IGV</label>
              <div class="custom-control custom-switch custom-switch-on-danger">
                <input type="checkbox" class="custom-control-input" id="customSwitchCreate" v-model="serieCreate.have_igv">
                <label class="custom-control-label" for="customSwitchCreate">{{ serieCreate.have_igv ? 'Si' : 'No' }}</label>
              </div>
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
    this.showSeries()
    this.getBranches()
    this.getVoucherTypes()
  },
  data(){
    return{
      series: {},
      branches: {},
      voucherTypes: {},

      serieCreate: {
        serie: '',
        current_number: 1,
        have_igv: false,
        voucher_type_id: '',
        branch_id: ''
      },
      serieExample: 'Selecciona un tipo de documento',
      errorsCreate: {
        serie: null,
      }
    }
  },
  methods:{
    async showSeries(){
      await BaseUrl.get(`api/series`).then( resp=>{
        this.series = resp.data.data
      })
    },
    async getBranches(){
      await BaseUrl.get(`api/branches`).then( resp=>{
        this.branches = resp.data.data
      })
    },
    async getVoucherTypes(){
      await BaseUrl.get(`api/series/voucherTypes`).then( resp=>{
        this.voucherTypes = resp.data.data
      })
    },

    getExample(){
      let voucherTypesBackup = this.voucherTypes

      let voucherTypeFilter = voucherTypesBackup.filter(
        (voucherTypes) => voucherTypes.id == this.serieCreate.voucher_type_id
      );

      this.serieExample = 'Ej: ' + voucherTypeFilter[0].example
    },
    createSerie(){
      BaseUrl.post(`api/series`, this.serieCreate).then( resp => {
        
        $("#modal-create").modal("hide")
        this.showSeries() //mostrar las nuevas series

        //limpiar el objeto create 
        this.serieCreate = {
          serie: '',
          current_number: 1,
          have_igv: false,
          voucher_type_id: '',
          branch_id: ''
        }

        this.serieExample = 'Selecciona un tipo de documento'

        //limpiar el objeto error 
        this.errorsCreate = {
          serie: null,
        }
        
        Swal.fire("Creado", "La serie ha sido creada", "success")

        
      })
      .catch((error) => {
        //Pintar los errores
        this.errorsCreate = error.response.data.errors
      });
    }
  }
}
</script>

<style>
</style>
