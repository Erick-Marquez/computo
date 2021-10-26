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
    <div class="modal-dialog modal-lg">
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
                      <input type="text" class="form-control" v-model="branch.codSunat" required>
                    </div>

                    <div class="form-group">
                      <label for="name">Nombre de la sucursal</label>
                      <input type="text" class="form-control" v-model="branch.description" required>
                    </div>

                    <div class="form-group">
                      <label for="name">Dirección</label>
                      <input type="text" class="form-control" v-model="branch.direction" required>
                    </div>

                    <div class="form-group">
                      <label for="name">Ubigeo</label>
                      <input type="text" class="form-control" v-model="branch.ubigeo" required>
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
                      <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                          <tr>
                            <th scope="col" class="col-md-6">Tipo de Comprobante</th>
                            <th scope="col" class="col-md-4">Serie</th>
                            <th scope="col" class="col-md-2">Numero</th>
                          </tr>    
                        </thead>
                        <tbody>
                          <tr>
                            <td>Factura Eléctronica</td>
                            <td><input class="form-control" type="text" v-model="branch.series.invoice" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.invoiceNumber" required></td>
                          </tr>
                          <tr>
                            <td>Boleta Eléctronica</td>
                            <td><input class="form-control" type="text" v-model="branch.series.ticket" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.ticketNumber" required></td>
                          </tr>
                          <tr>
                            <td>Nota de Venta Eléctronica</td>
                            <td><input class="form-control" type="text" v-model="branch.series.saleNote" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.saleNoteNumber" required></td>
                          </tr>
                          <tr>
                            <td>Nota de Crédito que modifica una Factura</td>
                            <td><input class="form-control" type="text" v-model="branch.series.creditNoteInvoice" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.creditNoteInvoiceNumber" required></td>
                          </tr>
                          <tr>
                            <td>Nota de Débito que modifica una Factura</td>
                            <td><input class="form-control" type="text" v-model="branch.series.debitNoteInvoice" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.debitNoteInvoiceNumber" required></td>
                          </tr>
                          <tr>
                            <td>Nota de Crédito que modifica una Boleta</td>
                            <td><input class="form-control" type="text" v-model="branch.series.creditNoteTicket" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.creditNoteTicketNumber" required></td>
                          </tr>
                          <tr>
                            <td>Nota de Débito que modifica una Boleta</td>
                            <td><input class="form-control" type="text" v-model="branch.series.debitNoteTicket" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.debitNoteTicketNumber" required></td>
                          </tr>
                          <tr>
                            <td>Cotización</td>
                            <td><input class="form-control" type="text" v-model="branch.series.quotation" required></td>
                            <td><input class="form-control" type="text" v-model="branch.series.quotationNumber" required></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
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
              <input type="text" class="form-control" v-model="branchEdit.codSunat" required>
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
              <input type="text" class="form-control" v-model="branchEdit.phone" required>
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
  async created(){
    this.showBranches()
  },
  data(){
    return{
      branches:{},
      branch: {
        codSunat: '0000',
        description: '',
        direction: '',
        ubigeo: '',
        phone: '',
        series: {
          invoice : 'F001',
          invoiceNumber : 1,
          ticket : 'B001',
          ticketNumber : 1,
          saleNote: 'N001',
          saleNoteNumber: 1,
          creditNoteInvoice: 'FC01',
          creditNoteInvoiceNumber: 1,
          debitNoteInvoice: 'FD01',
          debitNoteInvoiceNumber: 1,
          creditNoteTicket: 'BC01',
          creditNoteTicketNumber: 1,
          debitNoteTicket: 'BD01',
          debitNoteTicketNumber: 1,
          quotation: 'C001',
          quotationNumber: 1
        } 
      },
      branchEdit: {}
    }
  },
  methods:{
    async showBranches(){
      await BaseUrl.get(`api/branches`).then( resp => {
        this.branches=resp.data.data
      })
    },
    showModal(modal, branch = null) {
      if (branch !== null) {
        this.branchEdit = branch;
      }
      $(modal).modal("show");
    },
    createBranch(){
      console.log(this.branch)
      // BaseUrl.post(`api/branches`, this.branch).then( resp => {
        
      //   console.log(resp)
      //   $("#modal-create").modal("hide")
      //   this.showBranches()
      //   this.branch = {
      //     change: '',
      //     date: ''
      //   }
      //   Swal.fire("Creado", "La sucursal ha sido creada", "success");
      // })
      // .catch((error) => {
      //   console.log(error);
      // });
    },
    editBranch(){
      BaseUrl.put(`api/branch/${this.branchEdit.id}`, this.branchEdit).then( resp => {
        
        console.log(resp)
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