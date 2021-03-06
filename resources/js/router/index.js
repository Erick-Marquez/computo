import axios from 'axios'
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
        path: '/anticipos',
        name: 'advance-payments-index',
        component: () => import('../modules/sales/advance-payments/index.vue'),
        children: [
            {
                path: '',
                name: 'advance-payments-list',
                component: () => import('../modules/sales/advance-payments/pages/AdvancePayments.vue'),
            },
            {
                path: '',
                redirect: { name: 'advance-payments-list' }
            }
        ]
    },
    {
        path: '/notas-de-credito',
        name: 'credit-notes-index',
        component: () => import('../modules/sales/credit-notes/index.vue'),
        children: [
            {
                path: '',
                name: 'credit-notes-list',
                component: () => import('../modules/sales/credit-notes/pages/CreditNotes.vue'),
            },
            {
                path: '/nueva-nota-de-credito',
                name: 'new-credit-note',
                component: () => import('../modules/sales/credit-notes/pages/NewCreditNote.vue'),
            },
        ]
    },
    {
        path: '/comunicaciones-de-baja',
        name: 'voideds-index',
        component: () => import('../modules/sales/voideds/index.vue'),
        children: [
            {
                path: '',
                name: 'voideds-list',
                component: () => import('../modules/sales/voideds/pages/Voideds.vue'),
            },
            {
                path: '',
                redirect: { name: 'voideds-list' }
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
                component: () => import('../modules/sales/warranties/pages/Warranties.vue'),
            },
            {
                path: '',
                redirect: { name: 'warranties-list' }
            }
        ]
    },

    /* Catalogs */

    {
        path: '/familias-lineas-marcas',
        name: 'families-lines-brands-index',
        component: () => import('../modules/catalogs/families-lines-brands/index.vue'),
        children: [
            {
                path: '',
                name: 'families-lines-brands-list',
                component: () => import('../modules/catalogs/families-lines-brands/pages/FamiliesLinesBrands.vue'),
            },
            {
                path: '',
                redirect: { name: 'families-lines-brands-list' }
            }
        ]
    },
    {
        path: '/producto-series',
        name: 'product-series-index',
        component: () => import('../modules/catalogs/product-series/index.vue'),
        children: [
            {
                path: '',
                name: 'product-series-list',
                component: () => import('../modules/catalogs/product-series/pages/ProductSeries.vue'),
            },
            {
                path: '',
                redirect: { name: 'product-list' }
            }
        ]
    },
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
                path: '/editar-producto/:id',
                name: 'edit-product',
                component: () => import('../modules/catalogs/products/pages/EditProduct.vue'),
            },
            {
                path: '',
                redirect: { name: 'product-list' }
            }
        ]
    },
    {
        path: '/ensamblajes',
        name: 'assemblies-index',
        component: () => import('../modules/catalogs/assemblies/index.vue'),
        children: [
            {
                path: '',
                name: 'assemblies-list',
                component: () => import('../modules/catalogs/assemblies/pages/Assemblies.vue'),
            },
            {
                path: '/nuevo-ensamblaje',
                name: 'new-assembly',
                component: () => import('../modules/catalogs/assemblies/pages/NewAssembly.vue'),
            },
            {
                path: '/editar-ensamblaje/:id',
                name: 'edit-assembly',
                component: () => import('../modules/catalogs/assemblies/pages/EditAssembly.vue'),
            },
            {
                path: '',
                redirect: { name: 'assemblies-list' }
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
                component: () => import('../modules/inventory/branches/pages/Products.vue'),
            },
            {
                path: 'productos/:id/agregar',
                name: 'add-product',
                component: () => import('../modules/inventory/branches/pages/AddProducts.vue'),
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
        path: '/editar-series',
        name: 'edit-series-index',
        component: () => import('../modules/inventory/edit-series/index.vue'),
        children: [
            {
                path: '',
                name: 'layout-edit-series',
                component: () => import('../modules/inventory/edit-series/pages/EditSeries.vue'),
            },
            {
                path: '',
                redirect: { name: 'layout-edit-series' }
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
                component: () => import('../modules/inventory/modification-stock/pages/ModificationStock.vue'),
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
                beforeEnter: (to, from, next) => {
                    axios.get(`/api/isyouropening/${to.params.id}`)
                        .then(response => {
                            console.log(response.data);
                            next();
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error!',
                                'Usted no puede ver esta apertura',
                                'error'
                            );
                            console.log(error.response.data.error);

                        })
                },
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
        path: '/cuentas-por-pagar',
        name: 'accounts-to-pay-index',
        component: () => import('../modules/cashboxes/accounts-to-pay/index.vue'),
        children: [
            {
                path: '',
                name: 'layout-accounts-to-pay',
                component: () => import('../modules/cashboxes/accounts-to-pay/pages/AccountsToPay.vue')
            }
        ],
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
    /* REPORTES */
    {
        path: '/reportes',
        name: 'reports-index',
        component: () => import('../modules/reports/index.vue'),
        children: [
            {
                path: 'cajas',
                name: 'report-cashboxes-index',
                component: () => import('../modules/reports/cashboxes/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-cashboxes',
                        component: () => import('../modules/reports/cashboxes/pages/ReportCashboxes.vue'),
                    }
                ]
            },
            {
                path: 'compras',
                name: 'report-purchases-index',
                component: () => import('../modules/reports/purchases/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-purchases',
                        component: () => import('../modules/reports/purchases/pages/ReportPurchases.vue'),
                    }
                ]
            },
            {
                path: 'ventas',
                name: 'report-sales-index',
                component: () => import('../modules/reports/sales/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-sales',
                        component: () => import('../modules/reports/sales/pages/ReportSales.vue'),
                    }
                ]
            },
            {
                path: 'detallado',
                name: 'report-details-index',
                component: () => import('../modules/reports/details/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-details',
                        component: () => import('../modules/reports/details/pages/ReportDetails.vue'),
                    }
                ]
            },
            {
                path: 'productos',
                name: 'report-products-index',
                component: () => import('../modules/reports/products/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-products',
                        component: () => import('../modules/reports/products/pages/ReportProducts.vue'),
                    }
                ]
            },
            {
                path: 'inventario',
                name: 'report-inventory-index',
                component: () => import('../modules/reports/inventory/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-inventory',
                        component: () => import('../modules/reports/inventory/pages/ReportInventory.vue'),
                    }
                ]
            },
            {
                path: 'utilidad',
                name: 'report-utility-index',
                component: () => import('../modules/reports/utility/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-utility',
                        component: () => import('../modules/reports/utility/pages/ReportUtility.vue'),
                    }
                ]
            },
            {
                path: 'series',
                name: 'report-series-index',
                component: () => import('../modules/reports/series/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-series',
                        component: () => import('../modules/reports/series/pages/ReportSeries.vue'),
                    }
                ]
            },
            {
                path: 'egresos-ingresos',
                name: 'report-expenses-incomes-index',
                component: () => import('../modules/reports/expenses-incomes/index.vue'),
                children: [
                    {
                        path: '',
                        name: 'report-expenses-incomes',
                        component: () => import('../modules/reports/expenses-incomes/pages/ReportExpensesIncomes.vue'),
                    }
                ]
            },
            {
                path: '',
                redirect: { name: 'assemblies-list' }
            }
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
                path: '/roles/:id',
                name: 'roles-permissions',
                component: () => import('../modules/settings/roles/pages/Permissions.vue'),
            },
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
        path: '/tipo-de-pagos',
        name: 'payment-types-index',
        component: () => import('../modules/settings/payment-types/index.vue'),
        children: [
            {
                path: '',
                name: 'payment-types',
                component: () => import('../modules/settings/payment-types/pages/Payment-types.vue'),
            },
            {
                path: '',
                redirect: { name: 'payment-types' }
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

