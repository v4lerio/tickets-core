import Vue from 'vue'
import VueRouter from 'vue-router'
// components
import Home from './components/Home'
import Login from './components/Login'
import Hello from './components/Hello'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
    ],
})

router.beforeEach((to, from, next) => {
    if (to.name == "login") {
        return next()
    }
    return next('/login')
})

export default router