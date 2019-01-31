import Vue from 'vue'
import Router from './router';
import App from './components/App'

const app = new Vue({
    el: '#app',
    components: { App },
    router: Router,
});