<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Create Customer</h1>
        <p>Create a new customer that can be used in your system.</p>
        <customer_form></customer_form>
    </div>
</template>

<script>
    import customer_form from './partials/customer_form'
    export default {
        components: {
            customer_form
        }
    }
</script>
