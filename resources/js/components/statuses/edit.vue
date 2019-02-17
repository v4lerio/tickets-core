<template>
    <div>
        <h1 class="h3 mb-3 text-gray-800">Editing Status</h1>
        <status_form :editing="true"></status_form>
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
