<script>
  export default {
    methods: {
      $can(permissionName) { // UN MIXIN ES UN METODO GLOBAL QUE ESTARA EN TODO LOS VUE, AQUI SE IMPORTAN PLUGINS TAMBIEN
        return Permissions.indexOf(permissionName) !== -1;
      },
    },
  };
</script>
