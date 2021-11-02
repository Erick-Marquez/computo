require('./bootstrap');
import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.start();

import router from "./router";

import { createApp } from 'vue';

import Permissions from './mixins/Permissions';

import indexKardex from './modules/inventory/kardex/index.vue';
import indexBranches from './modules/inventory/branches/index.vue';
import indexModificactionStock from './modules/inventory/modification-stock/index.vue';

/* Sales */
import indexVoucher from './modules/sales/vouchers/index.vue';
import indexSaleNotes from './modules/sales/sale-notes/index.vue';
import indexQuotation from './modules/sales/quotations/index.vue';
import indexWarranty from './modules/sales/warranties/index.vue';

/* Catalogs */
import indexProduct from './modules/catalogs/products/index.vue';

import indexCashbox from './modules/cashboxes/open-closed/index.vue';
import indexExpensesIncomes from './modules/cashboxes/expenses-incomes/index.vue';
import indexPurchase from './modules/purchases/purchases/index.vue';
import indexDashboard from './modules/dashboard/dashboard/index.vue';
import indexProviders from './modules/third-parties/providers/index.vue'
import indexCustomers from './modules/third-parties/customers/index.vue'

/* Settings */
import indexCompany from './modules/settings/company/index.vue';
import indexUsers from './modules/settings/users/index.vue';
import indexRoles from './modules/settings/roles/index.vue';
import indexSeries from './modules/settings/series/index.vue';
import indexCurrencyExchanges from './modules/settings/currency-exchanges/index.vue';

const app = createApp({});

/* Sales */
app.component('index-vouchers', indexVoucher);
app.component('index-sale-notes', indexSaleNotes);
app.component('index-quotations', indexQuotation);
app.component('index-warranties', indexWarranty);

/* Catalogs */
app.component('index-products', indexProduct);

app.component('index-kardex', indexKardex);
app.component('index-modification-stock', indexModificactionStock);
app.component('index-branches', indexBranches);
app.component('index-cashboxes', indexCashbox);
app.component('index-expenses-incomes', indexExpensesIncomes);
app.component('index-purchases', indexPurchase);
app.component('index-dashboard', indexDashboard);
app.component('index-providers', indexProviders);
app.component('index-customers', indexCustomers);

/* Settings */
app.component('index-company', indexCompany);
app.component('index-users', indexUsers);
app.component('index-roles', indexRoles);
app.component('index-series', indexSeries);
app.component('index-currency-exchanges', indexCurrencyExchanges);




app.mixin(Permissions);
app.use(router).mount('#app');

