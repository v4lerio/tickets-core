<template>
    <div class="d-flex justify-content-between">
        <div>
            <h3>{{ customer.name }}</h3>
        </div>
        <div>
            <button type="button" class="btn btn-outline-secondary"><i class="far fa-edit"></i> Edit</button>
            <button type="button" class="btn btn-danger" @click="delete_customer"><i class="fas fa-trash-alt"></i> Delete</button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customer: {}
            }
        },
        created() {
            this.axios.get('/api/customers/' + this.$route.params.id)
            .then(response => {
                this.customer = response.data.data;
            })
        },
        methods: {
            delete_customer() {
                this.$swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete('/api/customers/' + this.customer.id).then(response => {
                            this.$swal(
                                'Deleted!',
                                this.customer.name + ' has been deleted.',
                                'success'
                            ).then(result => {
                                this.$router.push('/customers');
                            });
                        });
                    }
                });

            }
        }
    }
</script>
