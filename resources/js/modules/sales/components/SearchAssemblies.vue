<template>
  <!-- COMPONENTE PARA BUSCAR Ensamblajes -->

  <input
    type="search"
    class="form-control rounded-pill form-control rounded-pill-lg"
    placeholder="Escribe el nombre de tu configuración o código"
    v-model="assemblyName"
    @keyup="searchAssembly"
    @blur="toggle = false"
    @focus="toggle = true"
  />

  <!-- AUTOCOMPLETE -->
  <div class="autocomplete mt-0" v-show="toggle">
    <table
      class="table table-hover table-bordered list"
      v-show="assembliesFound.length"
    >
      <thead class="bg-danger">
        <tr>
          <th class="w-25">cod</th>
          <th class="w-50">Nombre</th>
          <th class="w-25">Descripcion</th>
        </tr>
      </thead>
      <tbody>
        <tr
          class="item"
          v-for="assembly in assembliesFound"
          :key="assembly.id"
          @click="setProducts(assembly.products)"
          @mousedown.prevent
          tabindex="0"
        >
          <td>{{ assembly.cod }}</td>
          <td>{{ assembly.name }}</td>
          <td>{{ assembly.description }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import BaseUrl from "../../../api/BaseUrl";
export default {
  data() {
    return {
      toggle: false,
      loading: false,
      max_length: 8,
      assemblyName: null,
      searching: [],
      assembliesFound: [],
    };
  },
  emits: ["setAssemblie"],
  props: {
    products: Object,
  },
  methods: {
    async getAssemblies() {
      await BaseUrl.get(
        `/api/assemblies?included=products&filter[name]=${this.assemblyName}&perPage=10`
      )
        .then((response) => {
          this.assembliesFound = response.data.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    // metodo para buscar Ensamblajes
    searchAssembly() {
      clearTimeout(this.searching);
      if (this.assemblyName !== "") {
        clearTimeout(this.searching);
        this.searching = setTimeout(this.getAssemblies, 300);
      }
    },

    setProducts(products) {
      this.assembliesFound = [];
      this.assemblyName = null;

      this.$emit("setAssemblie", products);
    },
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

.rounded-pill-left {
  border-top-left-radius: 50px;
  border-bottom-left-radius: 50px;
}

.rounded-pill-right {
  border-top-right-radius: 50px;
  border-bottom-right-radius: 50px;
}
</style>
