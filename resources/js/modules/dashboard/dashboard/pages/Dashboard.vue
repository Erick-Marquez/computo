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
          <h3>53<sup style="font-size: 20px">%</sup></h3>

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
          <h3>53<sup style="font-size: 20px">%</sup></h3>

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
          <h3>53<sup style="font-size: 20px">%</sup></h3>

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
          <LineChart :chartData="testData" />
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import Chart from "chart.js/auto";
import { LineChart } from "vue-chart-3";

export default defineComponent({
  name: "Home",
  components: { LineChart },
  setup() {
    const testData = {
      labels: ["Paris", "Nîmes", "Toulon", "Perpignan", "Autre"],
      datasets: [
        {
          label: "Boletas",
          fill: true,
          tension: 0.5,
          data: [0, 40, 60, 60, 5],
          backgroundColor: ["rgba(0, 0, 0, 0.1)"],
          borderColor: "#ee1616",
        },
        {
          label: "Facturas",
          fill: true,
          tension: 0.5,
          data: [10, 20, 30, 60, 45],
          backgroundColor: ["rgba(0, 0, 0, 0.1)"],
          borderColor: "blue",
        },
      ],
    };

    return { testData };
  },
});
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
