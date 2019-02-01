<template>
    <div>
        <p>This is the Organisations index page.</p>
        <h4>Organisations</h4>
        <ul>
            <li v-for="org in organisations">
                 <!-- <router-link :to="{ name: 'category/edit', params: { categoryId: category.id }" -->
                <router-link :to="{ name: 'organisations_show', params: { id: org.id } }">{{ org.name }}</router-link>
            </li>
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
        methods: {
            url(organisation) {
                return '/organisations/' + organisation.id;
            }
        },
        created() {
            this.axios.get('/api/organisations')
            .then(response => {
                this.organisations = response.data.data;
            })
        }
    }
</script>
