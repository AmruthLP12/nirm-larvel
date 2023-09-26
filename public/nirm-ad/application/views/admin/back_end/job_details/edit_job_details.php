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
		<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/form_multiselect.js"></script>
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
										url:"<?php echo base_url(); ?>" + "index.php/clients/check_client_email_available",
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
										url:"<?php echo base_url(); ?>" + "index.php/clients/check_client_phone_available",
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
										url:"<?php echo base_url(); ?>" + "index.php/clients/client_username_available",
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
	   <script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
	   <script>
   
   tinymce.init({
			selector: '#description',
			themes: "modern",
			plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen"],
			toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent code"
			
		  });
   
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Edit Job</span></h4>
                     </div>
					<div class="heading-elements">
                        <ul class="icons-list">
                           <li><a href="<?php echo site_url('job_details/');?>"><i class="glyphicon glyphicon-search"></i></a></li>
                        </ul>
                     </div>
                   
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
               <div class="content">
                  <!-- Form horizontal -->
				<form class="form-validation" action="<?php echo site_url('job_details/update_job_details/'.$job_details[0]['id']);?>" method="POST">
                  <div class="panel panel-white" >
                     <div class="panel-body" >
                        
                           <fieldset class="content-group">
                              <legend class="text-bold">Job Details</legend>
								<div class="col-md-1">
								</div>
								<div class="col-md-11">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">	
												<div class="form-group">
													<label class="control-label">Job Title <strong style="color: red;">*</strong></label>
													<input type="text" class="form-control required" name="job_title" id="job_title" placeholder="Job Title" value="<?php echo $job_details[0]['job_title'];?>" autocomplete="off" required>
												 </div>
											</div>
											<div class="col-md-6">	
												<div class="form-group">
													<label>Minimum Qualification</label>
													<div class="multi-select-full">
														<select name="min_qualification[]" id="min_qualification[]" class="multiselect" multiple="multiple">
															<?php
																$array=explode(",",$job_details[0]['min_qualification']);
																foreach($qualification as $res)
																{
																	if(in_array($res['id'],$array))
																	{
																		echo '<option value="'.$res['id'].'" selected>'.$res['qualification'].'</option>';		
																	}
																	else
																	{
																		echo '<option value="'.$res['id'].'">'.$res['qualification'].'</option>';
																	}
																}
																
															?>
														</select>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label class="control-label">Job Type <strong style="color: red;">*</strong></label>
													<select class="form-control required" name="job_type" id="job_type" required placeholder="Minimum Qualification" autocomplete="off" >
														<option value="">Select</option>
														<option value="Permanent" <?php if($job_details[0]['job_type']=="Permanent"){ echo "selected";}?>>Permanent</option>
														<option value="Temporary" <?php if($job_details[0]['job_type']=="Temporary"){ echo "selected";}?>>Temporary</option>
														<option value="Contract" <?php if($job_details[0]['job_type']=="Contract"){ echo "selected";}?>>Contract</option>
													</select>
												</div>
											</div>
											<div class="col-md-6">	
												<div class="form-group">
													<label class="control-label">Nature of Job <strong style="color: red;">*</strong></label>
													<input type="text" class="form-control required" name="job_nature" id="job_nature" placeholder="Nature of Job" autocomplete="off" required value="<?php echo $job_details[0]['job_nature'];?>">
												 </div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12">
												<div class="form-group">
													<label class="control-label">POST Code & Category <strong style="color: red;">*</strong></label>
													<input type="text" class="form-control required" name="post_code" id="post_code" placeholder="POST Code & Category" autocomplete="off" required value="<?php echo $job_details[0]['post_code'];?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label class="control-label">Job Description <strong style="color: red;">*</strong></label>
													<textarea class="form-control" name="description" id="description" rows="12"><?php echo $job_details[0]['job_description'];?></textarea>	
												 </div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-4">
												<div class="form-group">
													<label class="control-label">General Age Limit <strong style="color: red;">*</strong></label>
													<input type="text" class="form-control required" name="general_age" id="general_age" placeholder="Age Limit for General" autocomplete="off" value="<?php echo $job_details[0]['general_age_limit'];?>">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group">
													<label class="control-label">OBC Age Limit <strong style="color: red;">*</strong></label>
													<input type="text" class="form-control required" name="obc_age" id="obc_age" value="<?php echo $job_details[0]['obc_age_limit'];?>" placeholder="Age Limit for OBC" autocomplete="off">
												</div>
											</div>
											<div class="col-lg-4">
												<div class="form-group"> 
													<label class="control-label">SC / ST Age Limit <strong style="color: red;">*</strong></label>
													<input type="text" class="form-control required" name="sc_st_limit" id="sc_st_limit" placeholder="Age Limit for SC / ST" autocomplete="off" value="<?php echo $job_details[0]['sc_st_age_limit'];?>">
												 </div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label class="control-label">Job Posting For <strong style="color: red;">*</strong></label>
													<div class="multi-select-full">
														<select class="multiselect form-control" multiple="multiple" name="posting_for[]" id="posting_for" autocomplete="off" required>
															<option value="">Select</option>
																<?php
																	$array1=explode(",",$job_details[0]['job_posting_for']);
																	
																	if(in_array("All",$array1))
																	{
																		echo '<option value="All" selected>All</option>';		
																	}
																	else
																	{
																		echo '<option value="All">All</option>';
																	}
																	if(in_array("General",$array1))
																	{
																		echo '<option value="General" selected>General</option>';		
																	}
																	else
																	{
																		echo '<option value="General">General</option>';
																	}
																	if(in_array("OBC",$array1))
																	{
																		echo '<option value="OBC" selected>OBC</option>';		
																	}
																	else
																	{
																		echo '<option value="OBC">OBC</option>';
																	}
																	if(in_array("SC / ST",$array1))
																	{
																		echo '<option value="SC / ST" selected>SC / ST</option>';		
																	}
																	else
																	{
																		echo '<option value="SC / ST">SC / ST</option>';
																	}
																?>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group">
													<label class="control-label">Status <strong style="color: red;">*</strong></label>
													<select class="form-control required" name="status" id="status" autocomplete="off" required>
														<option value="">Select</option>
														<option value="0" <?php if($job_details[0]['status']==0){ echo "selected";}?>>Enable</option>
														<option value="1" <?php if($job_details[0]['status']==1){ echo "selected";}?>>Disable</option>
													</select>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6">
												<div class="form-group">
													<label class="control-label">Priority<strong style="color: red;">*</strong></label>
													<input type="text" class="form-control required" name="priority" id="priority" placeholder="Priority" value="<?php echo $job_details[0]['priority'];?>" autocomplete="off" required>
												</div>
											</div>
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
                     &copy; 2018. <a href="#">Webomindapps</a>
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