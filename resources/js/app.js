import 'bootstrap'
import './sb-admin-2'
import _ from 'lodash';
import jwt from 'jsonwebtoken';

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

Vue.mixin({
    methods: {
        logged_in() {
            if (localStorage.token && jwt.decode(localStorage.token)) {
                const decoded = jwt.decode(localStorage.token);
                const now = new Date();
                if (now.getTime() < decoded.exp * 1000) {
                    return true;
                } else {
                    localStorage.removeItem("token");
                    this.$router.push('/login');
                    return false;
                }
            }
            return false;
        },
        refresh_token() {
            this.axios.post('/api/refresh')
                .then(response => {
                    localStorage.token = response.data.access_token;
                    this.setup_token_refresh();
                })
                .catch(error => {
                    console.log("Unable to refresh API token.")
                });
        },
        setup_token_refresh() {
            if (localStorage.token && jwt.decode(localStorage.token)) {
                const decoded = jwt.decode(localStorage.token);
                const now = new Date();
                const expiry = (decoded.exp * 1000);
                const expires_in = (expiry - now);
                setTimeout(this.refresh_token, expires_in - (10 * 1000));
            }
        }
    }
})

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router,
})

