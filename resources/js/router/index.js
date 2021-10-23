import { createRouter, createWebHistory } from 'vue-router'


const routes = [

    /* Sale */
    {
        path: '/ventas',
        name: 'ventas-index',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/sales/vouchers/index.vue'),
        children: [
            {
                path: '',
                name: 'voucher-list',
                component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/sales/vouchers/pages/Vouchers.vue'),
            },
            {
                path: '/nueva-venta',
                name: 'new-voucher',
                component: () => import(/* webpackChunkName: "inventory  " */ '../modules/sales/vouchers/pages/NewVoucher.vue'),
            },
        ]
    },
    {
        path: '/cotizaciones',
        name: 'quotations-index',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/sales/quotations/index.vue'),
        children: [
            {
                path: '',
                name: 'quotation-list',
                component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/sales/quotations/pages/Quotation.vue'),
            },
            {
                path: '/nueva-cotizacion',
                name: 'new-quotation',
                component: () => import(/* webpackChunkName: "inventory  " */ '../modules/sales/quotations/pages/NewQuotation.vue'),
            },
            {
                path: '',
                redirect: { name: 'quotation-list' }
            }
        ]
    },
    {
        path: '/garantias',
        name: 'warranties-index',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/sales/warranties/index.vue'),
        children: [
            {
                path: '',
                name: 'warranties-list',
                component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/sales/warranties/pages/Warranty.vue'),
            },
            {
                path: '',
                redirect: { name: 'warranties-list' }
            }
        ]
    },

    /* Catalogs */
    {
        path: '/productos',
        name: 'product-index',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/catalogs/products/index.vue'),
        children: [
            {
                path: '',
                name: 'product-list',
                component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/catalogs/products/pages/Product.vue'),
            },
            {
                path: '/nuevo-producto',
                name: 'new-product',
                component: () => import(/* webpackChunkName: "inventory  " */ '../modules/catalogs/products/pages/NewProduct.vue'),
            },
            {
                path: '',
                redirect: { name: 'product-list' }
            }
        ]
    },

    {
        path: '/sucursales',
        name: 'branches-index',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/inventory/branches/index.vue'),
        children: [
            {
                path: '',
                name: 'branch-list',
                component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/inventory/branches/pages/Branches.vue'),
            },
            {
                path: 'productos/:id',
                name: 'show-product',
                component: () => import(/* webpackChunkName: "inventory  " */ '../modules/inventory/branches/pages/products.vue'),
            },
            {
                path: '',
                redirect: { name: 'branch-list' }
            }
        ]
    },
    {
        path: '/kardex',
        name: 'kardex-index',
        component: () => import('../modules/inventory/kardex/index.vue'),
        children: [
            {
                path: '',
                name: 'layout-kardex',
                component: () => import('../modules/inventory/kardex/pages/kardex.vue'),
            },
            {
                path: '',
                redirect: { name: 'layout-kardex' }
            }
        ]
    },
    {
        path: '/modificacion-stock',
        name: 'modification-stock-index',
        component: () => import('../modules/inventory/modification-stock/index.vue'),
        children: [
            {
                path: '',
                name: 'layout-modification-stock',
                component: () => import('../modules/inventory/modification-stock/pages/layout.vue'),
            },
            {
                path: '',
                redirect: { name: 'layout-modification-stock' }
            }
        ]
    },
    {
        path: '/cajas',
        name: 'cajas-index',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/cashboxes/open-closed/index.vue'),
        children: [
            {
                path: '',
                name: 'layout-cashbox',
                component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/cashboxes/open-closed/pages/Cashbox.vue'),
            },
            {
                path: 'detalle/:id',
                name: 'show-cashbox',
                component: () => import(/* webpackChunkName: "inventory  " */ '../modules/cashboxes/open-closed/pages/CashboxDetail.vue'),
            },
        ]
    },
    {
        path: '/dashboard',
        name: 'dashboard-index',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/dashboard/dashboard/index.vue'),
        children: [
            {
                path: '',
                name: 'dashboard',
                component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/dashboard/dashboard/pages/Dashboard.vue'),
            },
        ]
    },

    /* Settings */
    {
        path: '/roles',
        name: 'roles-index',
        component: () => import('../modules/settings/roles/index.vue'),
        children: [
            {
                path: '',
                name: 'roles',
                component: () => import('../modules/settings/roles/pages/Roles.vue'),
            },
            {
                path: '',
                redirect: { name: 'roles' }
            }
        ]
    },
    {
        path: '/cambio-de-divisas',
        name: 'currency-exchanges-index',
        component: () => import('../modules/settings/currency-exchanges/index.vue'),
        children: [
            {
                path: '',
                name: 'currency-exchanges',
                component: () => import('../modules/settings/currency-exchanges/pages/currency-exchanges.vue'),
            },
            {
                path: '',
                redirect: { name: 'currency-exchanges' }
            }
        ]
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router

