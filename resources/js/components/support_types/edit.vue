<template>
    <div>
        <h1 class="h3 mb-3 text-gray-800">Editing Support Type</h1>
        <support_type_form :editing="true"></support_type_form>
    </div>
</template>

<script>
    import support_type_form from './partials/support_type_form'
    export default {
        components: {
            support_type_form
        }
    }
</script>
