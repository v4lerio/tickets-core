<template>
    <div>
        <h1 class="h3 mb-3 text-gray-800">Editing User</h1>
        <user_form :editing="true"></user_form>
    </div>
</template>

<script>
    import user_form from './partials/user_form'
    export default {
        components: {
            user_form
        }
    }
</script>
