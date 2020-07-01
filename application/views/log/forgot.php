<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Reset Password</title>
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
			<form action="<?php echo base_url('c_log/forgotPassword') ?>" method="POST">
				<form action="<?php echo base_url('c_log/forgotPassword') ?>" method="POST">
					<h3 class="text-center">Reset Password</h3>
					<div class="login-form">
						<div class="form-group form-floating-label">
							<input id="email" name="email" type="email" class="form-control input-border-bottom">
							<label for="email" class="placeholder">Email</label>
							<?php echo form_error('email', '<small id="email" class="form-text text-muted">', '</small>') ?>
						</div>
						<div class="form-action">
							<a href="<?php echo  base_url('c_log'); ?>" id="show-signin" class="btn btn-danger btn-rounded btn-login mr-3">Cancel</a>
							<button type="submit" class="btn btn-primary btn-rounded btn-login">Reset Password</button>
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