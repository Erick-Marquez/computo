<template>
    <div class="content-header">
        <div class="d-flex justify-content-between">
            <div>
                <h1>Añadir Productos</h1>
            </div>
            <div>
                <router-link class="btn btn-lg btn-block btn-dark" :to="{ name:'show-product', params:{ id:this.$route.params.id } }">
                    <i class="mr-2 fas fa-arrow-left"></i>
                    Atras
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {

}
</script>

<style>

</style>