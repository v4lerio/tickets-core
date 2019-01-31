<template>
    <div class="bg-grey h-screen px-2" id="login_background">
        <div class="container mx-auto h-full flex justify-center items-center"> <!-- container -->

            <div class="md:w-1/2 xl:w-1/3 w-full"> <!-- login card -->
                <header class="text-center p-4 text-3xl font-thin italic uppercase text-blue-lighter bg-blue rounded-lg rounded-b-none">
                    tickets-core
                </header>
                <div class="shadow-lg bg-white py-1 rounded-lg rounded-t-none">
                    <div v-if="errors.length > 0" class="text-red text-center mt-1">
                        <em v-for="error in errors">{{ error }}</em>
                    </div>
                    <form @submit.prevent="login">
                        <div class="m-6">
                            <input class="border rounded py-2 px-3 h-full w-full" type="text" placeholder="Email Address..." v-model="email" required>
                        </div>
                        <div class="m-6">
                            <input class="border rounded py-2 px-3 h-full w-full" type="password" placeholder="Password..." v-model="password" required>
                        </div>
                        <div class="m-6 text-center">
                            <button class="bg-blue hover:bg-blue-dark shadow py-3 px-12 text-white rounded-full" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: "",
                password: "",
                errors: []
            }
        },
        methods: {
            login() {
                this.axios.post('api/login', {
                    email: this.email,
                    password: this.password
                })
                .then(response => {

                })
                .catch(error => {
                    this.errors = [];
                    this.errors.push('Incorrect Username or Password.')
                });
            }
        }
    }
</script>
