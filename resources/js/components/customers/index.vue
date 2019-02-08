<template>
    <div>
        <h1 class="h3 mb-2 text-gray-800">Customers</h1>
        <p>A list of all the customers in your system.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
            </div>
            <table class="table table-bordered table-sm mb-0">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Organisation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="customer in customers" :key="customer.id">
                        <td>
                            <router-link :to="{ name: 'customers_show', params: { id: customer.id } }">{{ customer.name }}</router-link>
                        </td>
                        <td>
                            <span v-if="customer.organisation">{{ customer.organisation.name }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                customers: []
            }
        },
        created() {
            this.axios.get('/api/customers')
            .then(response => {
                this.customers = response.data.data;
            })
        }
    }
</script>
