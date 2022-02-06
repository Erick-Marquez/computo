<template>
  <form action="" @submit.prevent="generateReportSalesDetails()">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md">
            <div class="form-group">
              <label class="lead" for="">Series: </label>

              {{ filters.serie }}
              <v-select
                v-model="filters.serie"
                :filterable="false"
                label="serie"
                :reduce="(serie) => serie.serie"
                :options="series"
                @search="onSeriesSearch"
                @keydown.enter.prevent=""
              >
                <template v-slot:no-options="{ search, searching }">
                  <template v-if="searching">
                    No se encontraron resultados para
                    <b
                      ><em>{{ search }}</em></b
                    >.
                  </template>
                  <em v-else style="opacity: 0.5"
                    >Escribe la serie del producto.</em
                  >
                </template>
              </v-select>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <button type="submit" class="btn btn-block btn-sm btn-dark">
          <i class="fas fa-search"></i>
          Buscar
        </button>
      </div>
    </div>
  </form>

  <!-- tabla de reportes de Ventas -->
  <div class="card">

  </div>
</template>

<script>
import Filters from "../../../../compositions/Filters.vue";
import BaseUrl from "../../../../api/BaseUrl";

export default {
  components: { Filters },
  data() {
    return {
      filters: {
        branch_id: null,
        fromDate: null,
        untilDate: null,
        voucher_type_id: null,
        customer_id: null,
        product_id: null,
      },

      series: [],

      //Vue select
      searching: null,
      search: null,
      selectLoading: null,
    };
  },
  mounted() {
  },
  methods: {
    async generateReportSalesDetails() {
      await BaseUrl.post(`/api/reports/details`, this.filters)
        .then((response) => {
          console.log(response.data);
          this.sales_details = response.data;
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },

    onSeriesSearch(search, loading) {
      this.search = search;
      this.selectLoading = loading;

      clearTimeout(this.searching);

      if (search.length !== 0) {
        this.selectLoading(true);
        this.searching = setTimeout(this.searchSerie, 500);
      } else {
        clearTimeout(this.searching);
        this.series = [];
        this.selectLoading(false);
      }
    },

    async searchSerie() {
      await BaseUrl.get(
        `api/productseries/all/${this.search}`
      )
        .then((resp) => {
          this.series = resp.data.data;
        })
        .finally(() => {
          this.selectLoading(false);
        });
    },
  },
};
</script>

<style>
</style>
