<template>
  <div class="content-header">
    <h1>Dashboard</h1>
    <div v-if="$can('dashboard')">tu puedes ver el dashboard</div>
    <div v-if="$can('sales')">tu puedes ver las compras</div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-12">
      <!-- small card -->
      <div class="small-box bg-success caja-1">
        <div class="inner">
          <h3>{{ widgets.sales }}</h3>

          <p>VENTAS</p>
        </div>
        <div class="icon">
          <i class="fas fa-funnel-dollar"></i>
        </div>
        <a href="#" class="small-box-footer">
          Más info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <!-- small card -->
      <div class="small-box bg-success caja-2">
        <div class="inner">
          <h3>{{ widgets.purchases }}</h3>

          <p>COMPRAS</p>
        </div>
        <div class="icon">
          <i class="fas fa-shopping-basket"></i>
        </div>
        <a href="#" class="small-box-footer">
          Más info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <!-- small card -->
      <div class="small-box bg-success caja-3">
        <div class="inner">
          <h3>{{ widgets.products }}</h3>

          <p>CANTIDAD DE PRODUCTOS</p>
        </div>
        <div class="icon">
          <i class="fas fa-box"></i>
        </div>
        <a href="#" class="small-box-footer">
          Más info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Grafico 1</h3>

          <div class="card-tools">
            <button
              type="button"
              class="btn btn-tool"
              data-card-widget="collapse"
            >
              <i class="fas fa-minus"></i>
            </button>
            <button
              type="button"
              class="btn btn-tool"
              data-card-widget="remove"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body" style="display: block">
          <div class="chart">
            <div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
                <div class=""></div>
              </div>
              <div class="chartjs-size-monitor-shrink">
                <div class=""></div>
              </div>
            </div>
            <canvas
              id="areaChart"
              style="
                min-height: 250px;
                height: 250px;
                max-height: 250px;
                max-width: 100%;
                display: block;
                width: 487px;
              "
              width="487"
              height="250"
              class="chartjs-render-monitor"
            ></canvas>
          </div>
        </div>
      </div>
    </div> -->
    <div class="col-md">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Grafico 2</h3>

          <div class="card-tools">
            <button
              type="button"
              class="btn btn-tool"
              data-card-widget="collapse"
            >
              <i class="fas fa-minus"></i>
            </button>
            <button
              type="button"
              class="btn btn-tool"
              data-card-widget="remove"
            >
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body" style="display: block">
          <LineChart :chartData="testData" :options="options" />
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
  <!-- <button @click="getDataWidgets" class="btn btn-info">model</button> -->
</template>

<script>
import Chart from "chart.js/auto";
import { LineChart } from "vue-chart-3";
import BaseUrl from "../../../../api/BaseUrl";

export default {
  name: "Dashboard",
  components: { LineChart, BaseUrl },
  data() {
    return {
      widgets: {},
      options: {
        scales: {
          x: {
            gridLines: {
              display: false,
            },
          },
          y: {
            beginAtZero: true,
            suggestedMax: 50,
            gridLines: {
              display: false,
            },
          },
        },
      },
      testData: {
        type: "line",
        labels: [],

        datasets: [
          {
            label: "FACTURAS",
            fill: true,
            tension: 0.5,
            data: [],
            backgroundColor: ["rgba(23, 165, 137, 0.1)"],
            borderColor: "#17A589",
          },
          {
            label: "BOLETAS",
            fill: true,
            tension: 0.5,
            data: [],
            backgroundColor: ["rgba(52, 73, 94, 0.1)"],
            borderColor: "#34495E",
          },
          {
            label: "NV",
            fill: true,
            tension: 0.5,
            data: [10, 20, 30, 60, 45],
            backgroundColor: ["rgba(203, 67, 53, 0.1)"],
            borderColor: "#CB4335",
          },
        ],
      },
    };
  },
  created() {
    this.getDataVouchers();
    this.getDataWidgets();
  },
  methods: {
    async getDataVouchers() {
      await BaseUrl.get(`/api/dashboard/vouchers`)
        .then((response) => {
          console.log(response.data);
          this.testData.labels = response.data.fechas.reverse();
          this.testData.datasets[0].data = this.fillDates(
            response.data.facturas,
            response.data.fechas
          );
          this.testData.datasets[1].data = this.fillDates(
            response.data.boletas,
            response.data.fechas
          );
          this.testData.datasets[2].data = this.fillDates(
            response.data.notas_venta,
            response.data.fechas
          );
        })
        .catch((error) => {
          this;
        });
    },
    fillDates(vouchers, fechas) {
      fechas.forEach((fecha) => {
        const e = vouchers.find((v) => v.x == fecha);
        e == undefined ? vouchers.push({ x: fecha, y: 0 }) : null;
      });

      vouchers.sort(function (a, b) {
        if (a.x > b.x) {
          return 1;
        }
        if (a.x < b.x) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });

      return vouchers;
    },
    async getDataWidgets() {
      await BaseUrl.get(`/api/dashboard/widgets`)
        .then((response) => {
          console.log(response.data);
          this.widgets = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>

<style scoped>
.caja-3 {
  background: linear-gradient(to right, #84d9d2, #07cdae);
}

.caja-1 {
  background: linear-gradient(to right, #ffbf96, #fe7096);
}

.caja-2 {
  background: linear-gradient(to right, #90caf9, #047edf 99%);
}

.fas {
  color: #f2f2f2;
}
</style>
