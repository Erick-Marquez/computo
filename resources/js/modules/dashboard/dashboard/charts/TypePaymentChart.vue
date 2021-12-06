<template>
  <DoughnutChart :chartData="testData" />
</template>

<script>
import { DoughnutChart } from "vue-chart-3";
import BaseUrl from "../../../../api/BaseUrl";

export default {
  components: {
    DoughnutChart,
    BaseUrl,
  },
  data() {
    return {
      testData: {
        labels: [],
        datasets: [
          {
            data: [],
            backgroundColor: [
              "#77CEFF",
              "#0079AF",
              "#123E6B",
              "#97B0C4",
              "#A5C8ED",
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
  created() {
    this.getAmountTypePayment();
  },
  methods: {
    getAmountTypePayment() {
      BaseUrl.get(`/api/dashboard/type-payments`)
        .then((response) => {
          this.dataChart = response.data;
          this.dataChart.forEach((element) => {
              this.testData.labels.push(element.description)
              this.dataArray.push(element.amount);
          });
          this.testData.datasets[0].data = this.dataArray
          console.log(this.testData.datasets[0].data)
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>

