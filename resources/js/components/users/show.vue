<template>
    <div class="d-flex justify-content-between">
        <div>
            <h3>{{ user.name }}</h3>
        </div>
        <div>
            <router-link tag="button" class="btn btn-outline-secondary" id="button" :to="{ name: 'users_edit' }"><i class="far fa-edit"></i> Edit</router-link>
            <button type="button" class="btn btn-danger" @click="delete_user"><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {}
            }
        },
        created() {
            this.axios.get('/api/users/' + this.$route.params.id)
            .then(response => {
                this.user = response.data.data;
            })
        },
        methods: {
            delete_user() {
                this.$swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete('/api/users/' + this.user.id).then(response => {
                            this.$swal(
                                'Deleted!',
                                this.user.name + ' has been deleted.',
                                'success'
                            ).then(result => {
                                this.$router.push('/users');
                            });
                        });
                    }
                });
            }
        }
    }
</script>
