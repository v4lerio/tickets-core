<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ editing ? "Editing" : "Create" }} Customer</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit_customer">
                    <div class="form-group">
                        <label for="customer_name">Customer Name</label>
                        <input type="text" class="form-control" id="customer_name" placeholder="Bobs Bricks" v-model="customer.name">
                    </div>
                    <div class="form-group">
                        <label for="organisation">Organisation (optional)</label>
                        <select class="form-control" id="organisation" v-model="customer.organisation_id">
                            <option value="">Select One</option>
                            <option v-for="org in organisations" :key="org.id" :value="org.id">{{ org.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editing ? "Update" : "Create" }} Customer</button>
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
                customer: {
                    name: "",
                    organisation_id: ""
                },
                errors: null,
                organisations: [],
            }
        },
        props: [
            'editing'
        ],
        created() {
            this.axios.get('/api/organisations')
            .then(response => {
                this.organisations = response.data.data;
            });
            if (this.editing) {
                this.axios.get('/api/customers/' + this.$route.params.id)
                .then(response => {
                    this.customer = response.data.data;
                })
            }
        },
        methods: {
            submit() {
                if (this.editing) {
                    return this.axios.patch('/api/customers/' + this.$route.params.id, this.customer)
                } else {
                    return this.axios.post('/api/customers', this.customer)
                }
            },
            submit_customer() {
                this.submit().then(response => {
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
