import Vue from 'vue'
import VueRouter from 'vue-router'
// components
import Login from './components/Login'
import Dashboard from './components/Dashboard'

// customer components
import customers_index from './components/customers/index'
import customers_show from './components/customers/show'
import customers_create from './components/customers/create'
import customers_edit from './components/customers/edit'

// organisation components
import organisations_index from './components/organisations/index'
import organisations_show from './components/organisations/show'
import organisations_create from './components/organisations/create'
import organisations_edit from './components/organisations/edit'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        { path: '/login', name: 'login', component: Login },
        { path: '/', name: 'dashboard', component: Dashboard },
        // customer routes
        { path: '/customers', name: 'customers_index', component: customers_index },
        { path: '/customers/create', name: 'customers_create', component: customers_create },
        { path: '/customers/:id/edit', name: 'customers_edit', component: customers_edit },
        { path: '/customers/:id', name: 'customers_show', component: customers_show },
        // organisation routes
        { path: '/organisations', name: 'organisations_index', component: organisations_index },
        { path: '/organisations/create', name: 'organisations_create', component: organisations_create },
        { path: '/organisations/:id/edit', name: 'organisations_edit', component: organisations_edit },
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