<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ editing ? 'Editing' : 'Create' }} Organisation</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit_organisation">
                    <div class="form-group">
                        <label for="organisation_name">Organisation Name</label>
                        <input type="text" class="form-control" id="organisation_name" placeholder="Bobs Bricks" v-model="organisation.name">
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editing ? 'Update' : 'Create' }} Organisation</button>
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
                organisation: {
                    name: "",
                }
            }
        },
        created() {
            if (this.editing) {
                this.axios.get('/api/organisations/' + this.$route.params.id)
                .then(response => {
                    this.organisation = response.data.data;
                })
            }
        },
        methods: {
            submit() {
                if (this.editing) {
                    return this.axios.patch('/api/organisations/' + this.$route.params.id, this.organisation);
                } else {
                    return this.axios.post('/api/organisations', this.organisation)
                }
            },
            submit_organisation() {
                this.submit().then(response => {
                    this.$router.push('/organisations/' + response.data.data.id);
                })
                .catch(error => {
                    this.errors = {};
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
