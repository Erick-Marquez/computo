import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
<template>
    <button class="acciones" :id="id" @click.stop="mostrarAcciones($event,getId)"
            :class="{'acciones--select':( accionShow)}">
        <span>Acción</span>
        <div class="acciones__img">
        </div>
    </button>
    <div class="options" >
    <div class="options__absolute" :class="{'options--show': (functionShow(getId) && panelShow)}" >
        <div class="options__element">
            <p>MOSTRAR</p>
            <i class="col-1 mr-3 fas fa-eye"></i>
        </div>
        
            <div class="options__element" >
            <p>EDITAR1</p>
            <i class="far fa-edit"></i>
        </div>
        <router-link :to="{ name:'show-product' ,params:{id:getId}}">
            <div class="options__element" >
                <p>VER PRODUCTOS</p>
            </div>
        </router-link>
        <div @click="$emit('delete',getId)">
            <div class="options__element option__delete" @click.prevent="deleteDate">
                <p>Eliminar</p>
        </div>
        </div>
        </div>
    </div>
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
    components:{BaseUrl},
    props:{
        id:Number,
        datosLista:{}
    },
     emits:['delete'],
    computed:{
        getId(){
            return this.id || 0
        },
        datosPut(){
            return this.datosLista || 0
        }
    },
    data(){
        return{
            optionShow:Number,
            panelShow:false,
            accionShow:false,
            datosList :this.datosLista
        }
    },
    mounted(){
         document.addEventListener('click', (e)=> {
            if (e.target.className != 'acciones') {
                this.panelShow= false;
                this.accionShow=false
            }
        })
    },
    methods:{
        isActive(tab){
            return this.datosPut ===tab
        },
        functionShow(id){
            return this.optionShow ===id
        },
        mostrarAcciones(event,id){
            this.optionShow=id
            this.panelShow=!this.panelShow
            this.accionShow=!this.accionShow

        },
        // deleteDate(){
        //     console.log(this.getId)
        //     Swal.fire({
        //         title: '¿Estas seguro?',
        //         text: "No se podrá revertir",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Sí, borralo'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             BaseUrl.delete(`/locales/${this.getId}`).then(resp=>{
        //                 console.log(resp)
        //             })
        //             Swal.fire(
        //             '¡Borrado!',
        //             'El dato fue borrado',
        //             )           
        //         }
        //     })
            
           
        // }
    }
}
</script>

<style scoped lang="css">
.acciones{
    display: flex;
    justify-content: space-around;
    align-items: center;
    border: none;
    max-width: 110px;
    width: 95%;
    height: 40px;
    padding-left: 12px;
    padding-right: 1px;
    border-radius: 4px;
    /* background-color: rgb(0,123,255); */
    position: relative;
    z-index: 10;
    /* border-color: #3498db; */
    color: #fff;
    box-shadow: 0 0 40px 40px rgb(43, 126, 216) inset, 0 0 0 0 rgb(43, 126, 216);
    transition: all 350ms ease-in-out;
    
}
/* .acciones:hover {
  box-shadow: 0 0 10px 0 #3498db inset, 0 0 10px 4px #3498db;
} */

.acciones--select{
    color: rgb(0,123,255);
    box-shadow: 0 0 3px 0 rgb(43, 126, 216) inset, 0 0 3px 1px rgb(43, 126, 216);
}
.acciones__img img{
   transition: all 600ms;
}
.acciones--select .acciones__img{
    filter: invert(1);
}
.acciones--select img{
    transform: rotate(-90deg) translateX(2px);
}
.acciones img{
    width: 50%;
    margin-left: auto;
    margin-right: auto;
    position: relative;
    top: 3px;
}
.acciones__img{
    display: flex;
    justify-content: center;
    align-items: center;
    justify-self: end;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #fff;
    z-index: 15;
}
.options{
    position: relative;
    margin-top: 5px;
}
.options__absolute{
    position: absolute;
    border-radius: 4px;
    background-color: rgb(233, 232, 232);
    width: 100%;
    opacity: 0;
    transform: translateY(-100%);
    z-index: 1;
    transition: all 600ms;
    font-size: 1rem;
}
.options--show{
   opacity: 1;
   transform: translateY(0);
   transition: all 600ms;
   z-index: 20;
}
.options__element{
    display: flex;
    justify-content: space-around;
    align-items: center;
    background-color: rgb(233, 232, 232);
    margin-top: 7px;
    margin-bottom: 7px;
    color: #000000;
    cursor: pointer;
}
.options__element:hover{
    filter: invert(1);
}
.option__delete{
    color: #ff0000;
}
.options__element img{
    width: 30px;
}
.options__element p{
    margin: 0;
}
</style>