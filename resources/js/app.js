require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import router from "./router";

import { createApp } from 'vue';

import indexKardex from './modules/inventory/kardex/index.vue';
import indexBranches from './modules/inventory/branches/index.vue';
import indexModificactionStock from './modules/inventory/modification-stock/index.vue';

/* Sales */
import indexVoucher from './modules/sales/vouchers/index.vue';
import indexQuotation from './modules/sales/quotations/index.vue';
import indexWarranty from './modules/sales/warranties/index.vue';

import indexCashbox from './modules/cashboxes/open-closed/index.vue';

import indexDashboard from './modules/dashboard/dashboard/index.vue';

/* Settings */
import indexRoles from './modules/settings/roles/index.vue';
import indexCurrencyExchanges from './modules/settings/currency-exchanges/index.vue';

const app = createApp({});

/* Sales */
app.component('index-vouchers', indexVoucher);
app.component('index-quotations', indexQuotation);
app.component('index-warranties', indexWarranty);

app.component('index-kardex', indexKardex);
app.component('index-modification-stock', indexModificactionStock);
app.component('index-branches', indexBranches);
app.component('index-cashboxes', indexCashbox);

app.component('index-dashboard', indexDashboard);

/* Settings */
app.component('index-roles', indexRoles);
app.component('index-currency-exchanges', indexCurrencyExchanges);




app.use(router).mount('#app');
