<template>
    <div>
        <h3>{{ customer.name }}</h3>
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
