require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import router from "./router";

import { createApp } from 'vue';

import indexKardex from './modules/inventory/kardex/index.vue';
import indexBranches from './modules/inventory/branches/index.vue';
import indexModificactionStock from './modules/inventory/modification-stock/index.vue';

import indexCashbox from './modules/cashboxes/open-closed/index.vue';
import indexVoucher from './modules/sales/vouchers/index.vue';
import indexDashboard from './modules/dashboard/dashboard/index.vue';

const app = createApp({});

app.component('index-kardex', indexKardex);
app.component('index-modification-stock', indexModificactionStock);
app.component('index-branches', indexBranches);
app.component('index-cashboxes', indexCashbox);
app.component('index-vouchers', indexVoucher);
app.component('index-dashboard', indexDashboard);

app.use(router).mount('#app');
