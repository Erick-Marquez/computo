<template>
  <div class="modal fade" id="new-customer" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Cliente</h4>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">×</span>
          </button>
        </div>

        <div class="modal-body">
          <div class="form-group">
            <label for="">
              <span class="text-danger">
                <i class="far fa-address-card"></i>
              </span>
              Tipo de documento</label
            >
            <select
              :class="$errorsClassSquare(errors['identification_document_id'])"
              v-model="customer.identification_document_id"
            >
              <option
                v-for="type_document in type_documents"
                :key="type_document.id"
                :value="type_document.id"
              >
                {{ type_document.description }}
              </option>
            </select>
            <div
              v-if="$errorsExists(errors['identification_document_id'])"
              class="invalid-feedback"
            >
              {{ $errorsPrint(errors["identification_document_id"]) }}
            </div>
          </div>

          <!-- NUMERO DE DOCUMENTO -->
          <div class="form-group">
            <label for="">
              <span class="text-danger">
                <i class="fab fa-slack-hash"></i>
              </span>
              N° documento
            </label>

            <div
              v-if="
                customer.identification_document_id == 1 ||
                customer.identification_document_id == 6
              "
              class="input-group"
            >
              <input
                type="text"
                :class="$errorsClassSquare(errors['document'])"
                v-model="customer.document"
                :maxlength="maxLenghDocument"
              />
              <div v-if="!loading" class="input-group-append">
                <button class="btn btn-dark" @click="getDataApi()">
                  <i class="fas fa-search"></i>
                </button>
              </div>

              <div v-else class="input-group-append">
                <button class="btn btn-dark">
                  <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </button>
              </div>

              <div
                v-if="$errorsExists(errors['document'])"
                class="invalid-feedback"
              >
                {{ $errorsPrint(errors["document"]) }}
              </div>
            </div>
            <input
              v-else
              type="text"
              :class="$errorsClassSquare(errors['document'])"
            />
            <div
              v-if="$errorsExists(errors['document'])"
              class="invalid-feedback"
            >
              {{ $errorsPrint(errors["document"]) }}
            </div>
          </div>

          <!-- NOMBRE -->
          <div class="form-group">
            <label for="">
              <span class="text-danger">
                <i class="fas fa-signature"></i>
              </span>
              Nombre
            </label>
            <input
              type="text"
              :class="$errorsClassSquare(errors['name'])"
              v-model="customer.name"
            />
            <div v-if="$errorsExists(errors['name'])" class="invalid-feedback">
              {{ $errorsPrint(errors["name"]) }}
            </div>
          </div>

          <!-- UBIGEO -->
          {{ customer.ubigee_id }}
          <div class="form-group">
            <label for="">
              <span class="text-danger">
                <i class="fas fa-map-marker-alt"></i>
              </span>
              Ubigeo
            </label>

            <v-select
              v-model="customer.ubigee_id"
              label="place_description"
              :reduce="(ubigee) => ubigee.id"
              :options="ubigees"
            >
              <template v-slot:no-options="{ search, searching }">
                <template v-if="searching">
                  No se encontraron resultados para
                  <b
                    ><em>{{ search }}</em></b
                  >.
                </template>
              </template>
            </v-select>

          </div>

          <!-- DIRECCION -->
          <div class="form-group">
            <label for="">
              <span class="text-danger">
                <i class="fas fa-map-marker-alt"></i>
              </span>
              Dirección
            </label>
            <input
              type="text"
              name=""
              id=""
              :class="$errorsClassSquare(errors['address'])"
              v-model="customer.address"
              autocomplete="nop"
            />
            <div
              v-if="$errorsExists(errors['address'])"
              class="invalid-feedback"
            >
              {{ $errorsPrint(errors["address"]) }}
            </div>
          </div>

          <!-- TELEFONO -->
          <div class="form-group">
            <label for="">
              <span class="text-danger">
                <i class="fas fa-phone"></i>
              </span>
              Telefono
            </label>
            <input
              type="text"
              name=""
              id=""
              :class="$errorsClassSquare(errors['phone'])"
              v-model.trim="customer.phone"
              autocomplete="nop"
            />
            <div v-if="$errorsExists(errors['phone'])" class="invalid-feedback">
              {{ $errorsPrint(errors["phone"]) }}
            </div>
          </div>

          <!-- EMAIL -->
          <div class="form-group">
            <label for="">
              <span class="text-danger">
                <i class="fas fa-at"></i>
              </span>
              Email
            </label>
            <input
              type="email"
              name=""
              id=""
              :class="$errorsClassSquare(errors['email'])"
              v-model.trim="customer.email"
            />
            <div v-if="$errorsExists(errors['email'])" class="invalid-feedback">
              {{ $errorsPrint(errors["email"]) }}
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";

export default {
  data() {
    return {
      type_documents: {},
      max_length: 8,
      loading: false,
      ubigees: [],
    };
  },
  props: {
    customer: Object,
    errors: Object,
  },
  created() {
    this.getTypeDocuments();
  },
  mounted() {
    this.getUbigees();
  },
  methods: {
    async getTypeDocuments() {
      await BaseUrl.get(`/api/tipos-documentos`)
        .then((response) => {
          this.type_documents = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    async getUbigees() {
      await BaseUrl.get(`/api/ubigees`)
        .then((response) => {
          this.ubigees = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },

    async getDataApi() {
      this.loading = true;
      await BaseUrl.get(
        `/api/data-document/${this.customer.identification_document_id}/${this.customer.document}`
      )
        .then((response) => {
          console.log(response.data);
          this.customer.address = response.data.address;
          this.customer.name = response.data.name;
          this.customer.ubigee_id = response.data.ubigee;
        })
        .catch((error) => {
          console.log(error.response);
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
  computed: {
    maxLenghDocument() {
      return this.customer.identification_document_id == 1 ? 8 : 11;
    },
    // enableSearchDocument() {
    //   return true
    // },
  },
};
</script>

<style scoped>
</style>
