<template>
	<div class="container">
		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-sm-9 col-lg-6">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4">Welcome Back to Tickets!</h1>
									</div>
									<div v-if="errors.length > 0" class="alert alert-danger">
										<em v-for="error in errors" :key="error">{{ error }}</em>
									</div>
									<form class="user" @submit.prevent="login">
										<div class="form-group">
											<input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email Address..." autocomplete="off" v-model="email">
										</div>
										<div class="form-group">
											<input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" autocomplete="off" v-model="password">
										</div>
										<button class="btn btn-primary btn-user btn-block">
											Login
										</button>
									</form>
									<hr>
									<div class="text-center">
										<a class="small" href="forgot-password.html">Forgot Password?</a>
									</div>
								</div>
							</div>
						</div>
					</div>
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
								this.axios.post('/api/login', {
										email: this.email,
										password: this.password
								})
								.then(response => {
										localStorage.token = response.data.access_token;
										this.setup_token_refresh();
										this.$router.push('/');
								})
								.catch(error => {
										this.errors = [];
										this.errors.push('Incorrect Username or Password.')
								});
						}
				}
		}
</script>
