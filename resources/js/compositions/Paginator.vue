<template>
  <ul class="pagination pagination-sm m-0 float-right">
    <li :class="['page-item', link.active ?  'active' : '']" v-for="(link) in links" :key="link.index">
      <router-link v-if="link.url == null ? false : true"
        class="page-link"
        :to="{ query: { page: getPage(link.url) } }"
      >
        {{ link.label }}
      </router-link>
    </li>
  </ul>
</template>

<script>
export default {
  props: { links: Object },
  watch: {
    "$route.query.page": {
      handler(page) {
        this.$emit("getDataPaginate");
      },
    },
  },
  methods: {
    getPage(url) {
      if (url != null) {
        const indice = url.search("=");
        const page = url.slice(indice + 1)
        return page
      }
    },
  },
};
</script>

<style scoped>
.page-link {
    color: #23272b;
}

.page-item.active .page-link {
    background-color: #23272b;
    border-color: #1d2124;
}

.page-link:hover {
    color: #23272b;
}
</style>
