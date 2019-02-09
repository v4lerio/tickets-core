<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ editing ? "Editing" : "Create" }} Department</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit_department">
                    <div class="form-group">
                        <label for="department_name">Department Name</label>
                        <input type="text" class="form-control" id="department_name" placeholder="1st Line Support" v-model="department.name">
                    </div>
                    <div class="form-group">
                        <label for="manager">Manager (optional)</label>
                        <select class="form-control" id="manager" v-model="department.manager_id">
                            <option value="">Select One</option>
                            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editing ? "Update" : "Create" }} department</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import ValidationErrors from './../../../components/ValidationErrors';
    export default {
        components: {
            ValidationErrors
        },
        data() {
            return {
                department: {
                    name: "",
                    manager_id: ""
                },
                errors: null,
                users: [],
            }
        },
        props: [
            'editing'
        ],
        created() {
            this.axios.get('/api/users')
            .then(response => {
                this.users = response.data.data;
            });
            if (this.editing) {
                this.axios.get('/api/departments/' + this.$route.params.id)
                .then(response => {
                    this.department = response.data.data;
                })
            }
        },
        methods: {
            submit() {
                if (this.editing) {
                    return this.axios.patch('/api/departments/' + this.$route.params.id, this.department)
                } else {
                    return this.axios.post('/api/departments', this.department)
                }
            },
            submit_department() {
                this.submit().then(response => {
                    this.$router.push('/departments/' + response.data.data.id);
                })
                .catch(error => {
                    this.errors = {};
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
