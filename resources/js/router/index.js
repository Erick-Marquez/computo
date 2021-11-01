import { createRouter, createWebHistory } from 'vue-router'


const routes = [

    /* Sale */
    {
        path: '/ventas',
        name: 'ventas-index',
        component: () => import('../modules/sales/vouchers/index.vue'),
        children: [
            {
                path: '',
                name: 'voucher-list',
                component: () => import('../modules/sales/vouchers/pages/Vouchers.vue'),
            },
            {
                path: '/nueva-venta',
                name: 'new-voucher',
                component: () => import('../modules/sales/vouchers/pages/NewVoucher.vue'),
            },
        ]
    },
    {
        path: '/notas-de-venta',
        name: 'sale-notes-index',
        component: () => import('../modules/sales/sale-notes/index.vue'),
        children: [
            {
                path: '',
                name: 'sale-notes-list',
                component: () => import('../modules/sales/sale-notes/pages/SaleNotes.vue'),
            }
        ]
    },
    {
        path: '/cotizaciones',
        name: 'quotations-index',
        component: () => import('../modules/sales/quotations/index.vue'),
        children: [
            {
                path: '',
                name: 'quotation-list',
                component: () => import('../modules/sales/quotations/pages/Quotation.vue'),
            },
            {
                path: '/nueva-cotizacion',
                name: 'new-quotation',
                component: () => import('../modules/sales/quotations/pages/NewQuotation.vue'),
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
        component: () => import('../modules/sales/warranties/index.vue'),
        children: [
            {
                path: '',
                name: 'warranties-list',
                component: () => import('../modules/sales/warranties/pages/Warranty.vue'),
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
        component: () => import('../modules/catalogs/products/index.vue'),
        children: [
            {
                path: '',
                name: 'product-list',
                component: () => import('../modules/catalogs/products/pages/Product.vue'),
            },
            {
                path: '/nuevo-producto',
                name: 'new-product',
                component: () => import('../modules/catalogs/products/pages/NewProduct.vue'),
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
        component: () => import('../modules/inventory/branches/index.vue'),
        children: [
            {
                path: '',
                name: 'branch-list',
                component: () => import('../modules/inventory/branches/pages/Branches.vue'),
            },
            {
                path: 'productos/:id',
                name: 'show-product',
                component: () => import('../modules/inventory/branches/pages/products.vue'),
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
        component: () => import('../modules/cashboxes/open-closed/index.vue'),
        children: [
            {
                path: '',
                name: 'layout-cashbox',
                component: () => import('../modules/cashboxes/open-closed/pages/Cashbox.vue'),
            },
            {
                path: 'detalle/:id',
                name: 'show-cashbox',
                component: () => import('../modules/cashboxes/open-closed/pages/CashboxDetail.vue'),
            },
        ]
    },
    {
        path: '/egresos-ingresos',
        name: 'egresos-ingresos-index',
        component: () => import('../modules/cashboxes/expenses-incomes/index.vue'),
        children: [
            {
                path: '',
                name: 'layout-egresos-ingresos',
                component: () => import('../modules/cashboxes/expenses-incomes/pages/ExpensesIncomes.vue'),
            },
        ]
    },
    {
        path: '/dashboard',
        name: 'dashboard-index',
        component: () => import('../modules/dashboard/dashboard/index.vue'),
        children: [
            {
                path: '',
                name: 'dashboard',
                component: () => import('../modules/dashboard/dashboard/pages/Dashboard.vue'),
            },
        ]
    },

    /* Settings */
    {
        path: '/compras',
        name: 'compras-index',
        component: () => import('../modules/purchases/purchases/index.vue'),
        children: [
            {
                path: '',
                name: 'purchase-list',
                component: () => import('../modules/purchases/purchases/pages/Purchases.vue'),
            },
            {
                path: '/nueva-compra',
                name: 'new-purchase',
                component: () => import('../modules/purchases/purchases/pages/NewPurchase.vue'),
            },
        ]
    },
    {
        path: '/empresa',
        name: 'company-index',
        component: () => import('../modules/settings/company/index.vue'),
        children: [
            {
                path: '',
                name: 'company',
                component: () => import('../modules/settings/company/pages/company.vue'),
            },
            {
                path: '',
                redirect: { name: 'company' }
            }
        ]
    },
    {
        path: '/usuarios',
        name: 'users-index',
        component: () => import('../modules/settings/users/index.vue'),
        children: [
            {
                path: '',
                name: 'users',
                component: () => import('../modules/settings/users/pages/Users.vue'),
            },
            {
                path: '',
                redirect: { name: 'users' }
            }
        ]
    },
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
        path: '/series',
        name: 'serie-index',
        component: () => import('../modules/settings/series/index.vue'),
        children: [
            {
                path: '',
                name: 'series-list',
                component: () => import('../modules/settings/series/pages/Series.vue'),
            },
            {
                path: '',
                redirect: { name: 'series-list' }
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
    {
        path: '/terceros',
        name: 'terceros-index',
        component: () => import('../modules/third-parties/index.vue'),
        children: [
            {
                path: '/proveedores',
                name: 'proveedores',
                component: () => import('../modules/third-parties/providers/pages/Providers.vue'),
            },
            {
                path: '/clientes',
                name: 'clientes',
                component: () => import('../modules/third-parties/customers/pages/Customers.vue'),
            },
        ]
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router

