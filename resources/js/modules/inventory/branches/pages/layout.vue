<template>
  <div class="pagina">
      <h1>Lista de sucursales</h1>
      <boton-nuevo @recargar="nuevosDatos" class="btn"></boton-nuevo>
      <table>
          <thead>
              <tr>
                  <td>ID</td>
                  <td>Nombre</td>
                  <td>Dirección</td>
                  <td>Teléfono</td>
                  <td>Activo</td>
                  <td>Acciones</td>
              </tr>
          </thead>
          <tbody>
              <tr v-for="date in datos" :key="date" @load="cargado">
                  <td >{{date.id}}</td>
                  <td >{{date.description}}</td>
                  <td >{{date.direction}}</td>
                  <td >{{date.phone}}</td>
                  <td>
                      <boton-togle></boton-togle>
                  </td>
                  <td>
                      <boton-accion :id="date.id" @delete="deleteDate($event)"></boton-accion>
                  </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
import BotonNuevo from '../components/v-boton-nuevo.vue'
import BotonAccion from '../components/v-boton-accion.vue'
import BotonTogle from '../components/VBotonTogle.vue'
export default {
    components:{BotonNuevo,BotonAccion,BotonTogle,BaseUrl},
    async created(){
       await BaseUrl.get(`/branches`).then(resp =>{
            this.datos=resp.data.data
        })
    },
     data(){
        return{
            datos:{},
        }
    },
    methods:{
        async nuevosDatos(){
            await BaseUrl.get(`/branches`).then(response => {
                this.datos=response.data.data
            });
        },
        deleteDate(getId){
            Swal.fire({
                title: '¿Estas seguro?',
                text: "No se podrá revertir",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, borralo'
            }).then((result) => {
                if (result.isConfirmed) {
                    BaseUrl.delete(`/branches/${getId}`).then(resp=>{
                        console.log(resp)
                        this.nuevosDatos()
                    })
                    Swal.fire(
                    '¡Borrado!',
                    'El dato fue borrado',
                    )           
                }
            }) 
        },
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
        border-bottom: 1px solid rgb(222, 34, 69);
        color: rgb(172,173,182); 
        font-weight: bold;
        transform: translateY(-10px);
        margin-bottom: 25px;
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding: 10px 0;
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
        color: rgb(222, 34, 69);
        font-weight: bold;
        width: 50px;
    }
    td{
        border-bottom: 1px solid rgb(230,230,230);
       
    }
    thead td{
        border-bottom: 1px solid rgb(151, 149, 149);
    }
</style>