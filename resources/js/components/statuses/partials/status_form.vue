<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ editing ? 'Editing' : 'Create' }} Status</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit_status">
                    <div class="form-group">
                        <label for="status_name">Name</label>
                        <input type="text" class="form-control" id="status_name" placeholder="Waiting on Customer" v-model="status.name">
                    </div>
                    <div class="form-group">
                        <label for="state">State</label>
                        <select class="form-control" id="state" v-model="status.state">
                            <option value="open">Open</option>
                            <option value="open">Closed</option>
                            <option value="open">Archived</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="5" placeholder="Waiting on additional information from the Customer.." v-model="status.description"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editing ? 'Update' : 'Create' }} Status</button>
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
                status: {
                    name: "",
                    description: "",
                    state: 'open'
                }
            }
        },
        created() {
            if (this.editing) {
                this.axios.get('/api/statuses/' + this.$route.params.id)
                .then(response => {
                    this.status = response.data.data;
                })
            }
        },
        methods: {
            submit() {
                if (this.editing) {
                    return this.axios.patch('/api/statuses/' + this.$route.params.id, this.status);
                } else {
                    return this.axios.post('/api/statuses', this.status)
                }
            },
            submit_status() {
                this.submit().then(response => {
                    this.$router.push('/statuses/' + response.data.data.id);
                })
                .catch(error => {
                    this.errors = {};
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
