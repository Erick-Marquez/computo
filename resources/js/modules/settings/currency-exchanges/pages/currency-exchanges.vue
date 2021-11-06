<template>
  <div class="content-header">
    <div class="row">
      <div class="col">
        <h1>Cambios de Divisas</h1>
      </div>
      <div class="col text-center">
        <div class="row">
          <div class="col">
                <span class="badge bg-maroon">Fecha:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.fecha }}
              </div>
              <div class="col">
                <span class="badge bg-maroon">Compra:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.compra }}
              </div>
              <div class="col">
                <span class="badge bg-maroon">Venta:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.venta }}
              </div>
        </div>
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
      Nuevo Cambio de Divisa
    </button>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Cambios de Divisas</h3>

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
                  <tr v-for="currencyExchange in currencyExchanges" :key="currencyExchange.id">
                    <td class="align-middle">{{ currencyExchange.date }}</td>
                    <td class="align-middle">{{ currencyExchange.change }}</td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#" @click="showModal('#modal-edit', currencyExchange)"><i class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                          <a class="dropdown-item" href="#" @click="deleteCurrencyExchange(currencyExchange.id)"><i class="col-1 mr-3 fas fa-trash"></i>Eliminar</a>
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
          <h4 class="modal-title">Nuevo Cambio de Divisa</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createCurrencyExchange()">
          <div class="modal-body">
            <div class="row text-center">
              <div class="col">
                <span class="badge bg-maroon">Fecha:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.fecha }}
              </div>
              <div class="col">
                <span class="badge bg-maroon">Compra:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.compra }}
              </div>
              <div class="col">
                <span class="badge bg-maroon">Venta:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.venta }}
              </div>
            </div>
            <br>
            <div class="form-group">
              <label for="name">Monto de Cambio</label>
              <input type="number" min="0" class="form-control" v-model="currencyExchange.change" required>
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
        <form @submit.prevent="editCurrencyExchange()">
          <div class="modal-body">
            <div class="row text-center">
              <div class="col">
                <span class="badge bg-maroon">Fecha:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.fecha }}
              </div>
              <div class="col">
                <span class="badge bg-maroon">Compra:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.compra }}
              </div>
              <div class="col">
                <span class="badge bg-maroon">Venta:</span>
              </div>
              <div class="col">
                {{ currentCurrencyExchange.venta }}
              </div>
            </div>
            <br>
            <div class="form-group">
              <label for="name">Monto de Cambio</label>
              <input type="number" min="0" class="form-control" v-model="currencyExchangeEdit.change" required>
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
    this.showCurrencyExchanges()
    this.getCurrentCurrencyExchange()
  },
  data(){
    return{
      currentCurrencyExchange : '',
      currencyExchanges: {},

      currencyExchange: {
        change: '',
        date: ''
      },
      errors: null,
      currencyExchangeEdit: {}


    }
  },
  methods:{
    async showCurrencyExchanges(){
      await BaseUrl.get(`api/currencyexchanges`).then( resp=>{
        this.currencyExchanges=resp.data.data
      })
    },
    async getCurrentCurrencyExchange(){
      await BaseUrl.get(`api/currencyexchanges/current`).then( resp=>{
        this.currentCurrencyExchange=resp.data
      })
    },

    showModal(modal, currencyExchange = null) {
      if (currencyExchange !== null) {
        this.currencyExchangeEdit = currencyExchange;
      }
      $(modal).modal("show");
    },
    createCurrencyExchange(){
      BaseUrl.post(`api/currencyexchanges`, this.currencyExchange).then( resp => {
        
        console.log(resp)
        $("#modal-create").modal("hide")
        this.showCurrencyExchanges()
        this.currencyExchange = {
          change: '',
          date: ''
        }
        Swal.fire("Creado", "El Cambio de Divisa ha sido creado", "success");
      })
      .catch((error) => {
        console.log(error.response);
        this.errors = error.response.data.errors
      });
    },
    editCurrencyExchange(){
      BaseUrl.put(`api/currencyexchanges/${this.currencyExchangeEdit.id}`, this.currencyExchangeEdit).then( resp => {
        
        console.log(resp)
        $("#modal-edit").modal("hide")
        this.showCurrencyExchanges()
        this.currencyExchangeEdit = {}

        Swal.fire("Actualizado", "El Cambio de Divisa ha sido actualizado", "success");
      })
      .catch((error) => {
        console.log(error);
      });
    },
    deleteCurrencyExchange(id) {
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
