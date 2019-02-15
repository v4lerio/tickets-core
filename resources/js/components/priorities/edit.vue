<template>
    <div>
        <h1 class="h3 mb-3 text-gray-800">Editing Priority</h1>
        <priority_form :editing="true"></priority_form>
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
