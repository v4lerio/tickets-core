<template>
    <div>
        <p>This is the Organisations show page.</p>
        <h4>{{ organisation.name }}</h4>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                organisation: {}
            }
        },
        created() {
            this.axios.get('/api/organisations/' + this.$route.params.id)
            .then(response => {
                this.organisation = response.data.data;
            })
        }
    }
</script>
