<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php echo base_url('template/'); ?>assets/img/icon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="<?php echo base_url('template/'); ?>assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Open+Sans:300,400,600,700"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
				urls: ['<?php echo base_url('template/'); ?>assets/css/fonts.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url('template/'); ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url('template/'); ?>assets/css/azzara.min.css">
</head>

<body class="login">
	<div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<form action="<?php echo base_url('c_log') ?>" method="POST">
				<h3 class="text-center">Sign In</h3>
				<?php echo $this->session->flashdata('message') ?>
				<div class="login-form">
					<div class="form-group form-floating-label">
						<input id="email" name="email" type="text" class="form-control input-border-bottom">
						<label for="email" class="placeholder">Email</label>
						<?php echo form_error('name', '<small id="name" class="form-text text-muted">', '</small>') ?>
					</div>
					<div class="form-group form-floating-label">
						<input id="password" name="password" type="password" class="form-control input-border-bottom">
						<label for="password" class="placeholder">Password</label>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
					<div class="row form-sub m-0">
						<a href="<?php echo base_url('c_log/forgotPassword') ?>" class="link float-right">Forget Password ?</a>
					</div>
					<div class="form-action mb-3">
						<button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
					</div>
					<div class="login-account">
						<span class="msg">Don't have an account yet ?</span>
						<a href="<?php echo  base_url('c_log/regis'); ?>" id="show-signup" class="link">Sign Up</a>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script src="<?php echo base_url('template/'); ?>assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?php echo base_url('template/'); ?>assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?php echo base_url('template/'); ?>assets/js/core/popper.min.js"></script>
	<script src="<?php echo base_url('template/'); ?>assets/js/core/bootstrap.min.js"></script>
	<script src="<?php echo base_url('template/'); ?>assets/js/ready.js"></script>
</body>

</html>