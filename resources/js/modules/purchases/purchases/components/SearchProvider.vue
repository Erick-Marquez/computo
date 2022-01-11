<template>
  <h4 class="mb-3">Datos del proveedor</h4>
  <div class="row">
    <!-- TIPO DOCUMENTO -->
    <div class="col-md-3">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fas fa-address-card"></i>
          Tipo documento
        </label>
        <select
          v-if="voucherType == 'FACTURA' || voucherType == '01'"
          v-model="provider.identification_document_id"
          class="form-control rounded-pill"
        >
          <option value="6">RUC</option>
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
          N° Documento
          <span v-show="responseApi" :class="responseApiClass">
            | {{ responseApi }}
          </span>
        </label>
        <div v-if="showSearchingData" class="input-group">
          <input
            type="number"
            :class="[
              $errorsClassSquare(errors['provider.document']),
              'rounded-pill-left',
            ]"
            v-model="provider.document"
            :maxlength="maxLenghDocument"
            @keyup="searchDocument"
            @blur="toggle = false"
            @focus="toggle = true"
            autocomplete="nop"
          />
          <div v-if="!loading" class="input-group-append">
            <button
              class="btn btn-dark rounded-pill-right"
              @click.prevent="getDataApi"
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

          <div
            v-if="$errorsExists(errors['provider.document'])"
            class="invalid-feedback ml-3"
          >
            {{ $errorsPrint(errors["provider.document"]) }}
          </div>
        </div>

        <input
          v-else
          type="text"
          :class="[
            $errorsClassSquare(errors['provider.document']),
            'rounded-pill-left',
          ]"
          @keyup="searchDocument"
          @blur="toggle = false"
          @focus="toggle = true"
          autocomplete="nop"
        />

        <div
          v-if="$errorsExists(errors['provider.document'])"
          class="invalid-feedback ml-3"
        >
          {{ $errorsPrint(errors["provider.document"]) }}
        </div>

        <!-- Autocomplete -->
        <div v-show="toggle" class="autocomplete mt-0">
          <ul class="list">
            <li
              v-show="providers"
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
    <div class="col-md-5">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-id-badge"></i>
          Nombre/Razón Social:
        </label>
        <input
          v-model="provider.name"
          type="text"
          :class="$errorsClass(errors['provider.name'])"
        />
        <div
          v-if="$errorsExists(errors['provider.name'])"
          class="invalid-feedback ml-3"
        >
          {{ $errorsPrint(errors["provider.name"]) }}
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <!-- DIRECCIÓN -->
    <div class="col-md-6">
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
        <v-select
          class="style-chooser"
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
    </div>

    <!-- N° CELULAR -->
    <div class="col-md-2">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-phone"></i>
          N° Celular</label
        >
        <input
          class="form-control rounded-pill"
          type="text"
          v-model="provider.phone"
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
      ubigees: [],
      max_length: 8,
      loading: false,
      responseApi: null,
    };
  },
  props: {
    provider: Object,
    voucherType: String,
    errors: Object,
  },
  watch: {
    voucherType: function(newVal, oldVal) {
        this.provider.identification_document_id = 6
    }
  },
  created() {
    this.getTypeDocuments();
    this.getUbigees();
  },
  mounted() {},
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
          this.provider.phone = "";
          this.provider.address = "";
          this.provider.name = response.data.name;
          this.provider.address = response.data.address;
          this.provider.phone = response.data.phone;
          this.provider.ubigee_id =
            response.data.ubigee != null
              ? this.getUbigeeProvider(response.data.ubigee)
              : null;

          this.responseApi = "HABIDO";
        })
        .catch((error) => {
          this.responseApi = "NO HABIDO";
        })
        .finally(() => {
          this.loading = false;
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
    async getUbigeeProvider(cod) {
      await BaseUrl.get(`/api/ubigees?filter[cod]=${cod}`)
        .then((response) => {
          this.provider.ubigee_id = response.data.data[0].id;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    async getproviders() {
      await BaseUrl.get(
        `/api/providers?included=ubigee&filter[document]=${this.provider.document}
                            &filter[identification_document_id]=${this.provider.identification_document_id}
                            &perPage=10`
      )
        .then((response) => {
          this.providers = response.data.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    setData(providerFind) {
      this.provider.document = providerFind.document;
      this.provider.name = providerFind.name;
      this.provider.address = providerFind.address;
      this.provider.phone = providerFind.phone;
      this.provider.ubigee_id =
        providerFind.ubigee != null ? providerFind.ubigee.id : null;
      this.providers = null;
    },
    searchDocument() {
      clearTimeout(this.searching);
      this.searching = setTimeout(this.getproviders, 300);
    },

    selectUbigee(codUbigee) {
      const ubigee = this.ubigees.filter((ubigee) => {
        ubigee.cod == codUbigee;
      });
      return ubigee.id;
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
    responseApiClass() {
      return this.responseApi === "NO HABIDO"
        ? "text-sm font-weight-light text-danger"
        : "text-sm font-weight-light text-success";
    },
    // enableSearchDocument() {
    //   return true
    // },
  },
};
</script>

<style>
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

.style-chooser .vs__dropdown-toggle {
  border-radius: 50px;
  width: 100%;
  height: calc(2.25rem + 2px);
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border-color: #ced4da;
  box-shadow: inset 0 0 0 transparent;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.style-chooser .vs__clear,
.style-chooser .vs__open-indicator {
  fill: #394066;
}
</style>
