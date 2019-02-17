<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Departments</h1>
        <p>A list of all the departments in your system.</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Departments</h6>
            </div>
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Manager</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dept in departments" :key="dept.id">
                        <td>
                            <router-link :to="{ name: 'departments_show', params: { id: dept.id } }">{{ dept.name }}</router-link>
                        </td>
                        <td>
                            <router-link v-if="dept.manager" :to="{ name: 'users_show', params: { id: dept.manager.id } }">{{ dept.manager.name }}</router-link>
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
                departments: []
            }
        },
        created() {
            this.axios.get('/api/departments')
            .then(response => {
                this.departments = response.data.data;
            })
        }
    }
</script>
