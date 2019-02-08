<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Organisations</h1>
        <p>A list of all the organisations in your system.</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Organisations</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Organisation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="org in organisations" :key="org.id">
                            <td>
                                <router-link :to="{ name: 'organisations_show', params: { id: org.id } }">{{ org.name }}</router-link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
