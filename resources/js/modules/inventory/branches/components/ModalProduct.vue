<template>
<transition name="fade">
    <div class="modal-overlay" v-if="show"></div>
</transition>
<transition name="fade">
    <div class="modal" v-if="show">
        <h2>Añadir a lista de Familia</h2>
        <form action="" >
            <div class="form__contenedor">
                <div class="select">
                    <!-- <input type="text"  v-model="filtrado" @keyup="filtrar" class="inputContent"> -->
                    <div class="option__contenedor" >
                        <p v-for="fill in  dato" :key="fill">{{fill.name}}</p>
                    </div>
            </div>
            <div class="form__element" >
                <input type="submit" value="Guardar" class="form__guardar" 
                        @click.prevent="crearMarca">
            </div>
            <!-- @click.prevent="$emit('selectionMarca')" -->
                <!-- <input type="submit" value="Guardar" class="form__guardar" 
                        @click.prevent="$emit( 'data', datos )"> -->
            </div>
        </form>
        <button class="modal__cerrar" @click="showModal">

        </button>
     </div>
</transition>
<button class="boton" @click="showModal">
    <p>Nuevo</p>
    <div class="boton__img">

    </div>
</button>
</template>

<script>
export default {
    props:{
        data:{}
    },
    computed:{
        
        datosPut(){
            return this.datos || 0
        }
    },
    emits:['selectionMarca'],
  data(){
        return{
            show:false,
            crearUsuario:{cod:'',description:''},
            dato:this.data
        }
    },
    methods:{
        showModal(){
          this.show =!this.show 
          console.log(this.dato)
        },
        crearMarca(){
             axios.post('brands',this.crearUsuario).then(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Dato creado',
                    showConfirmButton: false,
                    timer: 1500
                }),
                console.log(response)
            })
            this.crearUsuario.cod=''
            this.crearUsuario.description=''
            this.show=false
        }

        // crearFamilia(){
        //      axios.post('families',this.crearUsuario).then(response => {
        //        console.log(response)
        //     })}
    }
}
</script>
<style scoped lang="css">
.boton{
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 145px;
    height: 50px;
    border: none;
    background-color: transparent;
    transition: all 600ms;
}
.boton:hover p,.boton:hover .boton__img{
    box-shadow: 0 0 5px 0 rgb(222, 34, 69);
}
.boton p{
    border: 2px solid rgb(222, 34, 69);
    padding: 5px 20px;
    margin: 0;
    border-top-left-radius: 15px;
    font-size: bold;
    background-color: #fff;
    color: rgb(222, 34, 69);
}
.boton__img{
    width: 30%;
     border: 2px solid rgb(222, 34, 69);
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
    padding: 10px;
    background-color: #fff;
}
.boton__img img{
    display: block;
    width: 100%;
}
.modal-overlay{
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    z-index: 100;
    background-color: rgba(0, 0, 0, 0.6);
}
.modal{
    display: block;
    position: fixed;
    top: 50%;
    left: 50%;
    width: 30%;
    height:60%;
    transform: translate(-45%,-45%);
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: rgba(255, 255, 255, 0.5) 0px 30px 50px -20px,
     rgba(255, 255, 255, 0.5) 0px 10px 30px -20px, rgba(255, 255, 255, 0.5) 0px -2px 6px 0px inset;
    z-index: 200;
}
.modal h1{
    text-align: center;
}
.modal__cerrar{
    width: 40px;
    height: 40px;
    position: absolute;
    top: 0;
    right: 0;
    padding: 5px;
    border-radius: 50%;
    border: none;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgb(233, 67, 67);
}
.modal__cerrar img{
    display: block;
    width: 50%;
}
form{
    width: 100%;
    height: 100%;
}
.form__contenedor{
    width: 100%;
    height: 75%;
    display: flex;
    flex-direction: column;
    justify-content: space-around;
}
.form__element{
    width: 100%;
    display: flex;
    flex-direction: column;
}
.form__guardar{
    border: none;
    border-radius: 5px;
    width: 25%;
    padding: 10px 15px;
    background-color: rgb(222, 34, 69);
    color: #fff;
    font-size: bold;
}
</style>