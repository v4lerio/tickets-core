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
    // if we don't have a token and we're heading to the login page. go ahead.
    if (to.name == 'login' && !localStorage.token) {
        return next()
    }
    // if we have a token and we're heading to the login page, redirect to root.
    if (to.name == 'login' && localStorage.token) {
        return next('/')
    }
    // if we don't have a token, redirect to login
    if (!localStorage.token) {
        return next('/login')
    }
    // continue to wherever
    return next()
})

export default router