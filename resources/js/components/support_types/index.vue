<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Support Types</h1>
        <p>A list of all the support types in your system.</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Support Types</h6>
            </div>
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="st in support_types" :key="st.id">
                        <td>
                            <router-link :to="{ name: 'support_types_show', params: { id: st.id } }">{{ st.name }}</router-link>
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
                support_types: []
            }
        },
        created() {
            this.axios.get('/api/support_types')
            .then(response => {
                this.support_types = response.data.data;
            })
        }
    }
</script>
