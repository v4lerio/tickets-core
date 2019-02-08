<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create Organisation</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="create_organisation">
                    <div class="form-group">
                        <label for="organisation_name">Organisation Name</label>
                        <input type="text" class="form-control" id="organisation_name" placeholder="Bobs Bricks" v-model="name">
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
            }
        },
        methods: {
            create_organisation() {
                this.axios.post('/api/organisations', {
                    name: this.name,
                })
                .then(response => {
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
