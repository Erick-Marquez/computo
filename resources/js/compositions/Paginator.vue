<template>
  <ul class="pagination pagination-sm m-0 float-right">
    <li :class="['page-item', link.active ?  'active' : '']" v-for="(link, index) in links" :key="link.index">
      <router-link v-if="link.url == null ? false : true"
        class="page-link"
        :to="{ path: '/clientes', query: { page: link.label } }"
      >
        {{ index == 0 ? 'Anterior' : index == links.length - 1 ? 'Siguiente' : getPage(link.url) }}
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

<style>
</style>
