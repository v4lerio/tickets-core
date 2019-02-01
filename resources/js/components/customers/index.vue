<template>
    <div>
        <p>This is the Customers page.</p>
        <h4>Customers</h4>
        <ul>
            <li v-for="customer in customers">
                <router-link :to="{ name: 'customers_show', params: { id: customer.id } }">{{ customer.name }}</router-link>
                <em v-if="customer.organisation">- {{ customer.organisation.name }}</em>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customers: []
            }
        },
        created() {
            this.axios.get('/api/customers')
            .then(response => {
                this.customers = response.data.data;
            })
        }
    }
</script>
