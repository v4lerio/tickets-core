<template>
    <div v-if="errors">
        <ul class="list-group mb-4">
            <li class="list-group-item list-group-item-danger" v-for="error in validationErrors"><em>{{ error }}</em></li>
        </ul>
    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        },
        props: ['errors'],
        computed: {
            validationErrors() {
                let errors = Object.values(this.errors);
                errors = errors.flat();
                return errors;
            }
        }
    }
</script>

