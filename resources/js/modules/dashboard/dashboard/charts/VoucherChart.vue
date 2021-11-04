<script>
import { defineComponent } from "vue";
import Chart from "chart.js/auto";
import { LineChart } from "vue-chart-3";

export default defineComponent({
  name: "VoucherChart",
  components: { LineChart },
  setup() {
    return { testData };
  },
  props: {testData}
});
</script>
