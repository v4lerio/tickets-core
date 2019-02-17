<template>
    <div class="d-flex justify-content-between">
        <div>
            <h3>{{ organisation.name }}</h3>
        </div>
        <div>
            <router-link tag="button" class="btn btn-outline-secondary" id="button" :to="{ name: 'organisations_edit' }"><i class="far fa-edit"></i> Edit</router-link>
            <button type="button" class="btn btn-danger" @click="delete_organisation"><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                organisation: {}
            }
        },
        created() {
            this.axios.get('/api/organisations/' + this.$route.params.id)
            .then(response => {
                this.organisation = response.data.data;
            })
        },
        methods: {
            delete_organisation() {
                this.$swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete('/api/organisations/' + this.organisation.id).then(response => {
                            this.$swal(
                                'Deleted!',
                                this.organisation.name + ' has been deleted.',
                                'success'
                            ).then(result => {
                                this.$router.push('/organisations');
                            });
                        });
                    }
                });
            }
        }
    }
</script>
