<template>
<transition name="fade">
    <div class="modal-overlay" v-if="show"></div>
</transition>
<transition name="fade">
    <div class="modal" v-if="show">
        <div class="subtitle">
            <h2>Añadir a lista de Familia</h2>
        </div>
        <form class="form">
            <div class="form__contenedor" >
                <div class="form__cod form__element">
                   <div class="i">
                       <i class="fab fa-artstation"></i>
                   </div>
                   <div class="form__text">
                        <label for="cod">Descripción:</label>
                        <input type="text"  id="cod" v-model="crearUsuario.description" 
                            @focus="focus1($event)" @blur="blur1($event)">
                   </div>
                </div>
                
                <div class="form__desc form__element">
                    <div class="i">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="form__text">
                        <label for="desc">Telefono:</label>
                        <input type="text"  id="desc" required 
                        v-model="crearUsuario.direction"  @focus="focus1($event)" @blur="blur1($event)">
                    </div>
                </div>
                <div class="form__element">
                    <div class="i">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="form__text">
                        <label for="adrres">Dirección:</label>
                        <input type="text" id="adrres" required 
                        v-model="crearUsuario.phone"  @focus="focus1($event)" @blur="blur1($event)">
                    </div>
                </div>
                <div class="form__element">
                    <div class="i">
                        <i class="fab fa-acquisitions-incorporated"></i>
                    </div>
                    <div class="form__text">
                        <label for="ubigeo">Ubigeo:</label>
                        <input type="text"  id="ubigeo" required 
                        v-model="crearUsuario.ubigeo"  @focus="focus1($event)" @blur="blur1($event)">
                    </div>
                </div>
                 <div class="form__element" @click.prevent="$emit('recargar')">
                    <input type="submit" value="Guardar" class="form__guardar" 
                         @click.prevent="crearFamilia">
                </div>
            </div>
           
        </form>
        <button class="modal__cerrar" @click="showModal">

        </button>
     </div>
</transition>
<button class="boton" @click="showModal">
    <p>Nuevo</p>
    <div class="boton__img">
        <i class="fas fa-plus"></i>
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
           crearUsuario:{description:'',direction:'',phone:'',ubigeo:''},
        }
    },
    methods:{
        focus1(e){
            let label = e.target.previousElementSibling
            let img =label.parentElement.previousElementSibling
            let padre = label.parentElement
            padre.classList.add('ancho')
            img.classList.add('i--rojo')
            label.classList.add('label--top')
        },
        blur1(e){
            let label = e.target.previousElementSibling
            let img =label.parentElement.previousElementSibling
            let padre = label.parentElement
            let valor= e.target.value
            if(valor.length==0){
                label.classList.remove('label--top')
                img.classList.remove('i--rojo')
            }
            
            padre.classList.remove('ancho')
        },
        showModal(){
          this.show =!this.show 
        },
        crearFamilia(){
             BaseUrl.post(`/branches`,this.crearUsuario).then(response => {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Dato creado',
                    showConfirmButton: false,
                    timer: 1500
                }),
                console.log(response)
            })
            this.crearUsuario.description=''
            this.crearUsuario.direction=''
            this.crearUsuario.phone=''
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
.boton__img i{
    display: block;
    width: 30%;
    color: rgb(222, 34, 69);
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
    backdrop-filter: blur(2px);
}
.modal{
    display: block;
    position: absolute;
    top: 0;
    left: 60%;
    width: 40%;
    height:100vh;
    background-color: #fff;
    z-index: 2000;
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
.subtitle{
    background-color: rgb(222, 34, 69);
    color: #fff;
    width: 100%;
    height: 10%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.form{
    width: 100%;
    height: 100%;
    
}
.form__contenedor{
    width: 100%;
    height: 85%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    padding: 30px;
}

.form__element{
    width: 100%;
    height: 50px;
    display: flex;
    position: relative;
}
.form__element input{
    outline: none;
    border: none;
    height: 100%;
    color: rgb(160, 160, 160);
    padding-left: 10px;
    font-size: 1.2rem;
}
.form__element .i{
    color: rgb(184, 184, 184);
    font-size: 1.3rem;
    position: relative;
    transition: all 600ms;
}
.i i{
    margin-top: 8px;
}
.form__element .i.i--rojo{
    color: rgb(222, 34, 69);
    transition: all 600ms;
}
.form__text label{
    color: rgb(160, 160, 160);
    font-size: 0.9rem;
    position: absolute;
    top: 50%;
    left: 30px;
    margin-bottom: 0;
    transition: all 600ms;
}
.form__text .label--top{
    top: -11px;
    transition: all 600ms;
    color: rgb(222, 34, 69);
}
.form__text::before{
    content: '';
    position: absolute;
    bottom: 0;
    width: 95%;
    height: 2px;
    background-color: rgb(160, 160, 160);
   /* background-color: rgb(222, 34, 69); */
}
.form__text::after{
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    transform: translateX(-50%);
    height: 2px;
    background-color: rgb(222, 34, 69);
    transition: all 600ms;
}
.form__text.ancho::after{
    width: 100%;
    transition: all 600ms;
}
.form__element .form__guardar{
    border: none;
    border-radius: 5px;
    width: 25%;
    padding: 10px 15px;
    box-shadow: 0 0 40px 40px rgb(222, 34, 69) inset, 0 0 0 0 rgb(222, 34, 69);
    color: #fff;
    font-size: bold;
    transition: all 600ms;
}
.form__element .form__guardar:hover{
    color: rgb(222, 34, 69);
    box-shadow: 0 0 3px 0 rgb(222, 34, 69) inset, 0 0 3px 1px rgb(222, 34, 69);
}
.fade-enter-from{
  opacity: 0;
  transform: translateX(-30px);
}
/*se omite x lo mismo 
.fade-enter-to{
  opacity: 1;
} */
.fade-leave-active,.fade-enter-active {
  transition: all .6s ease;
}
/* se omite xq opacity 1 es una propiedad predeterminada asi que en este caso se omite ,pero no pasa con
todas las propiedades 
.fade-leave-from{
  opacity: 0;
} */
 .fade-leave-to{
  transform: translateX(-30px);
  opacity: 0;
}
</style>