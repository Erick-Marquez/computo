<template>
  <!-- BOTON PARA NUEVO MOVIMIENTO -->
  <button
    class="btn btn-dark btn-block btn-lg mb-4"
    data-toggle="modal"
    data-target="#new-movement"
  >
    Nuevo movimiento
  </button>

  <form @submit.prevent="createMovement()">
    <new-movement-vue :movement="movement" :errors="errors">
      <div class="form-group">
        <label for="">Tipo de pago</label>
        <select
          name=""
          id=""
          class="form-control rounded-pill"
          v-model="movement.payment_type_id"
        >
          <option v-for="pt in paymentTypes" :key="pt.id" :value="pt.id">
            {{ pt.description }}
          </option>
        </select>
      </div>
    </new-movement-vue>
  </form>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Responsive Hover Table</h3>

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
            <th>Usuario</th>
            <th>Monto</th>
            <th>Tipo</th>
            <th>Observación</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="movement in movements" :key="movement.id">
            <td>{{ movement.date }}</td>
            <td>{{ movement.user }}</td>
            <td>{{ movement.amount }}</td>
            <td>{{ movement.type }}</td>
            <td>
              {{ movement.observation }}
            </td>
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
                  <a class="dropdown-item" href="#"
                    ><i class="col-1 mr-3 fas fa-edit"></i>
                    Editar
                  </a>
                  <a
                    class="dropdown-item"
                    href="#"
                    @click="deleteMovement(movement.id)"
                  >
                    <i class="col-1 mr-3 fas fa-trash"></i>
                    Eliminar
                  </a>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
import NewMovementVue from "../../components/NewMovement.vue";

export default {
  components: { BaseUrl, NewMovementVue },
  data() {
    return {
      movement: {
        type: "EGRESO",
        payment_type_id: 1,
      },
      movements: [],
      paymentTypes: [],
      errors: [],
    };
  },
  created() {
    this.showMovements();
    this.getPaymentTypes();
  },
  methods: {
    async showMovements() {
      await BaseUrl.get("api/egresos-ingresos")
        .then((response) => {
          this.movements = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async createMovement() {
      await BaseUrl.post("/api/egresos-ingresos", this.movement)
        .then((response) => {
          this.showMovements();
          this.errors = [];
          this.movement = { type: "EGRESO", payment_type_id: 1 };
          $("#new-movement").modal("hide");

          console.log(response.data);

          Swal.fire("Registrado!", response.data.message, "success");
        })
        .catch((error) => {
          error.response.data.errors != undefined
            ? (this.errors = error.response.data.errors)
            : console.log(error.response);
        });
    },
    async deleteMovement(id) {
      Swal.fire({
        title: "Estas seguro que desea eliminar este movimiento?",
        text: "Esta accion no puede ser revertida!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#343a40",
        cancelButtonColor: "#ee1919",
        confirmButtonText: "Si, Borralo!",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`/api/egresos-ingresos/` + id)
            .then((response) => {
              console.log(response.data);
              Swal.fire("Deleted!", "Su movimiento fue eliminado.", "success");
              this.showMovements();
            })
            .catch((error) => {
              console.log(error.response.data);
            });
        }
      });
    },

    async getPaymentTypes() {
      await BaseUrl.get(`/api/payment-types`)
        .then((response) => {
          this.paymentTypes = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>

<style>
</style>
