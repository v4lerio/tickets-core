<template>
    <div>
        <ValidationErrors :errors="errors" v-if="errors"></ValidationErrors>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ editing ? 'Editing' : 'Create' }} Priority</h6>
            </div>
            <div class="card-body">
                <form @submit.prevent="submit_priority">
                    <div class="form-group">
                        <label for="priorityname">Name</label>
                        <input type="text" class="form-control" id="priorityname" placeholder="Major Outage" v-model="priority.name">
                    </div>
                    <div class="form-group">
                        <label for="priorityurgency">Urgency <em>(1 is highest)</em></label>
                        <input type="number" class="form-control" id="priorityurgency" min=1 v-model="priority.urgency">
                    </div>
                    <div class="form-group">
                        <label for="prioritycolour">Colour</label>
                        <input type="color" class="form-control" id="prioritycolour" v-model="priority.colour">
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editing ? 'Update' : 'Create' }} Priority</button>
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
                priority: {
                    name: "",
                    urgency: "5",
                    colour: '#FFFF00'
                }
            }
        },
        created() {
            if (this.editing) {
                this.axios.get('/api/priorities/' + this.$route.params.id)
                .then(response => {
                    this.priority = response.data.data;
                })
            }
        },
        methods: {
            submit() {
                if (this.editing) {
                    return this.axios.patch('/api/priorities/' + this.$route.params.id, this.priority);
                } else {
                    return this.axios.post('/api/priorities', this.priority)
                }
            },
            submit_priority() {
                this.submit().then(response => {
                    this.$router.push('/priorities/' + response.data.data.id);
                })
                .catch(error => {
                    this.errors = {};
                    this.errors = error.response.data.errors;
                });
            }
        }
    }
</script>
