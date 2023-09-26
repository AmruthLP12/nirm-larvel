<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Panel</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/colors.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/pickers/daterangepicker.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/dashboard.js"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/charts/google/bars/column.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/charts/google/pies/3d_exploded.js"></script>
	<!-- /theme JS files -->
      <style>
         a {
         color: #ffffff;
         text-decoration: none;
         }
         .bg-pink-400 {
         background-color: #ec4040;
         border-color: #ec4040;
         color: #fff;
         }
         a:focus, a:hover {
         color: #000000;
         text-decoration: none;
         }
         .bg-teal-400 {
         background-color: #5d85af;
         border-color: #26A69A;
         color: #fff;
         }
         .bg-green-400 {
         background-color: #62af5d;
         border-color: #9CCC65;
         color: #fff;
         }
      </style>
</head>

<body>
	<?php $this->load->view('admin/back_end/top_menu');?>

	<!-- Page container -->
	<div class="page-container">
			<div class="page-content">
				<?php $this->load->view('admin/back_end/side_menu');?>

					<div class="content-wrapper">
						<div class="page-header">
							<div class="page-header-content">
								<div class="page-title">
									<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
								</div>
								
								
							</div>
						</div>
	

					</div>
			</div>
	</div>
			<!-- /main content -->
</body>

</html>
