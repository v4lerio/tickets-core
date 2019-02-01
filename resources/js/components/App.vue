<template>
    <div>
        <div v-if="logged_in()">
            <h1>Tickets-Core</h1>
            <p>
                <router-link :to="{ name: 'dashboard' }">Dashboard</router-link> |
                <router-link :to="{ name: 'customers' }">Customers</router-link> |
                <router-link :to="{ name: 'organisations' }">Organisations</router-link>
            </p>
        </div>
        <div class="font-sans">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            logged_in() {
                if (localStorage.token) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
</script>
