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
			<form action="<?php echo base_url('c_log/changePassword') ?>" method="POST">
				<h3 class="text-center">Reset Password <?php echo $this->session->userdata('reset_email') ?></h3>
				<div class="login-form">
					<div class="form-group form-floating-label">
						<input id="passwordreset" name="passwordreset" type="password" class="form-control input-border-bottom">
						<label for="passwordreset" class="placeholder">New Password</label>
						<?php echo form_error('passwordreset', '<small id="passwordreset" class="form-text text-muted">', '</small>') ?>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
					<div class="form-group form-floating-label">
						<input id="confirmpassword" name="confirmpassword" type="password" class="form-control input-border-bottom">
						<label for="confirmpassword" class="placeholder">Confirm Password</label>
						<?php echo form_error('confirmpassword', '<small id="confirmpassword" class="form-text text-muted">', '</small>') ?>
						<div class="show-password">
							<i class="flaticon-interface"></i>
						</div>
					</div>
					<div class="form-action">
						<button type="submit" class="btn btn-primary btn-rounded btn-login">Reset</button>
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