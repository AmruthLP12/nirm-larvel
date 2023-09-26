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
	
	
	
	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/app.js"></script>
		
		<link href = "<?php echo base_url();?>/admin_assets/assets/js/date/jquery-ui.css" rel = "stylesheet">
		<script src = "<?php echo base_url();?>/admin_assets/assets/js/date/jquery-ui.js"></script>
			<script>
			 $(function() 
			 {
				$(".date").datepicker({ dateFormat: "dd-mm-yy"}).val();
			 });
		  </script>	
	
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/datatables_basic.js"></script>
		<style>
				#divLoading
					{
						display : none;
					}
					#divLoading.show
					{
						display : block;
						position : fixed;
						z-index: 100;
						background-image : url('<?php echo base_url();?>/admin_assets/assets/3.gif');
						background-color:#666;
						opacity : 0.4;
						background-repeat : no-repeat;
						background-position : center;
						left : 0;
						bottom : 0;
						right : 0;
						top : 0;
					}
					#loadinggif.show
					{
						left : 50%;
						top : 50%;
						position : absolute;
						z-index : 101;
						width : 32px;
						height : 32px;
						margin-left : -16px;
						margin-top : -16px;
					}
					div.content {
					   width : 100%;
					   height : 100%;
					}
		</style>
		<script>
		function filter_date()
		{
			job_id=$("#job_id").val();
			fdate=$("#from_date").val();
			tdate=$("#to_date").val();
			post_code=$("#post_code").val();
			
				jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "index.php/job_application/filter_date",
							datatype:"text",
							data:{job_id:job_id,fdate:fdate,tdate:tdate,post_code:post_code},
							success:function(response)
							{
								$('#get_table').empty();
								$('#get_table').append(response);
								$('.datatable-footer').css("display","none");
							},
							error:function (xhr, ajaxOptions, thrownError){}
							});
		}
		function delete_application(id)
		   {
			 r=confirm("Are you Sure Want to Delete ?");
				if(r==true)
				{
					jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "index.php/job_application/delete_job_application",
							datatype:"text",
							data:{id:id},
							success:function(response)
							{
								location.reload();
							},
							error:function (xhr, ajaxOptions, thrownError){
							
							}
							});
				}	
		   }
			function view_application_details(id)
			{
				$("div#divLoading").addClass('show');	
				jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "/job_application/view_application_details",
							datatype:"text",
							data:{id:id},
							success:function(response)
							{
								$('#student_details').empty();
								$('#student_details').append(response);
								$("div#divLoading").removeClass('show');
								$('#modal_theme_primary').modal('show');	
							},
							error:function (xhr, ajaxOptions, thrownError){}
					});
			}
		</script>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
   </head>

   
   <body>
      <div id="divLoading"> 
    </div>
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Job Application</span></h4>
                    </div>
					 <div class="heading-elements">
							<!--<div class="heading-btn-group">
								<a href="add_client.php">
									<button class="btn btn-primary" style="margin-right: 11px;">New Client</button></a>
							</div>-->
                     </div>
                     
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
			<div class="content">
					<form class="form-horizontal" action="<?php echo site_url('job_application/download_report');?>" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-flat border-top-xlg border-top-primary">
									<div class="panel-heading">
										<h6 class="panel-title"><span class="text-semibold">Filter By Applied Date</span></h6>
									</div>
									<div class="panel-body">
										<div class="form-group">
											<label class="control-label col-lg-1" style="padding-top:1%">Job</label>
											<div class="col-md-3">
												<select class="form-control" name="job_id" id="job_id" autocomplete="off" placeholder="DD-MM-YYYY"> 
													<option value="">Select</option>
													<?php 
														foreach($all_job as $res)
														{
															echo '<option value="'.$res['id'].'">'.$res['job_title'].'</option>';
														}
													?>
												</select>
											</div>	
											<label class="control-label col-lg-1" style="padding-top:1%">From Date</label>
											<div class="col-md-3">
												
												<input type="text" class="form-control date" name="pick_date" id="from_date" autocomplete="off" placeholder="DD-MM-YYYY"> 
											</div>	
											<label class="control-label col-lg-1" style="padding-top:1%">To Date</label>
											<div class="col-md-3">
												<input type="text" class="form-control date" name="to_date" id="to_date" autocomplete="off" placeholder="DD-MM-YYYY"> 
											</div>
											
										</div>
										<div class="form-group">
											<label class="control-label col-lg-1" style="padding-top:1%">Post Code</label>
											<div class="col-md-3">
												<input type="text" class="form-control" name="post_code" id="post_code" autocomplete="off" placeholder="Post Code"> 
											</div>	
											<label class="control-label col-lg-1" style="padding-top:1%"> &nbsp;</label>
											<input type="button" class="btn btn-primary" value="Search" name="search" onclick="filter_date();">
											<input type="submit" class="btn btn-primary" value="Download" name="download">
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="panel panel-flat" style="width:100%">
						<div class="panel-heading">
							<h5 class="panel-title"></h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                	</ul>
		                	</div>
						</div>
						<table class="table datatable-basic table-bordered table-hover" style="border: 1px solid #bbb;">
							<thead>
								<tr>
									<th data-orderable="false">Si</th>
									<th width="15%" data-orderable="false">Job Applied For</th>
									<th data-orderable="false">Name</th>
									<th data-orderable="false">Phone</th>
									<th width="10%" data-orderable="false">App No</th>
									<th width="10%" data-orderable="false">Ack No</th>
									<th width="15%" data-orderable="false">Applied Date</th>
									<th data-orderable="false">Date of Birth</th>
									<th data-orderable="false">More</th>
								</tr>
							</thead>
							<tbody id="get_table">
								<?php
								$i=1;
								
								foreach($job as $row)
								{
									$id=$row['id'];
									$en_id=base64_encode($id);
									echo '
											<tr>
											<td>'.$i.'</td>
											<td width="10%">'.$row['job_title'].'</td>
											<td>'.$row['name'].'</td>
											
											<td>'.$row['phone'].'</td>
											<td width="10%">'.$row['application_no'].'</td>
											<td width="10%">'.$row['ack_no'].'</td>
											<td width="15%">'.date("d-m-Y",strtotime($row['applied_date'])).'</td>
											<td>'.date("d-m-Y",strtotime($row['date_birth'])).'</td>						
											<td>
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="view_application_details(this.id)"><i class="fa fa-eye"></i> View Details</a></li>
																
															</ul>
														</li>
													</ul>
												</td>
											
											</tr>
									';
									$i++;
								}
							?>
							</tbody>
						</table>
					</div>
				</form>
			</div>
					
               <!-- /content area -->
            </div>
            <!-- /main content -->
         </div>
         <!-- /page content -->
      </div>
					<div id="modal_theme_primary" class="modal fade">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div id="student_details">
									ABC ABC
								</div>
							</div>
						</div>
					</div>
      <!-- /page container -->
   </body>
</html>