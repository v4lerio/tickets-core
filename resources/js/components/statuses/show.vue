<template>
    <div class="d-flex justify-content-between">
        <div>
            <h3>{{ status.name }}</h3>
        </div>
        <div>
            <router-link tag="button" class="btn btn-outline-secondary" id="button" :to="{ name: 'statuses_edit' }"><i class="far fa-edit"></i> Edit</router-link>
            <button type="button" class="btn btn-danger" @click="delete_status"><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                status: {}
            }
        },
        created() {
            this.axios.get('/api/statuses/' + this.$route.params.id)
            .then(response => {
                this.status = response.data.data;
            })
        },
        methods: {
            delete_status() {
                this.$swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete('/api/statuses/' + this.status.id).then(response => {
                            this.$swal(
                                'Deleted!',
                                this.status.name + ' has been deleted.',
                                'success'
                            ).then(result => {
                                this.$router.push('/statuses');
                            });
                        });
                    }
                });
            }
        }
    }
</script>
