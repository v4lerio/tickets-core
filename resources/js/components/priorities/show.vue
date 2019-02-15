<template>
    <div class="d-flex justify-content-between">
        <div>
            <h3>{{ priority.name }}</h3>
        </div>
        <div>
            <router-link tag="button" class="btn btn-outline-secondary" id="button" :to="{ name: 'priorities_edit' }"><i class="far fa-edit"></i> Edit</router-link>
            <button type="button" class="btn btn-danger" @click="delete_priority"><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                priority: {}
            }
        },
        created() {
            this.axios.get('/api/priorities/' + this.$route.params.id)
            .then(response => {
                this.priority = response.data.data;
            })
        },
        methods: {
            delete_priority() {
                this.$swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete('/api/priorities/' + this.priority.id).then(response => {
                            this.$swal(
                                'Deleted!',
                                this.priority.name + ' has been deleted.',
                                'success'
                            ).then(result => {
                                this.$router.push('/priorities');
                            });
                        });
                    }
                });
            }
        }
    }
</script>
