<template>
    <h2>Soy Vue F asd</h2>
    
    <p>{{ assemblies }}</p>
</template>

<script>
export default {
    data() {
        return {
            assemblies: [],
        }
    },
    async created() {
        await this.obteniendoClientes();
    },
    methods: {
        async obteniendoClientes() {
            axios.get('assemblies/datos').then(response => {
                this.assemblies = response.data
            })
        }
    },
}
</script>

<style>

</style>