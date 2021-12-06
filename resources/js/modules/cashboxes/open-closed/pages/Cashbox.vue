<template>
  <div class="container-fluid">
    <!-- BOTON PARA CREAR CAJA -->
    <button
      class="btn btn-lg btn-block btn-dark my-2"
      @click="showModal('#modal-create')"
      v-if="$can('cashbox.create')"
    >
      <span><i class="fas fa-plus"></i></span>
      Agregar Nueva caja
    </button>

    <div class="row">
      <div
        class="col-md-3 col-sm-6 col-12"
        v-for="cashbox in cashboxes"
        :key="cashbox.id"
      >
        <div
          :class="[
            cashbox.state
              ? 'small-box bg-light border border-info'
              : 'small-box bg-light border border-danger',
          ]"
        >
          <div class="btn-group float-right">
            <button
              type="button"
              :class="[
                cashbox.state
                  ? 'btn btn-light btn-sm dropdown-toggle'
                  : 'btn btn-light btn-sm dropdown-toggle',
              ]"
              data-toggle="dropdown"
              data-offset="-52"
              aria-expanded="false"
            >
              <i class="fas fa-bars"></i>
            </button>
            <div class="dropdown-menu" role="menu" style="">
              <a
                href="#"
                data-toggle="modal"
                data-target="#modal-edit"
                @click="editCashbox(cashbox)"
                class="dropdown-item"
                >Editar</a
              >
              <div class="dropdown-divider"></div>
              <a
                @click="deleteCashbox(cashbox.id)"
                href="#"
                class="dropdown-item"
                >Eliminar</a
              >
            </div>
          </div>
          <div class="inner">
            <h3>{{ cashbox.description }}</h3>
            <div class="info-contenido">
              <p v-if="cashbox.state">Estado: Aperturado</p>
              <p v-else>Estado: Sin Aperturar</p>
              <p>Balance: S/. {{ cashbox.balance }}</p>
            </div>
          </div>
          <div class="icon">
            <i class="fas fa-cash-register"></i>
          </div>
          <router-link
            v-if="cashbox.state"
            :to="{ name: 'show-cashbox', params: { id: cashbox.id } }"
            class="border border-info bg-info small-box-footer"
          >
            <span class="text-white">
              Ver Caja
              <i class="fas fa-arrow-circle-right"></i>
            </span>
          </router-link>
          <a
            v-else
            href="#"
            class="bg-danger small-box-footer"
            @click="showModal('#open-cashbox', cashbox)"
          >
            <span class="text-white">
              Aperturar Caja
              <i class="fas fa-door-open"></i>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- MODALES -->
  <div class="modal fade" id="modal-create" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear nueva Caja</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="createCashbox()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre de la caja</label>
              <input
                id="description"
                type="text"
                class="form-control"
                v-model="caja.description"
                required
              />
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button
              type="button"
              class="btn btn-outline-danger"
              data-dismiss="modal"
            >
              Cerrar
            </button>
            <button type="submit" class="btn btn-dark">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL ACTUALIZAR CAJA -->
  <div class="modal fade" id="modal-edit" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Editar Caja</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="updateCashbox">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Nombre de la caja</label>
              <input
                id="description"
                type="text"
                class="form-control"
                v-model="cashbox.description"
                required
              />
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button
              type="button"
              class="btn btn-outline-danger"
              data-dismiss="modal"
            >
              Cerrar
            </button>
            <button type="submit" class="btn btn-dark">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL PARA APERTURAR CAJA -->
  <div class="modal fade" id="open-cashbox" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Aperturar {{ cashbox.description }}</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form @submit.prevent="openCashbox()">
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Monto de apertura:</label>
              <input
                id="description"
                type="number"
                step="0.0001"
                class="form-control"
                v-model="cashbox.opening_amount"
                required
              />
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button
              type="button"
              class="btn btn-outline-danger"
              data-dismiss="modal"
            >
              Cerrar
            </button>
            <button type="submit" class="btn btn-dark">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";
export default {
  components: { BaseUrl },
  data() {
    return {
      caja: {
        description: "",
      },
      cashboxes: [],
      cashbox: {
        id: null,
        description: "",
      },
    };
  },
  created() {
    this.showCashboxes();
  },
  methods: {
    async showCashboxes() {
      await BaseUrl.get("/api/cajas")
        .then((response) => {
          this.cashboxes = response.data.data; // resource creado por laravel
          console.log(this.cashboxes);
        })
        .catch((error) => {
          this.cashboxes = [];
        });
    },
    async createCashbox() {
      await BaseUrl.post("/api/cajas", this.caja)
        .then((response) => {
          $("#modal-create").modal("hide");
          this.showCashboxes();
          this.caja = {};
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    async deleteCashbox(id) {
      await Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          BaseUrl.delete(`/api/cajas/${id}`)
            .then((response) => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              this.showCashboxes();
            })
            .catch((error) => {
              Swal.fire({
                icon: "error",
                title: "Oops...",
                text: error.response.data.error,
              });
            });
        }
      });
    },
    async openCashbox() {
      await BaseUrl.post("/api/cashbox/open", this.cashbox)
        .then((response) => {
          $("#open-cashbox").modal("hide");
          console.log(response.data);
          this.showCashboxes();
        })
        .catch((error) => {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: error.response.data.message,
            //footer: '<a class="btn btn-danger" href="youtube.com">Llevame a mi caja!!!</a>',
          });
          $("#open-cashbox").modal("hide");

          console.log(error.response.data);
        });
    },
    editCashbox(cashbox) {
      this.cashbox = cashbox;
    },
    async updateCashbox() {
      BaseUrl.put(`/api/cajas/${this.cashbox.id}`, this.cashbox)
        .then((response) => {
          console.log(response.data);
          this.showCashboxes();
          $("#modal-edit").modal("hide");
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    showModal(modal, cashbox = null) {
      if (cashbox !== null) {
        this.cashbox = cashbox;

        this.cashbox.opening_amount = 0;
      }
      $(modal).modal("show");
    },
  },
};
</script>

<style scoped>
.info-contenido {
  margin-top: 1em;
  line-height: 0.5;
  font-weight: 300;
}

.bg-info.small-box-footer {
  color: #f2f2f2;
  border: 1px solid #17a2b8;
}
</style>
