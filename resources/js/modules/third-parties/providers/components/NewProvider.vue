<template>
  <div class="modal fade" id="new-provider" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Registrar Proveedor</h4>
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
            <label for="">Tipo de documento</label>
            <select
              :class="$errorsClassSquare(errors['identification_document_id'])"
              class="form-control"
              v-model="provider.identification_document_id"
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
              {{ $errorsPrint(errors['identification_document_id']) }}
            </div>
          </div>

          <div class="form-group">
            <label for="">N° documento</label>

            <div
              v-if="
                provider.identification_document_id == 1 ||
                provider.identification_document_id == 6
              "
              class="input-group"
            >
              <input
                type="text"
                :class="$errorsClassSquare(errors['document'])"
                v-model="provider.document"
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
            </div>

            <input
              v-else
              v-model="provider.document"
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

          <div class="form-group">
            <label for="">Nombre</label>
            <input
              type="text"
              :class="$errorsClassSquare(errors['name'])"
              v-model="provider.name"
            />
            <div v-if="$errorsExists(errors['name'])" class="invalid-feedback">
              {{ $errorsPrint(errors["name"]) }}
            </div>
          </div>

          <div class="form-group">
            <label for="">Nombre Comercial</label>
            <input
              type="text"
              :class="$errorsClassSquare(errors['tradename'])"
              v-model="provider.tradename"
            />
            <div v-if="$errorsExists(errors['tradename'])" class="invalid-feedback">
              {{ $errorsPrint(errors["tradename"]) }}
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
              :class="$errorsClassSquare(errors['phone'])"
              v-model.trim="provider.phone"
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
              :class="$errorsClassSquare(errors['email'])"
              v-model.trim="provider.email"
            />
            <div v-if="$errorsExists(errors['email'])" class="invalid-feedback">
              {{ $errorsPrint(errors["email"]) }}
            </div>
          </div>

          <div class="form-group">
            <label for="">Ubigeo</label>
            <v-select
              v-model="provider.ubigee_id"
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
              v-model="provider.address"
              autocomplete="nop"
            />
            <div
              v-if="$errorsExists(errors['address'])"
              class="invalid-feedback"
            >
              {{ $errorsPrint(errors["address"]) }}
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
    provider: Object,
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
        `/api/data-document/${this.provider.identification_document_id}/${this.provider.document}`
      )
        .then((response) => {
          console.log(response.data);
          this.provider.address = response.data.address;
          this.provider.name = response.data.name;
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
      return this.provider.identification_document_id == 1 ? 8 : 11;
    },
    // enableSearchDocument() {
    //   return true
    // },
  },
};
</script>

<style scoped>
</style>
