import { createWebHistory, createRouter } from 'vue-router'
import Login from '../pages/auth/Login.vue'
import TodoList from '../pages/todos/TodoList.vue'
import TodoForm from '../pages/todos/TodoForm.vue'
import Registration from '../pages/auth/Registration.vue'


const routes = [
  { path: '/', component: Login, meta: { guestOnly: true } },
  { path: '/register', component: Registration, meta: { guestOnly: true } },
  { path: '/todos', component: TodoList, meta: { requiresAuth: true } },
  { path: '/todos/create', component: TodoForm, meta: { requiresAuth: true } },
  { path: '/todos/edit/:id', component: TodoForm, meta: { requiresAuth: true } },
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
    return '/todos'
  }
})
