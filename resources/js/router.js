import Vue from 'vue'
import VueRouter from 'vue-router'
// components
import Login from './components/Login'
import Dashboard from './components/Dashboard'

// customer components
import customers_index from './components/customers/index'
import customers_show from './components/customers/show'

// organisation components
import organisations_index from './components/organisations/index'
import organisations_show from './components/organisations/show'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/login', name: 'login', component: Login },
        { path: '/', name: 'dashboard', component: Dashboard },
        // customer routes
        { path: '/customers', name: 'customers_index', component: customers_index },
        { path: '/customers/:id', name: 'customers_show', component: customers_show },
        // organisation routes
        { path: '/organisations', name: 'organisations_index', component: organisations_index },
        { path: '/organisations/:id', name: 'organisations_show', component: organisations_show },
    ],
})

router.beforeEach((to, from, next) => {
    // if we don't have a token and we're heading to the login page. go ahead.
    if (to.name == 'login' && !localStorage.token) return next()
    // if we have a token and we're heading to the login page, redirect to root.
    if (to.name == 'login' && localStorage.token) return next('/')
    // if we don't have a token, redirect to login
    if (!localStorage.token) return next('/login')
    // continue to wherever
    return next()
})

export default router