<script>
export default {
  methods: {
    $errorsExists(error) {
      return error != undefined ? true : false;
    },
    $errorsPrint(error) {
      return this.$errorsExists(error) ? error.join(", ") : null;
    },
    $errorsClass(error) {
      return this.$errorsExists(error)
        ? "form-control rounded-pill is-invalid"
        : "form-control rounded-pill";
    },
  },
};

// CREO Q SOY EL SUJETO
</script>
