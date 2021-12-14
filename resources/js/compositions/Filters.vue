<template>
  <div class="card mb-4">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          <div class="form-group">
            <label for="" class="lead">Sucursal</label>
            <select
              class="form-control rounded-pill"
              @change="$emit('changeBranch')"
              v-model="filters.branch_id"
            >
              <option :value="null" selected="true">TODOS</option>
              <option
                v-for="branch in branches"
                :key="branch.id"
                :value="branch.id"
              >
                {{ branch.description }}
              </option>
            </select>
          </div>
        </div>
        <div class="col-md">
          <div class="form-group">
            <label class="lead" for="">Desde:</label>
            <input
              type="date"
              class="form-control rounded-pill"
              :max="maxDate"
              v-model="filters.fromDate"
            />
          </div>
        </div>
        <div class="col-md">
          <div class="form-group">
            <label class="lead" for="">Hasta:</label>
            <input
              type="date"
              class="form-control rounded-pill"
              :max="maxDate"
              v-model="filters.untilDate"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <slot></slot>
      </div>
    </div>
    <div class="card-footer">
      <button type="submit" class="btn btn-block btn-sm btn-dark">
        <i class="fas fa-search"></i>
        Buscar
      </button>
    </div>
  </div>
</template>

<script>
import BaseUrl from "../api/BaseUrl";

export default {
  data() {
    return {
      branches: [],
    };
  },
  props: {
    filters: Object,
  },
  mounted() {
    this.getBranches();
    this.filters.fromDate = this.startDate;
    this.filters.untilDate = this.maxDate
  },
  methods: {
    async getBranches() {
      await BaseUrl.get(`/api/branches`)
        .then((response) => {
          this.branches = response.data.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
  computed: {
    maxDate() {
      return moment().format("YYYY-MM-DD");
    },
    startDate() {
      return moment().startOf("month").format("YYYY-MM-DD");
    },
  },
};
</script>

<style>
</style>
