<template>
<transition name="fade">
    <div class="modal-overlay" v-if="show"></div>
</transition>
<transition name="fade">
    <div class="modal" v-if="show">
        <h2>Añadir a lista de Familia</h2>
        <form >
            <div class="form__contenedor">
                <div class="form__cod form__element">
                    <label for="cod">Descripción:</label>
                    <!-- <input type="text"  id="cod" v-model="crearUsuario.description"> -->
                    <input type="text"  id="cod" v-model="crearUsuario.name">
                </div>
                
                <div class="form__desc form__element">
                    <label for="desc">Telefono:</label>
                    <!-- <input type="text" placeholder="Descripción" id="desc" required v-model="crearUsuario.telephone"> -->
                    <input type="text" placeholder="Descripción" id="desc" required v-model="crearUsuario.address">
                    
                </div>
                <div class="form__element">
                    <label for="desc">Dirección:</label>
                    <!-- <input type="text" placeholder="Descripción" id="desc" required v-model="crearUsuario.address"> -->
                    <input type="text" placeholder="Descripción" id="desc" required v-model="crearUsuario.telephone">
                </div>
                <div class="form__element">
                    <label for="desc">Ubigeo:</label>
                    <!-- <input type="text" placeholder="Descripción" id="desc" required v-model="crearUsuario.ubigeo"> -->
                    <input type="text" placeholder="Descripción" id="desc" required v-model="crearUsuario.ubigeo">
                </div>
                <div class="form__element" @click.prevent="$emit('recargar')">
                    <input type="submit" value="Guardar" class="form__guardar" 
                         @click.prevent="crearFamilia">
                </div>
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
import BaseUrl from '../../../../api/BaseUrl.js'
export default {
    components:{BaseUrl},
    props:{
        subtitle:''
    },
    emits:['recargar'],
  data(){
        return{
           show:false,
        //    datos:{
        //        cod:'',
        //        desc:''
        //    },
        // crearUsuario:{description:'',telephone:'',address:'',ubigeo:''},
           crearUsuario:{name:'',address:'',telephone:'',ubigeo:''},
        }
    },
    methods:{
        
        showModal(){
          this.show =!this.show 
        },
        crearFamilia(){
             BaseUrl.post(`/locales`,this.crearUsuario).then(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Dato creado',
                    showConfirmButton: false,
                    timer: 1500
                }),
                console.log(response)
            })
            this.crearUsuario.name=''
            this.crearUsuario.description=''
            this.crearUsuario.telephone=''
            this.crearUsuario.ubigeo=''
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
    margin-left: 30px;
    margin-bottom: 20px;
}
.boton:hover p,.boton:hover .boton__img{
    box-shadow: 0 0 5px 0 rgb(0,123,255);
}
.boton p{
    border: 2px solid rgb(0,123,255);
    padding: 5px 20px;
    margin: 0;
    border-top-left-radius: 15px;
    font-size: bold;
    background-color: #fff;
    color: rgb(0,123,255);
}
.boton__img{
    width: 30%;
     border: 2px solid rgb(0,123,255);
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
    position: absolute;
    top: 56px;
    right: 0;
    width: 80%;
    height:100vh;
    transform: translateX(23%);
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
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
    background-color: rgb(0,123,255);
    color: #fff;
    font-size: bold;
}
</style>