<template>
    <div>
        <h1 class="h3 mb-3 text-gray-800">Editing Department</h1>
        <department_form :editing="true"></department_form>
    </div>
</template>

<script>
    import department_form from './partials/department_form'
    export default {
        components: {
            department_form
        }
    }
</script>
