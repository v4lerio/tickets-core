<template>
    <div>
        <p>This is the Organisations page.</p>
        <h4>Organisations</h4>
        <ul>
            <li v-for="org in organisations">{{ org.name }}</li>
        </ul>
    </div>
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
