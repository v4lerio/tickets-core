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

// department components
import departments_index from './components/departments/index'
import departments_show from './components/departments/show'
import departments_create from './components/departments/create'
import departments_edit from './components/departments/edit'

// support type components
import support_types_index from './components/support_types/index'
import support_types_show from './components/support_types/show'
import support_types_create from './components/support_types/create'
import support_types_edit from './components/support_types/edit'

// priority components
import priorities_index from './components/priorities/index'
import priorities_show from './components/priorities/show'
import priorities_create from './components/priorities/create'
import priorities_edit from './components/priorities/edit'

// user components
import users_index from './components/users/index'
import users_show from './components/users/show'
import users_create from './components/users/create'
import users_edit from './components/users/edit'

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
        // department routes
        { path: '/departments', name: 'departments_index', component: departments_index },
        { path: '/departments/create', name: 'departments_create', component: departments_create },
        { path: '/departments/:id/edit', name: 'departments_edit', component: departments_edit },
        { path: '/departments/:id', name: 'departments_show', component: departments_show },
        // support type routes
        { path: '/support_types', name: 'support_types_index', component: support_types_index },
        { path: '/support_types/create', name: 'support_types_create', component: support_types_create },
        { path: '/support_types/:id/edit', name: 'support_types_edit', component: support_types_edit },
        { path: '/support_types/:id', name: 'support_types_show', component: support_types_show },
        // support type routes
        { path: '/priorities', name: 'priorities_index', component: priorities_index },
        { path: '/priorities/create', name: 'priorities_create', component: priorities_create },
        { path: '/priorities/:id/edit', name: 'priorities_edit', component: priorities_edit },
        { path: '/priorities/:id', name: 'priorities_show', component: priorities_show },
        // users routes
        { path: '/users', name: 'users_index', component: users_index },
        { path: '/users/create', name: 'users_create', component: users_create },
        { path: '/users/:id/edit', name: 'users_edit', component: users_edit },
        { path: '/users/:id', name: 'users_show', component: users_show },
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