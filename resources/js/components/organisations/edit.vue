<template>
    <div>
        <h1 class="h3 mb-3 text-gray-800">Editing Organisation</h1>
        <organisation_form :editing="true"></organisation_form>
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
