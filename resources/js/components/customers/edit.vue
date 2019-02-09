<template>
    <div>
        <h1 class="h3 mb-3 text-gray-800">Editing Customer</h1>
        <customer_form :editing="true"></customer_form>
    </div>
</template>

<script>
    import customer_form from './partials/customer_form'
    export default {
        data() {
            return {
                customer: {}
            }
        },
        components: {
            customer_form
        },
        created() {
            this.axios.get('/api/customers/' + this.$route.params.id)
            .then(response => {
                this.customer = response.data.data;
            })
        }
    }
</script>
