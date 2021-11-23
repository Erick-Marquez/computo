<script>
import { defineComponent } from "vue";
import Chart from "chart.js/auto";
import { DonutChart } from "vue-chart-3";

export default defineComponent({
  name: "TypePaymentChart",
  components: { DonutChart },
  setup() {
    return { testData };
  },
  props: {testData}
});
</script>
