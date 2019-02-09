<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Users</h1>
        <p>A list of all the users in your system.</p>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id">
                        <td>
                            <router-link :to="{ name: 'users_show', params: { id: user.id } }">{{ user.name }}</router-link>
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
                users: []
            }
        },
        created() {
            this.axios.get('/api/users')
            .then(response => {
                this.users = response.data.data;
            })
        }
    }
</script>
