<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Create Status</h1>
        <p>Create a new status that can be used in your system.</p>
        <status_form></status_form>
    </div>
</template>

<script>
    import status_form from './partials/status_form'
    export default {
        components: {
            status_form
        }
    }
</script>
