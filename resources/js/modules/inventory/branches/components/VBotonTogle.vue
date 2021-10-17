<template>
  <main class="contenedor">
		<div class="center">
			<input type="checkbox" id="check" @click="check($event)">
		</div>
	</main>
</template>

<script>
// const check = document.getElementById('check')
// check.addEventListener('click',(e)=> console.log(e.target.checked))
export default {
    methods:{
        check(e){
            console.log(e.target.checked)
        }
    }
}
</script>

<style scoped>
   input{
	position: relative;
	width: 60px;
	height: 20px;
	-webkit-appearance: none;
	appearance: none;
	background-image: linear-gradient(0deg,#333,#000);
	outline: none;
	border-radius: 10px;
	transition: all 500ms;
	box-shadow: 0 0 0 2px #353535, 0 0 0 3px #3e3e3e,inset 0 0 5px rgba(0, 0, 0, 1),
				0 3px 10px rgba(0, 0, 0, 0.5),inset 0 0 8px rgba(0, 0, 0, .2);
}
input:checked{
	box-shadow: 0 0 0 2px #353535, 0 0 0 3px #3e3e3e,inset 0 0 5px rgba(0, 0, 0, 1),
				0 3px 10px rgba(0, 0, 0, 0.5),inset 0 0 8px rgba(0, 0, 0, .2);
	background-image: linear-gradient(0deg,#6dd1ff,#20b7ff);
}
input::before{
	content: 'off';
	position: absolute;
	top: 0;
	left: 0;
	width: 40px;
	height: 20px;
	background-image: linear-gradient(0deg,#000,#6b6b6b);
	border-radius: 10px;
	box-shadow: 0 0 0 1px #232323;
	transform: scale(0.98,0.96);
	transition: all 0.5s;
	color: rgba(253, 253, 255, 0.4);
	font-size: 0.8rem;
	text-align: center;
	vertical-align: middle;
	line-height: 18px;
}
input:checked::before{
	left: 20px;
	content: 'on';
	color: rgba(253, 253, 255);
	line-height: 15px;
}
input::after{
	content: '';
	position: absolute;
	top: calc(50% - 1px);
	left: 32px;
	width: 2px;
	height: 2px;
	background-image: linear-gradient(0deg,#6b6b6b,#000);
	border-radius: 50%;
	transition: all 0.5s;
}
input:checked::after{
	background-image: linear-gradient(0deg,#0ecdfd,rgb(0, 145, 170));
	left: 53px;
	box-shadow: 0 0 3px #13b3ff, 0 0 8px #13b3ff;
}
</style>