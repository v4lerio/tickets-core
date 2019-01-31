import Vue from 'vue'
import VueRouter from 'vue-router'
import Hello from './components/Hello'
import Home from './components/Home'

Vue.use(VueRouter)

export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
    ],
})
