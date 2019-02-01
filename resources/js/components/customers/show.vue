<template>
    <div>
        <p>This is the Customers show page.</p>
        <h4>{{ customer.name }}</h4>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customer: {}
            }
        },
        created() {
            this.axios.get('/api/customers/' + this.$route.params.id)
            .then(response => {
                this.customer = response.data.data;
            })
        }
    }
</script>
