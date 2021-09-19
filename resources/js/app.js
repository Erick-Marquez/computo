require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { createApp } from 'vue';

import indexAssemblies from './components/catalogs/assemblies/Index.vue';

const app = createApp({});

app.component('index-assemblies', indexAssemblies);

app.mount('#app');

