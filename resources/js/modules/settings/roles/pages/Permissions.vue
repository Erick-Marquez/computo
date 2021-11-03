<template>
  <h3>Permisos del rol: {{ role.name }}</h3>
  <hr />
  <form @submit.prevent="updatePermissions()">
    <ul>
      <li v-for="permission in permissions" :key="permission.id">
        <div class="custom-control custom-checkbox">
          <input
            class="custom-control-input custom-control-input-danger"
            type="checkbox"
            v-model="rolePermissions"
            :value="permission.id"
            :id="permission.name"
          />
          <label :for="permission.name" class="custom-control-label">{{
            permission.description
          }}</label>
        </div>
      </li>
    </ul>
    <input
      type="submit"
      class="btn btn-block btn-lg btn-dark"
      value="Guardar"
    />
  </form>
</template>

<script>
import BaseUrl from "../../../../api/BaseUrl";

export default {
  components: { BaseUrl },
  data() {
    return {
      permissions: [],
      rolePermissions: [],
      role: {},
    };
  },
  mounted() {
    this.getPermissions();
  },
  methods: {
    async getPermissions() {
      await BaseUrl.get(`/api/roles/${this.$route.params.id}`)
        .then((response) => {
          this.permissions = response.data.allPermissions;
          this.rolePermissions = response.data.rolePermissions;
          this.role = response.data.role;
          console.log(response.data)
        })
        .catch((error) => {});
    },
    async updatePermissions() {
      await BaseUrl.put(
        `/api/roles/${this.$route.params.id}`,
        this.rolePermissions
      )
        .then((response) => {
          Swal.fire(
            "Permisos Actualizados!!",
          );
          this.$router.push({ path: "/roles" });
        })
        .catch((error) => {
          console.log(error.response);
        });
    },
  },
};
</script>

<style>
</style>
