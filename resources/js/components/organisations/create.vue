<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Create Organisation</h1>
        <p>Create a new organisation that can be used in your system.</p>
        <organisation_form></organisation_form>
    </div>
</template>

<script>
    import organisation_form from './partials/organisation_form'
    export default {
        components: {
            organisation_form
        }
    }
</script>
