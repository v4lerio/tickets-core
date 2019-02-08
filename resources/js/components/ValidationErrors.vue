<template>
    <div v-if="errors">
        <ul class="alert alert-danger">
            <em v-for="error in validationErrors">{{ error }}</em>
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

