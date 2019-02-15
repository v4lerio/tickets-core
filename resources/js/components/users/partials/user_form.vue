<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ editing ? 'Editing' : 'Create' }} User</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit_user">
                    <div class="form-group">
                        <label for="username">Full Name</label>
                        <input type="text" class="form-control" id="username" placeholder="Bob" v-model="user.name">
                    </div>
                    <div class="form-group">
                        <label for="useremail">Email Address</label>
                        <input type="text" class="form-control" id="useremail" v-model="user.email">
                    </div>
                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input type="password" class="form-control" id="userpassword" v-model="user.password">
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editing ? 'Update' : 'Create' }} User</button>
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
        props: [
            "editing"
        ],
        data() {
            return {
                errors: null,
                user: {
                    name: "",
                    email: "",
                    password: ""
                }
            }
        },
        created() {
            if (this.editing) {
                this.axios.get('/api/users/' + this.$route.params.id)
                .then(response => {
                    this.user = response.data.data;
                })
            }
        },
        methods: {
            submit() {
                if (this.editing) {
                    return this.axios.patch('/api/users/' + this.$route.params.id, this.user);
                } else {
                    return this.axios.post('/api/users', this.user)
                }
            },
            submit_user() {
                this.submit().then(response => {
                    this.$router.push('/users/' + response.data.data.id);
                })
                .catch(error => {
                    this.errors = {};
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
