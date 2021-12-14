<template>
  <img
    v-if="hasImage"
    class="rounded mx-auto d-block mb-4"
    :src="imgDataUrl"
    style="width: 100%"
  />
  <img v-else class="img-fluid" src="/images/imageUpload.png" alt="" />

  <a class="btn btn-block btn-outline-dark" @click="toggleShow">
    <i class="fas fa-upload"></i>
    Subir Imagen
  </a>
  <my-upload
    field="img"
    @srcFileSet="srcFileSet"
    @crop-success="cropSuccess"
    v-model="show"
    :langExt="idioma"
    :params="params"
    :headers="headers"
    img-format="png"
  ></my-upload>
</template>

<script>
import myUpload from "vue-image-crop-upload";
export default {
  data() {
    return {
      idioma: {
        hint: "Selecciona o arrastra una imagen",
        loading: "Subiendo...",
        noSupported:
          "Tu navegador no es soportado, por favor usa IE10+ u otros navegadores más recientes",
        success: "Subido exitosamente",
        fail: "Sucedió un error",
        preview: "Vista previa",
        btn: {
          off: "Cancelar",
          close: "Cerrar",
          back: "Atrás",
          save: "Guardar",
        },
        error: {
          onlyImg: "Únicamente imágenes",
          outOfSize: "La imagen excede el tamaño maximo:",
          lowestPx: "La imagen es demasiado pequeña. Se espera por lo menos:",
        },
      },
      show: false,
      params: {
        token: "123456798",
        name: "avatar",
      },
      headers: {
        smail: "*_~",
      },
      imgDataUrl: "", // the datebase64 url of created image
    };
  },
  watch: {
    imgDataUrl: () => {
      this.$emit('data_image', imgDataUrl)
    },
  },
  props: {

  },
  components: {
    "my-upload": myUpload,
  },
  methods: {
    toggleShow() {
      this.show = !this.show;
    },
    /**
     * crop success
     *
     * [param] imgDataUrl
     * [param] field
     */
    cropSuccess(imgDataUrl, field) {
      console.log("-------- crop success --------");
      this.imgDataUrl = imgDataUrl;
    },
  },
  computed: {
    hasImage() {
      return this.imgDataUrl != "" ? true : false;
    },
  },
};
</script>

<style>
</style>
// NO DA ESTA WEBADA
