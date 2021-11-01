<template>
  <div class="content-header">
    <div class="row">
      <div class="col">
        <h1>Usuarios</h1>
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
      Nuevo Usuario
    </button>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Lista de Usuarios</h3>

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
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Sucursal</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="user in users" :key="user.id">
                    <td class="align-middle">{{ user.id }}</td>
                    <td class="align-middle">{{ user.name }}</td>
                    <td class="align-middle">
                        <p v-for="role in user.roles" :key="role.id">{{ role.name }}</p>
                    </td>
                    <td class="align-middle">{{ user.branch.description }}</td>
                    <td class="align-middle">Activo</td>
                    <td class="align-middle">
                      <div class="dropdown">
                        <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Acciones
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#" @click="showModal('#modal-edit', user)"><i class="col-1 mr-3 fas fa-edit"></i>Editar</a>
                          <a class="dropdown-item" href="#" @click="deleteUser(user.id)"><i class="col-1 mr-3 fas fa-trash"></i>Eliminar</a>
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
          <h4 class="modal-title">Nuevo Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createUser()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" v-model="userCreate.name" required>
            </div>
            <div class="form-group">
              <label for="name">Correo</label>
              <input type="text" class="form-control" v-model="userCreate.email" required>
            </div>
            <div class="form-group">
              <label for="name">Contraseña</label>
              <input type="password" class="form-control" v-model="userCreate.password" required>
            </div>
            <div class="form-group">
              <label for="name">Sucursal</label>
              <select class="form-control" v-model="userCreate.branch_id">
                <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.description }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Roles</label>
            </div>
            <div class="form-group" v-for="(role, index) in roles" :key="role.id">
              <div class="custom-control custom-switch custom-switch-on-danger">
                <input type="checkbox" class="custom-control-input" :id="'customSwitchCreate' + role.id" v-model="userCreate.roles[index].isAvailable">
                <label class="custom-control-label" :for="'customSwitchCreate' + role.id">{{ role.name }}</label>
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
          <h4 class="modal-title">Editar Usuario</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="editUser()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" v-model="userEdit.name" required>
            </div>
            <div class="form-group">
              <label for="name">Correo</label>
              <input type="text" class="form-control" v-model="userEdit.email" required>
            </div>
            <div class="form-group">
              <label for="name">Contraseña</label>
              <input type="password" class="form-control" v-model="userEdit.password" required>
            </div>
            <div class="form-group">
              <label for="name">Sucursal</label>
              <select class="form-control" v-model="userEdit.branch_id">
                <option v-for="branch in branches" :key="branch.id" :value="branch.id">{{ branch.description }}</option>
              </select>
            </div>
            <div class="form-group">
              <label for="name">Roles</label>
            </div>
            <div class="form-group" v-for="(role, index) in roles" :key="role.id">
              <div class="custom-control custom-switch custom-switch-on-danger">
                <input type="checkbox" class="custom-control-input" :id="'customSwitchEdit' + role.id" v-model="userEdit.roles[index].isAvailable">
                <label class="custom-control-label" :for="'customSwitchEdit' + role.id">{{ role.name }}</label>
              </div>
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
    this.showUsers()
    this.getBranches()
    this.getRoles()
  },
  data(){
    return{
      users: {},
      branches: [],
      roles: {},

      userCreate: {
        name: '',
        email: '',
        password: '',
        branch_id: '',
        roles: []
      },
      userEdit: {
        name: '',
        email: '',
        branch_id: '',
        roles: []
      }
    }
  },
  methods:{
    async showUsers(){
      await BaseUrl.get(`api/users`).then( resp=>{
        this.users = resp.data.data
      })
    },
    async getBranches(){
      await BaseUrl.get(`api/branches`).then( resp=>{
        this.branches = resp.data.data
      })
    },
    async getRoles(){
      await BaseUrl.get(`api/roles`).then( resp=>{
        this.roles = resp.data.data

        resp.data.data.forEach(e => {
          let tem = {
            id: e.id,
            name: e.name,
            isAvailable: false
          }
          this.userCreate.roles.push(tem)
          this.userEdit.roles.push(tem)
        })
      })
    },
    showModal(modal, user = null) {
      if (user !== null) {
        this.userEdit.name = user.name
        this.userEdit.email = user.email
        this.userEdit.branch_id = user.branch_id
        this.userEdit.roles = []

        this.roles.forEach(e => {
          user.roles.forEach(elem => {
            if (e.name == elem.name) {
              let tem = {
                id: e.id,
                name: e.name,
                isAvailable: true
              }
              this.userEdit.roles.push(tem)
            }
            else {
              let tem = {
                id: e.id,
                name: e.name,
                isAvailable: false
              }
              this.userEdit.roles.push(tem)
            }
          })
   
        })
      }
      $(modal).modal("show");
      console.log(this.userEdit)
    },
    createUser(){
      console.log(this.userCreate)
      // BaseUrl.post(`api/users`, this.user).then( resp => {
        
      //   console.log(resp)
      //   $("#modal-create").modal("hide")
      //   this.showusers()
      //   this.user = {
      //     change: '',
      //     date: ''
      //   }
      //   Swal.fire("Creado", "El Cambio de Divisa ha sido creado", "success");
      // })
      // .catch((error) => {
      //   console.log(error);
      // });
    },
    editUser(){
      BaseUrl.put(`api/users/${this.userEdit.id}`, this.userEdit).then( resp => {
        
        console.log(resp)
        $("#modal-edit").modal("hide")
        this.showusers()
        this.userEdit = {}

        Swal.fire("Actualizado", "El Cambio de Divisa ha sido actualizado", "success");
      })
      .catch((error) => {
        console.log(error);
      });
    },
    deleteUser(id) {
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
          BaseUrl.delete(`api/users/${id}`).then( resp => {
              this.showusers();
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
