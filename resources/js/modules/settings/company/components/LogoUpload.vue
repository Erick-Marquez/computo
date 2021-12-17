<template>
  <img
    v-if="hasImage"
    class="rounded mx-auto d-block mb-4"
    :src="imgDataUrl"
    style="height: 200px"
  />
  <img
    @click="toggleShow"
    v-else
    class="img-fluid"
    src="/images/Logo.png"
    alt=""
    style="height: 200px; cursor: pointer"
  />
  <my-upload
    field="img"
    @crop-success="cropSuccess"
    @srcFileSet="srcFileSet"
    v-model="show"
    :langExt="idioma"
    :width="500"
    :height="450"
    img-format="png"
  ></my-upload>
</template>

<script>
import myUpload from "vue-image-crop-upload";
export default {
  components: { myUpload },
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
      imgDataUrl: "", // the datebase64 url of created image
    };
  },
  emits: ["uploadImage"],
  watch: {
    imgDataUrl() {
      this.$emit('uploadImage', this.imgDataUrl)
    },
  },
  created() {},
  methods: {
    //* * METODOS PARA IMAGENES
    toggleShow() {
      this.show = !this.show;
    },
    cropSuccess(imgDataUrl, field) {
      console.log("-------- crop success --------");
      this.imgDataUrl = imgDataUrl;
    },
    srcFileSet(fileName, fileType, fileSize) {
      console.log(fileSize);
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
.image-without-products {
  display: flex;
  justify-content: center;
  align-items: center;
  align-content: center;
  opacity: 0.7;
  height: 150px;
  width: 100%;
  min-width: 850px;
}
.image-without-products img {
  margin-bottom: 0.5rem;
  margin-right: 0.5rem;
}
</style>
