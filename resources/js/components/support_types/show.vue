<template>
    <div>
        <div class="d-flex justify-content-between mb-3">
            <div>
                <h3>{{ support_type.name }}</h3>
            </div>
            <div>
                <router-link tag="button" class="btn btn-outline-secondary" id="button" :to="{ name: 'support_types_edit' }"><i class="far fa-edit"></i> Edit</router-link>
                <button type="button" class="btn btn-danger" @click="delete_support_type"><i class="fas fa-trash-alt"></i> Delete</button>
            </div>
        </div>
        <div class="card shadow mb-4" v-if="support_type.children && support_type.children.length > 0">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Children</h6>
            </div>
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Support Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="child in support_type.children" :key="child.id">
                        <td>
                            <router-link :to="{ name: 'support_types_show', params: { id: child.id } }">{{ child.name }}</router-link>
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
                support_type: {}
            }
        },
        created() {
            this.axios.get('/api/support_types/' + this.$route.params.id)
            .then(response => {
                this.support_type = response.data.data;
            })
        },
        methods: {
            delete_support_type() {
                this.$swal({
                    title: 'Are you sure?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.axios.delete('/api/support_types/' + this.support_type.id).then(response => {
                            this.$swal(
                                'Deleted!',
                                this.support_type.name + ' has been deleted.',
                                'success'
                            ).then(result => {
                                this.$router.push('/support_types');
                            });
                        });
                    }
                });
            }
        }
    }
</script>
