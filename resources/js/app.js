import Vue from 'vue'
import axios from 'axios'
import VueAxios from 'vue-axios'
import Router from './router'
import App from './components/App'

const Axios = axios.create({
    timeout: 5000,
    headers: {
        'Accept': 'application/json',
        'Access-Control-Allow-Origin': '*',
        'Content-Type': 'application/json; charset=utf-8',
    },
});

axios.interceptors.request.use(function (config) {
    // TODO: Check if we have a token saved and add it on as an Authorization header.
    return config;
}, function (error) {
    return Promise.reject(error);
});

Vue.use(VueAxios, Axios)

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router,
})