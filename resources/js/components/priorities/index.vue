<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Priorities</h1>
        <p>A list of all the priorities in your system.</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Priorities</h6>
            </div>
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Urgency</th>
                        <th>Colour</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="priority in priorities" :key="priority.id">
                        <td>
                            <router-link :to="{ name: 'priorities_show', params: { id: priority.id } }">{{ priority.name }}</router-link>
                        </td>
                        <td>
                            {{ priority.urgency }}
                        </td>
                        <td :style="'background-color:' + priority.colour">

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
                priorities: []
            }
        },
        created() {
            this.axios.get('/api/priorities')
            .then(response => {
                this.priorities = response.data.data;
            })
        }
    }
</script>
