import { createRouter, createWebHistory } from 'vue-router'


const routes = [
  {
    path:'/sucursales',
    name:'sucursales-index',
    component: () => import(/* webpackChunkName: "inventory  " */ '../modules/inventory/branches/index.vue'),
    children:[
      {
          path:'/',
          name:'layout-sucursales',
          component: () => import(/* webpackChunkName: "inventoryLayout  " */ '../modules/inventory/branches/pages/layout.vue'),
      },
      {
        path:'productos/:id',
        name:'show-product',
        component: () => import(/* webpackChunkName: "inventory  " */ '../modules/inventory/branches/pages/products.vue'),
      },
      {
        path:'',
        redirect:{name:'layout-sucursales'}
      }
    ]
  },
  {
    path:'/kardex',
    name:'kardex-index',
    component: () => import('../modules/inventory/kardex/index.vue'),
    children:[
      {
          path:'',
          name:'layout-kardex',
          component: () => import('../modules/inventory/kardex/pages/kardex.vue'),
      },
      {
        path:'',
        redirect:{name:'layout-kardex'}
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

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router

