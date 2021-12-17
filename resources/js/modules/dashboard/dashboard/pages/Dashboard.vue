<template>
  <div class="content-header">
    <div class="row mb-2">
      <div class="col-md">
        <h1>Dashboard</h1>
      </div>
      <div class="col-md">
        <ol class="breadcrumb float-sm-right bg-white p-2">
          <button class="btn btn-sm btn-outline-danger" @click="setDays(7)">Semana</button>
          <button class="btn btn-sm btn-outline-danger mx-2" @click="setDays(15)">Quincena</button>
          <button class="btn btn-sm btn-outline-danger" @click="setDays(30)">Mes</button>
        </ol>
      </div>
    </div>
    <!-- <div v-if="$can('dashboard')">tu puedes ver el dashboard</div>
    <div v-if="$can('sales')">tu puedes ver las compras</div> -->
  </div>
  <div class="row mb-4">
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
        <a href="/ventas" class="small-box-footer">
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
        <a href="/compras" class="small-box-footer">
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
        <a href="/productos" class="small-box-footer">
          Más info <i class="fas fa-arrow-circle-right"></i>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cantidad de voucher emitidos</h3>

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
          <VoucherChart :days="days"/>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tipo de pagos</h3>

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
          <TypePaymentChart :days="days"/>
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
import TypePaymentChart from "../charts/TypePaymentChart.vue";
import VoucherChart from "../charts/VoucherChart.vue";
import BaseUrl from "../../../../api/BaseUrl";

export default {
  name: "Dashboard",
  components: { LineChart, BaseUrl, TypePaymentChart, VoucherChart },
  data() {
    return {
      widgets: {},
      days: 7,
    };
  },
  mounted() {
    this.getDataWidgets();
  },
  methods: {
    async getDataWidgets() {
      await BaseUrl.get(`/api/dashboard/widgets/${this.days}`)
        .then((response) => {
          console.log(response.data);
          this.widgets = response.data;
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
    setDays($days) {
      this.days = $days;
      this.getDataWidgets();
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
