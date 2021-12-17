<template>
  <LineChart :chartData="testData" :options="options" />
</template>

<script>
import Chart from "chart.js/auto";
import { LineChart } from "vue-chart-3";
import BaseUrl from "../../../../api/BaseUrl";

export default {
  name: "VoucherChart",
  components: { LineChart, BaseUrl },
  data() {
    return {
      options: {
        plugins: {
          tooltip: {
            mode: "index",
            intersect: false,
          },
        },
        scales: {
          x: {

          },
          y: {
            beginAtZero: true,
            suggestedMin: 0,
            grid: {
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
  props: { days: Number },
  watch: {
    days() {
      this.getDataVouchers();
    },
  },
  mounted() {
    this.getDataVouchers();
  },
  methods: {
    async getDataVouchers() {
      await BaseUrl.get(`/api/dashboard/vouchers/${this.days}`)
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
          console.log(error.response);
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
  },
};
</script>
