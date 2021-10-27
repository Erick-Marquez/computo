<template>
  <h4>Datos del proveedor</h4>
  <div class="row">
    <!-- TIPO DOCUMENTO -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fas fa-address-card"></i>
          Tipo documento
        </label>
        <select
          v-if="voucherType == '01'"
          v-model="provider.identification_document_id"
          class="form-control rounded-pill"
        >
          <option value="6" >RUC</option>
        </select>
        <select
          v-else
          v-model="provider.identification_document_id"
          class="form-control rounded-pill"
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
    </div>

    <!-- N° DOCUMENTO -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fas fa-pen"></i>
          N° Documento</label
        >
        <div v-if="showSearchingData" class="input-group">
          <input
            type="text"
            class="form-control rounded-pill-left"
            v-model="provider.document"
            :maxlength="maxLenghDocument"
            @keyup="searchDocument"
            @blur="toggle = false"
            @focus="toggle = true"
          />
          <div v-if="!loading" class="input-group-append">
            <button
              class="btn btn-dark rounded-pill-right"
              @click="getDataApi"
            >
              <i class="fas fa-search"></i>
            </button>
          </div>

          <div v-else class="input-group-append">
            <button class="btn btn-dark rounded-pill-right">
              <div class="spinner-border spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </button>
          </div>
        </div>

        <input
          v-else
          type="text"
          class="form-control rounded-pill"
          @keyup="searchDocument"
          @blur="toggle = false"
          @focus="toggle = true"
        />

        <!-- Autocomplete -->
        <div v-show="toggle" class="autocomplete mt-0">
          <ul class="list">
            <li
              class="item"
              @click="setData(providerFind)"
              v-for="providerFind in providers"
              :key="providerFind.id"
              @mousedown.prevent
            >
              {{ providerFind.document }} - {{ providerFind.name }}
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- NOMBRE/RAZON SOCIAL -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-id-badge"></i>
          Nombre/Razón Social:</label
        >
        <input
          v-model="provider.name"
          type="text"
          class="form-control rounded-pill"
        />
      </div>
    </div>
  </div>

  <div class="row">
    <!-- DIRECCIÓN -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-map-marker-alt"></i>
          Dirección</label
        >
        <input
          v-model="provider.address"
          type="text"
          class="form-control rounded-pill"
          name=""
          id=""
        />
      </div>
    </div>

    <!-- UBIGEO -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-globe"></i>
          Ubigeo</label
        >
        <select name="" id="" class="form-control rounded-pill">
          <option value="">Opcion1</option>
          <option value="">Opcion2</option>
        </select>
      </div>
    </div>

    <!-- N° CELULAR -->
    <div class="col-md-4">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-phone"></i>
          N° Celular</label
        >
        <input
          v-model="provider.phone"
          type="text"
          class="form-control rounded-pill"
          name=""
          id=""
        />
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
      toggle: false,
      providers: [],
      type_documents: [],
      searching: {},
      max_length: 8,
      loading: false,
    };
  },
  props: {
    provider: Object,
    voucherType: String,
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
        `/api/data-document/${this.provider.identification_document_id}/${this.provider.document}`
      )
        .then((response) => {
          console.log(response.data);
          this.provider.phone = "";
          this.provider.address = "";
          this.provider.address = response.data.address;
          this.provider.name = response.data.name;
          this.provider.address = response.data.address;
          this.provider.phone = response.data.phone;
        })
        .catch((error) => {
          console.log(error.response);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    async getproviders() {
      await BaseUrl.get(
        `/api/proveedores?filter[document]=${this.provider.document}
                            &filter[identification_document_id]=${this.provider.identification_document_id}
                            &perPage=10`
      )
        .then((response) => {
          this.providers = response.data.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    setData(providerFind) {
      this.provider.document = providerFind.document;
      this.provider.name = providerFind.name;
      this.provider.address = providerFind.address;
      this.provider.phone = providerFind.phone;
      this.providers = {};
    },
    searchDocument() {
      clearTimeout(this.searching);
      this.searching = setTimeout(this.getproviders, 200);
    },
  },
  computed: {
    maxLenghDocument() {
      return this.provider.identification_document_id == 1 ? 8 : 11;
    },
    showSearchingData() {
      return this.provider.identification_document_id == 6 ||
        this.provider.identification_document_id == 1
        ? true
        : false;
    },
    // enableSearchDocument() {
    //   return true
    // },
  },
};
</script>

<style scoped>
.autocomplete {
  position: relative;
  cursor: pointer;
}

.list {
  position: absolute;
  background: #fff;
  width: 100%;
  padding: 0;
  z-index: 1000;
}

.item {
  border-bottom: 0.1rem solid rgb(180, 180, 180);
  border-left: 0.1rem solid rgb(180, 180, 180);
  border-right: 0.1rem solid rgb(180, 180, 180);
  margin: 0;
  padding: 0.5em 1em;
  text-decoration: none;
  list-style: none;
}

.item:hover {
  background: #f2f2f2;
}

.rounded-pill-left {
  border-top-left-radius: 50px;
  border-bottom-left-radius: 50px;
}

.rounded-pill-right {
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
}
</style>
