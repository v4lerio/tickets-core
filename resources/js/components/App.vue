<template>
	<div v-if="logged_in()">
		<div id="wrapper">
			<admin_sidebar></admin_sidebar>
			<div id="content-wrapper" class="d-flex flex-column">
				<div id="content">
					<admin_topbar></admin_topbar>
					<router-view></router-view>
				</div>
				<admin_footer></admin_footer>
			</div>
		</div>
	</div>
	<div v-else>
		<router-view></router-view>
	</div>
</template>

<script>
		import admin_topbar from './partials/admin_topbar';
		import admin_sidebar from './partials/admin_sidebar';
		import admin_footer from './partials/admin_footer';
		export default {
				components: {
					admin_topbar,
					admin_sidebar,
					admin_footer
				},
				data() {
						return {};
								// <router-link class="no-underline text-grey-lighter mx-4" :to="{ name: 'dashboard' }">Dashboard</router-link>
								// <router-link class="no-underline text-grey-lighter mx-4" :to="{ name: 'customers_index' }">Customers</router-link>
								// <router-link class="no-underline text-grey-lighter mx-4" :to="{ name: 'organisations_index' }">Organisations</router-link>
				},
				methods: {
						logged_in() {
								if (localStorage.token) {
										return true;
								} else {
										return false;
								}
						}
				}
		}
</script>
