<template>
  <h4 class="mb-3">Datos del Cliente</h4>
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
          v-model="customer.identification_document_id"
          class="form-control rounded-pill"
        >
          <option value="6">RUC</option>
        </select>
        <select
          v-else
          v-model="customer.identification_document_id"
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
          N° Documento <span v-show="responseApi" :class="responseApiClass"> | {{ responseApi }} </span>
        </label>
        <div v-if="showSearchingData" class="input-group">
          <input
            type="text"
            class="form-control rounded-pill-left"
            v-model="customer.document"
            :maxlength="maxLenghDocument"
            @keyup="searchDocument"
            @blur="toggle = false"
            @focus="toggle = true"
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
              @click="setData(customerFind)"
              v-for="customerFind in customers"
              :key="customerFind.id"
              @mousedown.prevent
            >
              {{ customerFind.document }} - {{ customerFind.name }}
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
          Nombre/Razón Social:</label
        >
        <input
          v-model="customer.name"
          type="text"
          class="form-control rounded-pill"
        />
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
          v-model="customer.address"
          type="text"
          class="form-control rounded-pill"
          name=""
          id=""
        />
      </div>
    </div>

    <!-- UBIGEO -->
    <div class="col-md-3">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-globe"></i>
          Ubigeo</label
        >
        <select v-model="customer.ubigee"  class="form-control rounded-pill" name="">
            <option v-for="ubigee in ubigees" :key="ubigee.id" :value="ubigee.cod">{{ ubigee.place_description }}</option>
        </select>
      </div>
    </div>

    <!-- N° CELULAR -->
    <div class="col-md-3">
      <div class="form-group">
        <label for="">
          <i class="text-danger fas fa-phone"></i>
          N° Celular</label
        >
        <input
          v-model="customer.phone"
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
  components: { BaseUrl},
  data() {
    return {
      toggle: false,
      customers: [],
      type_documents: [],
      searching: {},
      ubigees: [],
      max_length: 8,
      loading: false,
      responseApi: null,
    };
  },
  props: {
    customer: Object,
    voucherType: String,
  },
  created() {
    this.getTypeDocuments();
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
    async getDataApi() {
      this.loading = true;
      await BaseUrl.get(
        `/api/data-document/${this.customer.identification_document_id}/${this.customer.document}`
      )
        .then((response) => {
          console.log(response.data);
          this.customer.phone = "";
          this.customer.address = "";
          this.customer.id = null;
          this.customer.name = response.data.name;
          this.customer.address = response.data.address;
          this.customer.phone = response.data.phone;
          this.customer.ubigee = response.data.ubigee;
          this.responseApi = "HABIDO";
        })
        .catch((error) => {
          console.log(error.response);
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
    async getcustomers() {
      await BaseUrl.get(
        `/api/clientes?filter[document]=${this.customer.document}
                            &filter[identification_document_id]=${this.customer.identification_document_id}
                            &perPage=10`
      )
        .then((response) => {
          this.customers = response.data.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    setData(customerFind) {
      this.customer.id = customerFind.id;
      this.customer.document = customerFind.document;
      this.customer.name = customerFind.name;
      this.customer.address = customerFind.address;
      this.customer.phone = customerFind.phone;
      this.customer.ubigee = response.data.ubigee;
      this.customers = {};
    },
    searchDocument() {
      clearTimeout(this.searching);
      this.searching = setTimeout(this.getcustomers, 300);
    },
  },
  computed: {
    maxLenghDocument() {
      return this.customer.identification_document_id == 1 ? 8 : 11;
    },
    showSearchingData() {
      return this.customer.identification_document_id == 6 ||
        this.customer.identification_document_id == 1
        ? true
        : false;
    },
    responseApiClass() {
        return this.responseApi == 'NO HABIDO' ? "text-sm font-weight-light text-danger" : "text-sm font-weight-light text-success"
    }
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
