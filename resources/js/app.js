require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import router from "./router";

import { createApp } from 'vue';

import indexKardex from './modules/inventory/kardex/index.vue';
import indexBranches from './modules/inventory/branches/index.vue';

const app = createApp({});

app.component('index-kardex', indexKardex);
app.component('index-branches', indexBranches);

app.use(router).mount('#app');