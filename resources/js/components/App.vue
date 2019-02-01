<template>
    <div v-if="logged_in()">
        <nav class="font-sans flex flex-col text-center sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-blue shadow-lg sm:items-baseline w-full">
            <div class="mb-2 sm:mb-0 font-thin italic uppercase text-grey-lighter">
                <span>TICKETS-CORE</span>
            </div>
            <div>
                <router-link class="no-underline text-grey-lighter mx-4" :to="{ name: 'dashboard' }">Dashboard</router-link>
                <router-link class="no-underline text-grey-lighter mx-4" :to="{ name: 'customers_index' }">Customers</router-link>
                <router-link class="no-underline text-grey-lighter mx-4" :to="{ name: 'organisations_index' }">Organisations</router-link>
            </div>
        </nav>
        <div class="bg-white font-sans container mx-auto mt-6 rounded-lg p-6 shadow-lg">
            <router-view></router-view>
        </div>
    </div>
    <div v-else>
        <router-view></router-view>
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
