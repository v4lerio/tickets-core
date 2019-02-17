<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Statuses</h1>
        <p>A list of all the statuses in your system.</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Statuses</h6>
            </div>
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Statuses</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="status in statuses" :key="status.id">
                        <td>
                            <router-link :to="{ name: 'statuses_show', params: { id: status.id } }">{{ status.name }}</router-link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                statuses: []
            }
        },
        created() {
            this.axios.get('/api/statuses')
            .then(response => {
                this.statuses = response.data.data;
            })
        }
    }
</script>
