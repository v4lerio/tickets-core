<template>
    <div>
        <h3>{{ organisation.name }}</h3>
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
