import Vue from 'vue'
import VueRouter from 'vue-router'
// components
import Login from './components/Login'
import Dashboard from './components/Dashboard'
import Customers from './components/Customers'
import Organisations from './components/Organisations'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/customers',
            name: 'customers',
            component: Customers
        },
        {
            path: '/organisations',
            name: 'organisations',
            component: Organisations
        },
    ],
})

router.beforeEach((to, from, next) => {
    if (to.name == 'login') {
        return next()
    }
    if (!localStorage.token) {
        return next('/login')
    }
    return next()
})

export default router