<template>
    <p>This is the Organisations page.</p>
</template>

<script>
    export default {
        data() {
            return {
                organisations: []
            }
        },
        mounted() {
            this.axios.get('api/organisations')
            .then(response => {
                this.organisations = response.data.data;
            })
        }
    }
</script>
