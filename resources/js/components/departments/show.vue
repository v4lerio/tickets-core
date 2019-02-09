<template>
    <div class="d-flex justify-content-between">
        <div>
            <h3>{{ department.name }}</h3>
        </div>
        <div>
            <router-link tag="button" class="btn btn-outline-secondary" id="button" :to="{ name: 'departments_edit' }"><i class="far fa-edit"></i> Edit</router-link>
            <button type="button" class="btn btn-danger" @click="delete_department"><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                department: {}
            }
        },
        created() {
            this.axios.get('/api/departments/' + this.$route.params.id)
            .then(response => {
                this.department = response.data.data;
            })
        },
        methods: {
            delete_department() {
                this.$swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete('/api/departments/' + this.department.id).then(response => {
                            this.$swal(
                                'Deleted!',
                                this.department.name + ' has been deleted.',
                                'success'
                            ).then(result => {
                                this.$router.push('/departments');
                            });
                        });
                    }
                });
            }
        }
    }
</script>
