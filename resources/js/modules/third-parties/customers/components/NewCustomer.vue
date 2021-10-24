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
            <label for="">Tipo de documento</label>
            <select
              class="form-control"
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
          </div>

          <div class="form-group">
            <label for="">N° documento</label>

            <div
              v-if="
                customer.identification_document_id == 1 ||
                customer.identification_document_id == 6
              "
              class="input-group"
            >
              <input
                type="text"
                class="form-control"
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
            </div>
            <input v-else type="text" class="form-control"/>

          </div>

          <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" class="form-control" v-model="customer.name" />
          </div>

          <div class="form-group">
            <label for="">Telefono</label>
            <input
              type="text"
              name=""
              id=""
              class="form-control"
              v-model="customer.phone"
            />
          </div>

          <div class="form-group">
            <label for="">Email</label>
            <input
              type="email"
              name=""
              id=""
              class="form-control"
              v-model="customer.email"
            />
          </div>

          <div class="form-group">
            <label for="">Dirección</label>
            <input
              type="text"
              name=""
              id=""
              class="form-control"
              v-model="customer.address"
            />
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
    };
  },
  props: {
    customer: Object,
  },
  created() {
    this.getTypeDocuments();
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
    async getDataApi() {
      this.loading = true;
      await BaseUrl.get(
        `/api/data-document/${this.customer.identification_document_id}/${this.customer.document}`
      )
        .then((response) => {
          console.log(response.data);
          this.customer.address = response.data.address;
          this.customer.name = response.data.name;
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
