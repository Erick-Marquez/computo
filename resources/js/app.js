require('./bootstrap');



import router from "./router";

import { createApp } from 'vue';

import Permissions from './mixins/Permissions';
import ErrorsForm from './mixins/ErrorsForm';

import indexKardex from './modules/inventory/kardex/index.vue';
import indexBranches from './modules/inventory/branches/index.vue';
import indexModificactionStock from './modules/inventory/modification-stock/index.vue';

/* Sales */
import indexVoucher from './modules/sales/vouchers/index.vue';
import indexSaleNotes from './modules/sales/sale-notes/index.vue';
import indexQuotation from './modules/sales/quotations/index.vue';
import indexWarranty from './modules/sales/warranties/index.vue';

/* Catalogs */
import indexFamiliesLinesBrands from './modules/catalogs/families-lines-brands/index.vue';
import indexProduct from './modules/catalogs/products/index.vue';
import indexProductSeries from './modules/catalogs/product-series/index.vue';
import indexAssemblies from './modules/catalogs/assemblies/index.vue';

import indexCashbox from './modules/cashboxes/open-closed/index.vue';
import indexExpensesIncomes from './modules/cashboxes/expenses-incomes/index.vue';
import indexAccountsToPay from './modules/cashboxes/accounts-to-pay/index.vue';
import indexPurchase from './modules/purchases/purchases/index.vue';
import indexDashboard from './modules/dashboard/dashboard/index.vue';
import indexProviders from './modules/third-parties/providers/index.vue'
import indexCustomers from './modules/third-parties/customers/index.vue'

// Reportes
import indexReportCashboxes from './modules/reports/cashboxes/index.vue';
import indexReportPurchases from './modules/reports/purchases/index.vue';

/* Settings */
import indexCompany from './modules/settings/company/index.vue';
import indexUsers from './modules/settings/users/index.vue';
import indexRoles from './modules/settings/roles/index.vue';
import indexSeries from './modules/settings/series/index.vue';
import indexCurrencyExchanges from './modules/settings/currency-exchanges/index.vue';

import imageUpload from './mixins/ImageUpload.vue'

const app = createApp({});

/* Sales */
app.component('index-vouchers', indexVoucher);
app.component('index-sale-notes', indexSaleNotes);
app.component('index-quotations', indexQuotation);
app.component('index-warranties', indexWarranty);

/* Catalogs */
app.component('index-families-lines-brands', indexFamiliesLinesBrands);
app.component('index-products', indexProduct);
app.component('index-product-series', indexProductSeries);
app.component('index-assemblies', indexAssemblies);

app.component('index-kardex', indexKardex);
app.component('index-modification-stock', indexModificactionStock);
app.component('index-branches', indexBranches);
app.component('index-cashboxes', indexCashbox);
app.component('index-expenses-incomes', indexExpensesIncomes);
app.component('index-accounts-to-pay', indexAccountsToPay);
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

/* Reportes */
app.component('index-report-cashboxes', indexReportCashboxes);

/* uy */
app.component('image-upload', imageUpload)

app.mixin(Permissions);
app.mixin(ErrorsForm);
app.use(router).mount('#app')

