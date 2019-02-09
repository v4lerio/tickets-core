<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Create Support Type</h1>
        <p>Create a new support type that can be used in your system.</p>
        <support_type_form></support_type_form>
    </div>
</template>

<script>
    import support_type_form from './partials/support_type_form'
    export default {
        components: {
            support_type_form
        }
    }
</script>
