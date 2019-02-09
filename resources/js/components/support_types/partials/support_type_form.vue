<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ editing ? "Editing" : "Create" }} Support Type</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit_support_type">
                    <div class="form-group">
                        <label for="support_type_name">Support Type Name</label>
                        <input type="text" class="form-control" id="support_type_name" placeholder="IT Support" v-model="support_type.name">
                    </div>
                    <div class="form-group">
                        <label for="manager">Parent Support Type (optional)</label>
                        <select class="form-control" id="manager" v-model="support_type.parent_id">
                            <option value="">Select One</option>
                            <option v-for="st in parent_support_types" :key="st.id" :value="st.id">{{ st.name }}</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editing ? "Update" : "Create" }} Support Type</button>
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
                support_type: {
                    name: "",
                    parent_id: ""
                },
                errors: null,
                parent_support_types: [],
            }
        },
        props: [
            'editing'
        ],
        created() {
            this.axios.get('/api/support_types')
            .then(response => {
                this.parent_support_types = response.data.data;
            });
            if (this.editing) {
                this.axios.get('/api/support_types/' + this.$route.params.id)
                .then(response => {
                    this.support_type = response.data.data;
                })
            }
        },
        methods: {
            submit() {
                if (this.editing) {
                    return this.axios.patch('/api/support_types/' + this.$route.params.id, this.support_type)
                } else {
                    return this.axios.post('/api/support_types', this.support_type)
                }
            },
            submit_support_type() {
                this.submit().then(response => {
                    this.$router.push('/support_types/' + response.data.data.id);
                })
                .catch(error => {
                    this.errors = {};
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
