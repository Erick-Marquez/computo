import { createRouter, createWebHistory } from 'vue-router'


const routes = [
  {
    path:'/sucursales',
    name:'sucursales-index',
    component: () => import(/* webpackChunkName: "inventory  " */ '../modules/inventory/branches/index.vue'),
    children:[
      {
          path:'',
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

]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router

