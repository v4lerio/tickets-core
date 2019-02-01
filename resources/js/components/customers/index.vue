<template>
    <div>
        <h3>Customers</h3>
        <table>
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Organisation</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers">
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
