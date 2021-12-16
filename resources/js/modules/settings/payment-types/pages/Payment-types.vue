<template>
  <div class="content-header">
    <div class="row">
      <div class="col">
        <h1>Tipos de Pago</h1>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <button
      class="btn btn-lg btn-block btn-dark my-2"
      data-toggle="modal" 
      data-target="#modal-create"
    >
      <span><i class="fas fa-plus"></i></span>
      Nuevo Tipo de Pago
    </button>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de los Tipos de Pago</h3>

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
                    <th>Fecha</th>
                    <th>Tipo de cambio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(paymentType, index) in paymentTypes" :key="paymentType.id">
                    <td class="align-middle">{{ index + 1 }}</td>
                    <td class="align-middle">{{ paymentType.description }}</td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#" @click="showModal('#modal-edit', paymentType)"><i class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                          <a class="dropdown-item" href="#" @click="deletePaymentType(paymentType.id)"><i class="col-1 mr-3 fas fa-trash"></i>Eliminar</a>
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
          <h4 class="modal-title">Nuevo Tipo de Pago</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createPaymentType()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Descripcion</label>
              <input type="text" class="form-control" v-model="paymentType.description" required>
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
          <h4 class="modal-title">Editar Cambio de Divisa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="editPaymentType()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Descripcion</label>
              <input type="text" class="form-control" v-model="paymentTypeEdit.description" required>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
              Cerrar
            </button>
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
  created(){
    this.showPaymentTypes()
  },
  data(){
    return{
      paymentTypes: {},

      paymentType: {
        description: null,
      },
      errors: null,
      paymentTypeEdit: {}


    }
  },
  methods:{
    async showPaymentTypes(){
      await BaseUrl.get(`api/payment-types`).then( resp=>{
        this.paymentTypes=resp.data.data
      })
    },

    showModal(modal, paymentType = null) {
      if (paymentType !== null) {
        this.paymentTypeEdit = paymentType;
      }
      $(modal).modal("show");
    },
    createPaymentType(){
      BaseUrl.post(`api/payment-types`, this.paymentType).then( resp => {
        
        console.log(resp)
        $("#modal-create").modal("hide")
        this.showPaymentTypes()
        this.paymentType = {
          description: null,
        }
        Swal.fire("Creado", "El tipo de pago ha sido creado", "success");
      })
      .catch((error) => {
        console.log(error.response);
        this.errors = error.response.data.errors
      });
    },
    editPaymentType(){
      BaseUrl.put(`api/payment-types/${this.paymentTypeEdit.id}`, this.paymentTypeEdit).then( resp => {
        
        console.log(resp)
        $("#modal-edit").modal("hide")
        this.showPaymentTypes()
        this.paymentTypeEdit = {}

        Swal.fire("Actualizado", "El tipo de pago ha sido actualizado", "success");
      })
      .catch((error) => {
        console.log(error);
      });
    },
    deletePaymentType(id) {
      Swal.fire({
        title: "¿Estas Seguro?",
        text: "Esta acción no puede revertirse",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, adelante",
        cancelButtonText: "Cancelar",
        showLoaderOnConfirm: true,
        preConfirm: async () => {

          try {
            const resp=await BaseUrl.delete(`api/payment-types/${id}`)
            this.showPaymentTypes()
            Swal.fire("Eliminado", "El tipo de pago ha sido eliminado.", "success")

          } catch(error) {
            console.log(error.response.data.error)
            Swal.fire("Cancelado", "Este tipo de pago esta siendo utilizado.", "error")
          }

        },
      });
    },
  }
}
</script>

<style>
</style>
