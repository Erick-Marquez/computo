<template>
  <BarChart :chartData="testData" />
</template>

<script>
import Chart from "chart.js/auto";
import { BarChart } from "vue-chart-3";

export default {
  components: {
    BarChart,
  },
  data() {
    return {
      testData: {
        labels: [],
        datasets: [
          {
            data: [],
            backgroundColor: [
              "#E74C3C",
              "#8E44AD",
              "#3498DB",
              "#1ABC9C",
              "#16A085",
              "#2ECC71",
              "#F1C40F",
              "#E67E22",
              "#BDC3C7",
              "#34495E",
            ],
          },
        ],
      },
      options: {
        scales: {}, // boom
      },
      dataChart: [],
      dataArray: [],
    };
  },
  props: {
    msp: Array,
  },
  watch: {
    msp: function () {
      this.getAmountTypePayment()
    },
  },
  methods: {
    getAmountTypePayment() {

      this.dataChart = this.msp;
      this.testData.labels = [];
      this.dataArray = [];

      this.dataChart.forEach((element) => {
        this.testData.labels.push(element.line);
        this.dataArray.push(element.quantity);
      });

      this.testData.datasets[0].data = this.dataArray;
    },
  },
};
</script>
