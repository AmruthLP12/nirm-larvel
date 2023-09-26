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
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
      <!-- /global stylesheets -->
      <!-- Core JS files -->
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/pace.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/jquery.min.js"></script>
	  <script>
	   $(document).ready(function () {
        
         $("#phone").keypress(function (e) {
        
         if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        
         
         	   return false;
         }
          });
		  
		   $("#emp_name").keypress(function (e) 
				{
					if(e.which==32)
					{
						return true;
					}
						
				else if (e.which > 31 && (e.which < 65 || e.which > 90) && (e.which < 97 || e.which > 122) || e.which==13)
					{
						return false;
					}
				}); 
         });
		$(document).ready(function(){
			$("#phone").focusout(function()
			{
				var val=$("#phone").val();
				if(val!="")
				{
					var len=val.length;
					if(len!=10)
					{
						alert("Invalid Mobile Number!");
						$("#phone").val("");
						$("#phone").focus();
					}
					
				}
			});
		});
		</script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/blockui.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/styling/uniform.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/app.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/form_inputs.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/tables/datatables/datatables.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/datatables_advanced.js"></script>
      <!-- /theme JS files -->
	  <script>
		function check_pass()
		{
			pass=$("#pass").val();
			c_pass=$("#c_pass").val();
			if(c_pass=="")
			{
				return;
			}
			if(pass!=c_pass)
			{
				alert("Password Mismatch....! Please Try Again....!");
				$("#pass").val("");
				$("#c_pass").val("");
				$("#pass").focus();
			}
		}
		
		function check_email_available()
          {
			 
           var email=$("#email").val();
		   
         		if(email!="")
         			{
         				jQuery.ajax({
         								type:"POST",
										url:"<?php echo base_url(); ?>" + "index.php/users/check_users_email_available",
         								datatype:"text",
         								data:{email:email},
         								success:function(response)
         								{
												if(response)
												{
													res=response.split("*");
													if(res=="true")
													{
														alert("Email Already exists!");
														$("#email").val("");
														$("#email").focus();
													}
													else
													{
													}
												}
         								},
         								error:function (xhr, ajaxOptions, thrownError){}
         								});
         			}
          }
		  function check_phone_available()
          {
			 
           var phone=$("#phone").val();
         		if(phone!="")
         			{
         				jQuery.ajax({
         								type:"POST",
										url:"<?php echo base_url(); ?>" + "index.php/users/check_users_phone_available",
         								datatype:"text",
         								data:{phone:phone},
         								success:function(response)
         								{
												if(response)
												{
													res=response.split("*");
													if(res=="true")
													{
														alert("Phone No Already exists!");
														$("#phone").val("");
														$("#phone").focus();
													}
												}
         								},
         								error:function (xhr, ajaxOptions, thrownError){}
         								});
         			}
          }
		  function username_available()
          {
			var u_name=$("#user_name").val();
         		if(u_name!="")
         			{
         				jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "index.php/users/client_username_available",
							datatype:"text",
							data:{u_name:u_name},
							success:function(response)
							{
								if(response)
								{
									res=response.split("*");
									if(res=="true")
									{
										alert("Username Already exists!");
										$("#user_name").val("");
										$("#user_name").focus();
									}
								}
							},
							error:function (xhr, ajaxOptions, thrownError){}
							});
         			}
          }
	  </script>
   </head>
   <body>
      <!-- Main navbar -->
      <div class="navbar navbar-inverse">
         <div class="navbar-header">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>/admin_assets/assets/logo.png" alt=""></a>
            <ul class="nav navbar-nav pull-right visible-xs-block">
               <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
               <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
         </div>
         <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
               <li>
                  <a class="sidebar-control sidebar-main-toggle hidden-xs">
                  <i class="icon-paragraph-justify3"></i>
                  </a>
               </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
             <li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<img src="assets/images/demo/users/face11.jpg" alt="">
						<span><?php echo ucwords($this->session->userdata("admin_name"));?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo site_url('home/logout');?>"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
            </ul>
         </div>
      </div>
      <!-- /main navbar -->
      <!-- Page container -->
      <div class="page-container">
         <!-- Page content -->
         <div class="page-content">
            <!-- Main sidebar -->
            <?php
              $this->load->view('admin/back_end/side_menu');
            ?>
            <!-- /main sidebar -->
            <!-- Main content -->
            <div class="content-wrapper">
               <!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Reset Password</span></h4>
                     </div>
					<div class="heading-elements">
                       
                     </div>
                   
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
               <div class="content">
                  <!-- Form horizontal -->
				<form class="form-validation" action="<?php echo site_url('home/change_psd');?>" method="POST">
                  <div class="panel panel-white" >
                     <div class="panel-body" >
                        
                           <fieldset class="content-group">
                              <legend class="text-bold">Reset Password</legend>
								<div class="col-md-3">
								</div>
								<div class="col-md-9">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label class="control-label">Username<strong style="color: red;">*</strong></label>
													<input type="text" class="form-control" name="user_name" id="user_name" placeholder="Username" autocomplete="off" required value="<?php echo $user_details[0]['user_name'];?>">
												 </div>
											</div>
										</div>
										<div class="row">	
											<div class="col-lg-6">
												<div class="form-group">
													<label class="control-label">Password<strong style="color: red;">*</strong></label>
													<input type="password" class="form-control" name="pass" id="pass" placeholder="Password" autocomplete="off" required onchange="check_pass();">
												 </div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label class="control-label">Confirm Password<strong style="color: red;">*</strong></label>
													<input type="password" class="form-control" name="c_pass" id="c_pass" placeholder="Confirm Password" autocomplete="off" required onchange="check_pass();">
												 </div>
											</div>
										</div>
										<div class="row">
											
										</div>
										<div class="row">
											<div class="text-right">
											  <button type="submit" class="btn btn-primary" name="submit_now" >Save <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
                           </fieldset>
							  
                       
                     </div>
                  </div>
				   </form>
                  <!-- /form horizontal -->
                  <!-- Footer -->
                  <div class="footer text-muted">
                     &copy; 2017. <a href="#">Mindapps</a>
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
</html>