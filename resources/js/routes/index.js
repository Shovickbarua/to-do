import { createWebHistory, createRouter } from 'vue-router'
import Login from '../pages/auth/Login.vue'
import ProductList from '../pages/products/ProductList.vue'
import ProductForm from '../pages/products/ProductForm.vue'
import Registration from '../pages/auth/Registration.vue'


const routes = [
  { path: '/', component: Login, meta: { guestOnly: true } },
  { path: '/register', component: Registration, meta: { guestOnly: true } },
  { path: '/products', component: ProductList, meta: { requiresAuth: true } },
  { path: '/products/create', component: ProductForm, meta: { requiresAuth: true } },
  { path: '/products/edit/:id', component: ProductForm, meta: { requiresAuth: true } },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from) => {
  const authed = !!localStorage.getItem('token')
  if (to.meta?.requiresAuth && !authed) {
    return '/'
  } else if (to.meta?.guestOnly && authed) {
    return '/products'
  }
})
