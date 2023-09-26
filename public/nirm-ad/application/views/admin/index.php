<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/login_background.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2016 15:22:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/styling/uniform.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/login.js"></script>
	<!-- /theme JS files -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>

<body class="bg-slate-800">

	<!-- Page container -->
	<div class="page-container login-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Advanced login -->
					<form action="<?php echo site_url('home/process_login');?>" method="POST">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-warning-400 text-warning-400"><img src="<?php echo base_url();?>/admin_assets/assets/logo_1.png" width="200"></i></div>
								<h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
							</div>
							
							
									<?php
										if($this->session->flashdata('abc'))
											{
									?>
											<div class="alert bg-danger alert-styled-left">
											<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
											<span class="text-semibold" style="color:white;">Opps! Invalid username or Password !	</span>						
											</div>
									<?php	
											}
									?>
									<?php
										if($this->session->flashdata('xyz'))
											{
									?>
											<div class="alert bg-danger alert-styled-left">
											<button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
											<span class="text-semibold" style="color:white;">Opps! Recaptcha failed try again !	</span>			
											</div>
									<?php	
											}
									?>				
							<div class="form-group has-feedback has-feedback-left">
								<input type="text" name="username" class="form-control" placeholder="Username" required>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="password" class="form-control" placeholder="Password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group login-options">
								<div class="row">
									<div class="col-sm-6">
										
									</div>
								</div>
							</div>

							
							<div class="form-group">
								<button type="submit" class="btn bg-blue btn-block">Login <i class="icon-circle-right2 position-right"></i></button>
							</div>

						</div>
					</form>
					<!-- /advanced login -->


					<!-- Footer -->
					<div class="footer text-white">
						&copy; 2018. <a href="http://webomindapps.com/" target="_blank" class="text-blue">Webomindapps</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>

<!-- Mirrored from demo.interface.club/limitless/layout_1/LTR/login_background.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 09 Jan 2016 15:22:12 GMT -->
</html>
