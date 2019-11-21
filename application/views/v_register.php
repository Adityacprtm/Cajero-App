<div class="container">

	<div class="card o-hidden border-0 shadow-lg my-5">
		<div class="card-body p-0">
			<!-- Nested Row within Card Body -->
			<div class="row">
				<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
				<div class="col-lg-7">
					<div class="p-5">
						<div class="text-center">
							<h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
						</div>

						<?php if ($this->session->flashdata('error')) : ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<small><?php echo $this->session->flashdata('error'); ?></small>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif; ?>

						<?php if ($this->session->flashdata('success')) : ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<?php echo $this->session->flashdata('success'); ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						<?php endif; ?>

						<form class="user" action="<?php echo base_url('register/signup') ?>" method="post">
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="text" name="nama-depan" class="form-control form-control-user" placeholder="Nama Depan" required>
								</div>
								<div class="col-sm-6">
									<input type="text" name="nama-belakang" class="form-control form-control-user" placeholder="Nama Belakang" required>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="username" class="form-control form-control-user" placeholder="Username" required>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 mb-3 mb-sm-0">
									<input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
								</div>
								<div class="col-sm-6">
									<input type="password" name="repassword" class="form-control form-control-user" placeholder="Repeat Password" required>
								</div>
							</div>
							<input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
							<!-- <hr>
							<a href="index.html" class="btn btn-google btn-user btn-block">
								<i class="fab fa-google fa-fw"></i> Register with Google
							</a>
							<a href="index.html" class="btn btn-facebook btn-user btn-block">
								<i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
							</a> -->
						</form>
						<hr>
						<!-- <div class="text-center">
							<a class="small" href="<?php echo base_url('forgot-password') ?>">Forgot Password?</a>
						</div> -->
						<div class="text-center">
							<a class="small" href="<?php echo base_url('login') ?>">Already have an account? Login!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>