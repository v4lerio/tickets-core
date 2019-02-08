<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Customer</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="create_customer">
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" placeholder="Bobs Bricks" v-model="name">
                    </div>
                    <div class="form-group">
                        <label for="organisation">Organisation (optional)</label>
                        <select class="form-control" id="organisation" v-model="organisation_id">
                            <option value="">Select One</option>
                            <option v-for="org in organisations" :key="org.id" :value="org.id">{{ org.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
                errors: null,
                name: "",
                organisation_id: "",
                organisations: []
            }
        },
        created() {
            this.axios.get('/api/organisations')
            .then(response => {
                this.organisations = response.data.data;
            });
        },
        methods: {
            create_customer() {
                this.axios.post('/api/customers', {
                    name: this.name,
                    organisation_id: this.organisation_id
                })
                .then(response => {
                    this.$router.push('/customers/' + response.data.data.id);
                })
                .catch(error => {
                    this.errors = {};
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
