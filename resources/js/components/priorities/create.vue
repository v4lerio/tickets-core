<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Create Priority</h1>
        <p>Create a new priority that can be used in your system.</p>
        <priority_form></priority_form>
    </div>
</template>

<script>
    import priority_form from './partials/priority_form'
    export default {
        components: {
            priority_form
        }
    }
</script>
