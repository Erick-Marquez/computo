<template>
  <form @submit.prevent="saveCompany()" @submit="checkForm">
    <div class="row text-center justify-content-md-center align-items-center">
      <div class="col col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 class="text-muted">Empresa</h5>
            <h3>{{ company.name == "" ? "Demo Computo" : company.name }}</h3>
          </div>
        </div>
      </div>

      <div class="col col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 class="text-muted">Modo</h5>
            <h3>{{ company.demo == true ? "Pruebas" : "Producción" }}</h3>
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
      <div class="col col-lg-9">
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <h4>Datos empresa generales</h4>
            </div>
            <div class="card-tools">
              <div class="custom-control custom-checkbox">
                <input
                  class="custom-control-input custom-control-input-danger"
                  type="checkbox"
                  id="managerSeriesCheckbox"
                  v-model="company.demo"
                />
                <label for="managerSeriesCheckbox" class="custom-control-label"
                  >¿Es demo?</label
                >
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-user"></i>
                    RUC
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.ruc"
                    required
                  />
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-briefcase"></i>
                    Razon Social
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.name"
                    required
                  />
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
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.comercial_name"
                  />
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-phone"></i>
                    Teléfono
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.phone"
                  />
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-at"></i>
                    Email
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.email"
                  />
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
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.ubigeo"
                    required
                  />
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-building"></i>
                    Urbanización
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.urbanization"
                    required
                  />
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-address-book"></i>
                    Direccion Fiscal
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.address"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="row d-flex justify-content-center">
              <logo-upload v-on:uploadImage="uploadImage"></logo-upload>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div v-if="!company.demo" class="row justify-content-md-center">
      <div class="col col-lg-9">
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
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.user_sol"
                    required
                  />
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-lock"></i>
                    Contraseña Sol
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.password_sol"
                    required
                  />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md">
                <div class="form-group">
                  <label for="electronic-certificate">
                    <i class="text-danger fas fa-file-contract"></i>
                    Certificado electronico
                  </label>
                  <div class="et-input-left-group">
                    <input
                      class="et-input"
                      type="text"
                      placeholder="Ningun archivo seleccionado"
                      v-model="filename"
                      readonly
                    />
                    <button
                      class="et-group-text et-button"
                      @click="triggerInputFile"
                    >
                      Seleccionar archivo
                    </button>
                    <input
                      class="et-input file__electronic-certificate"
                      type="file"
                      id="electronic-certificate"
                      @change="uploadFile($event)"
                    />
                  </div>
                </div>
              </div>
              <div class="col-md">
                <div class="form-group">
                  <label for="">
                    <i class="text-danger fas fa-lock"></i>
                    Contraseña Certificado
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="company.password_electronic_certificate"
                    required
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row justify-content-md-center">
      <div class="col col-lg-9">
        <input
          type="submit"
          class="btn btn-dark btn-block btn-lg mb-4"
          value="Guardar Configuración"
        />
      </div>
    </div>
  </form>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl.js";
import LogoUpload from "../components/LogoUpload.vue";
export default {
  components: { BaseUrl, LogoUpload },
  created() {
    this.showCompany();
  },
  data() {
    return {
      filename: "",

      company: {
        ruc: "",
        name: "",
        comercial_name: "",
        phone: "",
        email: "",
        ubigeo: "",
        urbanization: "",
        address: "",
        user_sol: "",
        password_sol: "",
        electronic_certificate: "",
        password_electronic_certificate: "",
        demo: true,
        img: null,
      },
    };
  },
  methods: {
    async showCompany() {
      await BaseUrl.get(`api/company`).then((resp) => {
        this.company = resp.data;
        this.company.demo = Boolean(resp.data.demo);
      });
    },

    triggerInputFile() {
      document.getElementById("electronic-certificate").click();
    },
    uploadFile(e) {
      if (e.target.value == "") {
        return (this.filename = "");
      } else {
        return (this.filename = e.target.files[0].name);
      }
    },

    saveCompany() {
      const company = {
        ruc: this.company.ruc,
        name: this.company.name,
        comercial_name: this.company.comercial_name,
        phone: this.company.phone,
        email: this.company.email,
        ubigeo: this.company.ubigeo,
        urbanization: this.company.urbanization,
        address: this.company.address,
        demo: this.company.demo,
        img: this.company.img,
      };
      if (!this.company.demo) {
        company.user_sol = this.company.user_sol;
        company.password_sol = this.company.password_sol;
        company.electronic_certificate = this.company.electronic_certificate;
        company.password_electronic_certificate =
          this.company.password_electronic_certificate;
      }

      console.log(company);

      BaseUrl.put(`api/company/${this.company.id}`, company)
        .then((resp) => {
          console.log(resp);

          Swal.fire(
            "Actualizado",
            "El Configuración ha sido actualizada",
            "success"
          );
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    uploadImage(datos) {
      this.company.img = datos;
    },
  },
};
</script>

<style>
/* Input group */
.et-input-left-group {
  display: grid;
  align-items: center;
  grid-template-columns: auto max-content;
}
.et-input-left-group .et-input {
  /* width: 100%; */
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
}
.et-input {
  width: 100%;
  border: 1px solid #ced4da;
  border-radius: 4px;
  outline: none;
  padding: 0 0.5rem;
  height: 2.4rem;
  color: #4f4f4f;
}
.et-input:focus {
  border: 1px solid #cccccc;
}
.et-group-text {
  padding: 0 0.5rem;
  height: 2.4rem;
  display: inline;
  margin-left: -1px;
  background-color: #e9ecef;
  border: 1px solid #ced4da !important;
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
/* Boton */
.et-button {
  color: #4f4f4f;
  border: 1px solid transparent;
  border-radius: 0.25rem;
  opacity: 0.8;
}
.et-button:hover {
  opacity: 1;
}
.et-button:disabled {
  opacity: 0.7;
}
.file__electronic-certificate {
  display: none;
}
</style>
