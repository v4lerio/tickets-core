import 'bootstrap'
import './sb-admin-2'

import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Router from './router'
import App from './components/App'
import VueSweetalert2 from 'vue-sweetalert2';


const Axios = axios.create({
    timeout: 5000,
    headers: {
        'Accept': 'application/json',
        'Access-Control-Allow-Origin': '*',
        'Content-Type': 'application/json; charset=utf-8',
    },
});

Axios.interceptors.request.use(config => {
    if (localStorage.token) {
        config.headers.authorization = "Bearer " + localStorage.getItem("token");
    }
    return config;
}, error => {
    return Promise.reject(error);
});

Vue.use(VueAxios, Axios);
Vue.use(VueSweetalert2);

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router,
})

