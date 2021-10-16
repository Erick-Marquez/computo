<template>
<div class="pagina">
    <form >
        <div class=" form__element form__select">
            <label class="label">LOCAL:</label>
            <div class="option__relative">
                <div class="option__contenedor" v-if=ocultar>
                    <input type="text"  v-model="filtrado" @keyup="filtrar" class="inputSearch">
                    <div v-if="filtrado.length<1" @click="seleccionar($event)">
                        <p v-for="element in  select" :key="element">{{element.description}}</p>
                    </div>
                    <div v-if="filtrado.length>=1" @click="seleccionar($event)">
                        <p v-for="fil in elementoFiltrado" :key="fil">{{fil.description}}</p>
                    </div>
                </div>
            </div>
            <div class="select" @click="ocultarOptions">
                <p class="selectP">{{seleccionado}}</p>
                <!-- <img src="../../../../img/abajo.svg" :class="{'rotate':ocultar}"> -->
            </div>
        </div>
        <div class="search">
            <label >PRODUCTOS</label>
            <input type="text"  v-model="filtradoSearch" @keyup="filtrarSearch" 
                     @click="ocultarSearch" class="inputContent">
            <div class="option__relative">
                <div class="option__contenedor" >
                    <div>
                        <p v-for="filSearch in  elementoFiltradoSearch" :key="filSearch"
                        @click="seleccionarSearch(filSearch)">{{filSearch.name}} - {{filSearch.brand}}</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <td>fecha.</td>
                <td>Nro. Doc.</td>
                <td>series</td>
                <td>Description</td>
                <td>Entrada</td>
                <td>Salida</td>
                <td>Saldo</td>
            </tr>
        </thead>
        <tbody>
            {{ saldo=0 }}
            <tr v-for="tab in table" :key="tab.id">
                <td>{{ tab.date }}</td>
                <td>{{ tab.document===null ? "-" : tab.document }}</td>
                <td>{{ tab.series }}</td> 
                <td>{{ tab.description }}</td>
                <td>{{ tab.movement_type=='INGRESO' ? tab.quantity : "-"}}</td>
                <td>{{ tab.movement_type=='SALIDA' ? tab.quantity : "-"}}</td>
                <td>{{ tab.movement_type=='INGRESO' ? saldo+=tab.quantity : saldo-=tab.quantity}}</td>
            </tr>
        </tbody>
    </table>
</div>
  
</template>

<script>
import BaseUrl from '../../../../api/BaseUrl'
export default {
    components:{BaseUrl},
    async created(){
       
        await BaseUrl.get(`/branches`).then( resp=>{
            const datos=resp.data.data
            this.select=resp.data.data
            this.dates=datos
       })
        
        
    },
   data(){
       return{
           select:{},
           selectSearch:{},
           ocultar:false,
           filtrado:'',
           filtradoSearch:'',
           seleccionado:'SELECT',
           elementoFiltrado:[],
           elementoFiltradoSearch:[],
           dates: {},
           products:{},
           table:{},
           saldo: 0,
       }
   },
   mounted(){
       document.addEventListener('click', (e)=> {
            if (e.target.className != 'select' && e.target.className !='inputSearch' 
            && e.target.className !='selectP') {
                this.ocultar= false;
            }
        })
        const contain = document.querySelector('.pagina')
        contain.addEventListener('click', (e)=> {
            if (e.target.className !='inputContent') {
               this.elementoFiltradoSearch=''
            }
        })
    },
   methods:{
       cod(a, b){
        return typeof a === 'string' && typeof b === 'string'
        ? a.localeCompare(b, undefined, { sensitivity: 'accent' }) === 0
        : a === b;
        
       },
       filtrar(){
            let palabraFiltrar = this.filtrado.toLowerCase();
            let clientesRespaldo = this.select
            let clientesFiltrados = clientesRespaldo.filter(clientes =>
                (clientes.description.toLowerCase().indexOf(palabraFiltrar) !== -1) 
            );
            this.elementoFiltrado = clientesFiltrados
        },
        filtrarSearch(){
            let clientesRespaldo = this.selectSearch
            let palabraFiltrar = this.filtradoSearch.toLowerCase();
                if(palabraFiltrar===''){
                    this.elementoFiltradoSearch=''
                }else{
                    this.elementoFiltradoSearch = clientesRespaldo.filter(clientes =>
                    (clientes.name.toLowerCase().indexOf(palabraFiltrar) !== -1) 
                );
            }
        },
        seleccionar(e){
            this.filtradoSearch=''
            this.seleccionado= e.target.textContent
            this.dates.forEach( element=>{
                if(this.cod(this.seleccionado,element.description)){    
                          
                   BaseUrl.get(`/branches/products/${element.id}`).then( resp=>{
                       
                        this.products=resp.data.data
                        this.selectSearch= resp.data.data
                        
                    })
                } 
            })
            this.ocultar=!this.ocultar
        },
       seleccionarSearch(e){
            console.log(e.id)
            this.table ={}
            this.filtradoSearch= e.name + ' - ' + e.brand
            BaseUrl.get(`/kardex/${e.id}`).then( resp=>{
                this.table=resp.data.data
                this.saldo = 0
            })
            this.elementoFiltradoSearch=''
        },
        ocultarOptions(){
            this.ocultar=!this.ocultar
        },

   }
}
</script>

<style scoped>
    .pagina{
        width: 95%;
        margin-left: auto;
        margin-right: auto;
        padding-top: 25px;
        padding-bottom: 25px;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 3px 8px -2px, rgba(0, 0, 0, 0.3) 0px 3px 8px -3px;
    }
    form{
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 95px;
        width: 95%;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 40px;
    }
    label{
        color: rgb(172,173,182);
    }
    /* .label{
        color: rgb(128,189,255);
    } */
    .form__select{
        width: 40%;
    }
    .form__select .select{
        width: 100%;
        height: 40px;
        /* outline-color: rgb(128,189,255); */
        border: 1px solid rgb(147,168,195);
        padding-left: 10px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
    }
    .select p{
        margin: 0;
    }
    .select img{
        display: block;
        width: 15px;
        margin-right: 10px;
        transition: all 300ms;
    }
    .rotate{
        transform: rotate(-180deg);
    }
    .option__contenedor{
        box-sizing: border-box;
        border-radius: 5px;
        width: 100%;
        max-height: 200px;
        box-shadow: 0 0 2px 0 rgb(128,189,255);
        background-color: #fff;
        box-sizing: border-box;
        cursor: pointer;
        overflow-y: scroll;
        position: absolute;
        z-index: 100;
        top: 44px;
    }
    .option__contenedor input,.search input{
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-color: #93a8c3;
        outline-color: rgb(128,189,255);
        border-style: solid;
        border-width: 1px;
        color:rgb(172,173,182)
    }
    .option__contenedor p{
        padding:8px 10px ;
        margin: 0;
    }
    .option__contenedor p:hover{
        background-color: rgb(0, 116, 240);
        color: #fff;
    }
    .form__select input{
        width: 99%;
        margin: 5px auto;
        /* margin-left: auto;
        margin-right: auto; */
    }
    .option__contenedor::-webkit-scrollbar{
        width: 7px;
        background-color: rgb(128,189,255)
    }
    .option__contenedor::-webkit-scrollbar-thumb{
        background-color: rgb(255, 255, 255);
        border-radius: 10px;
        border-right: 1px solid rgb(128,189,255);
        border-left: 1px solid rgb(128,189,255);
    }
    .option__relative{
        position: relative;
        z-index: 99;
    }
    .search{
        width: 40%;
        
    }
    .search .option__contenedor{
        top: 0;
    }
    .search input{
        width: 100%;
        height: 40px;
        border-radius: 5px;
    }
    table{
        width: 95%;
        border-collapse: separate;
        border-spacing: 0px 10px;
        margin-left: auto;
        margin-right: auto;
    }
    thead tr{
        color: rgb(172,173,182);  
    }
    thead td{
        margin-bottom: 50px;
    }
    tbody tr{
        background-color: rgb(255, 255, 255);
        box-shadow: rgba(172, 173, 182, 0.4) 0px 7px 15px 0px;
        transition: all 300ms;
    }
    /* tbody tr:hover{
        transform: scale(1.05);
        box-shadow: rgba(172,173,182, 0.25) 0px 24px 25px, 
        rgba(172,173,182, 0.12) 0px -2px 10px, rgba(172,173,182, 0.12) 0px 4px 6px, 
        rgba(172,173,182, 0.17) 0px 2px 13px, rgba(172,173,182, 0.09) 0px -3px 5px;
    } */
    td{
         padding: 15px 10px;
    }
    tbody td:first-of-type{
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        color: rgb(60, 112, 255);
        font-weight: bold;
    }
    tbody td:last-of-type{
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    td:nth-of-type(n+4){
        color: rgb(172,173,182);
    }
    td.colorActive{
        color: rgb(60, 112, 255);
        font-weight: bold;
    }
</style>
