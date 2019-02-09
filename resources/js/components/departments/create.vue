<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Create Department</h1>
        <p>Create a new department that can be used in your system.</p>
        <department_form></department_form>
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
