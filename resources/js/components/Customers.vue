<template>
    <div>
        <p>This is the Customers page.</p>
        <h4>Customers</h4>
        <ul>
            <li v-for="customer in customers">{{ customer.name }}</li>
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
        mounted() {
            this.axios.get('api/customers')
            .then(response => {
                this.customers = response.data.data;
            })
        }
    }
</script>
