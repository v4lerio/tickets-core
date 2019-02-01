<template>
    <div>
        <h3>Organisations</h3>
        <table>
            <thead>
                <tr>
                    <th>Organisation</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="org in organisations">
                    <td>
                        <router-link :to="{ name: 'organisations_show', params: { id: org.id } }">{{ org.name }}</router-link>
                    </td>
                </tr>
            </tbody>
        </table>
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
