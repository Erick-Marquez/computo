<template>
  <div class="pagina">
    <table>
    <thead>
      <tr>
        <td>ID</td>
        <td>Código</td>
        <td>Nombre</td>
        <td>Descripción</td>
        <td>Stock</td>
        <td>Precio</td>
        <td>Acciones</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="dato in datos" :key="dato.id">
        <td>{{dato.id}}</td>
        <td>{{dato.code}}</td>
        <td>{{dato.name}}</td>
        <td>{{dato.description}}</td>
        <td>{{dato.stock}}</td>
        <td>{{dato.precio}}</td>
        <td>Eliminar</td>
      </tr>
    </tbody>
  </table>
  <button @click="regresar">REGRESAR</button>
  </div>

</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
  components:{BaseUrl},
  async created(){
          const id=this.$route.params.id
         await BaseUrl.get(`branches/products/${id}`).then( resp=>{
              console.log(resp.data)
              this.datos=resp.data.data
          })
  },
  data(){
    return{
      datos:{}
    }
  },
  methods:{
    regresar(){
       this.$router.go(-1)
    }
  }
}
</script>

<style scoped>
  .pagina{
        width: 95%;
        
        margin-left: auto;
        margin-right: auto;
        background-color: rgb(255, 255, 255);
        margin-bottom: 50px;
        padding-top: 15px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 3px 8px -2px, rgba(0, 0, 0, 0.3) 0px 3px 8px -3px;
        border-radius: 5px;
    }
    h1{
        font-size: 1.4rem;
        border-bottom: 1px solid rgb(172,173,182);
        color: rgb(172,173,182); 
        font-weight: bold;
        transform: translateY(-10px);
        margin-bottom: 25px;
        width: 95%;
         margin-left: auto;
        margin-right: auto;
    }
    table{
        width: 93%;
        border-collapse: separate;
        border-spacing: 0px 2px;
        margin-left: auto;
        margin-right: auto;
        
    }
    thead tr{
        color: rgb(172,173,182);  
    }
    tbody tr{
        background-color: rgb(255, 255, 255);
        /* box-shadow: rgba(172, 173, 182, 0.4) 0px 7px 15px 0px; */
        transition: all 300ms;
         color: rgb(65, 65, 65);
    }
    td{
         padding: 10px 0 10px 10px;
    }
    tbody td:first-of-type{
        color: rgb(60, 112, 255);
        font-weight: bold;
        width: 50px;
    }
    /* td.colorActive{
        color: rgb(60, 112, 255);
        font-weight: bold;
    } */
    td{
        border-bottom: 1px solid rgb(230,230,230);
       
    }
    thead td{
        border-bottom: 1px solid rgb(151, 149, 149);
    }
</style>