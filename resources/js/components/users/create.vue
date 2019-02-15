<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Create User</h1>
        <p>Create a new user that can be used in your system.</p>
        <user_form></user_form>
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
