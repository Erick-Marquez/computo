<template>
  <form action="" @submit.prevent="generateReportSeries()">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md">
            <div class="form-group">
              <label class="lead" for="">Series: </label>
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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Reporte de Serie</h3>
                <div class="card-tools" v-show="serieMovements.length >= 1">
                    <a
                        :href="`/reports/series/pdf/${filters.serie}`"
                        target="_blank"
                        class="btn btn-flat btn-danger mr-2 rounded-pill"
                    >
                        <i class="fas fa-file-pdf"></i> PDF
                    </a>
                    <a
                        class="btn btn-flat bg-olive rounded-pill"
                        target="_blank"
                        :href="`/reports/series/excel/${filters.serie}`"
                    >
                        <i class="fas fa-file-excel"></i> Excel
                    </a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table
                        class="table table-hover table-bordered text-nowrap text-center"
                    >
                        <thead>
                            <tr>
                                <th>Serie</th>
                                <th>Producto</th>
                                <th>Tipo de movimiento</th>
                                <th>Descripción</th>
                                <th>Documento</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>

                        <tbody v-if="serieMovements.length >= 1">
                            <tr v-for="serie in serieMovements" :key="serie.id">
                                <td>{{ serie.serie }}</td>
                                <td>{{ serie.product }}</td>
                                <td>{{ serie.movement_type }}</td>
                                <td>{{ serie.description }}</td>
                                <td>{{ serie.document }}</td>
                                <td>{{ serie.date }}</td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                        <tr>
                            <td colspan="5">
                                <p class="lead">
                                    <b>No existen Registros las fechas seleccionadas </b>
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
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
        serie: null,
      },
      serieMovements: [],
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
    async generateReportSeries() {
      await BaseUrl.post(`/api/reports/series`, this.filters)
        .then((response) => {
          console.log(response.data);
          this.serieMovements = response.data;
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
