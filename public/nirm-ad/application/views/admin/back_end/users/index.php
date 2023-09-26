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
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/datatables_basic.js"></script>

		<script>
		   function delete_users(id)
		   {
			 r=confirm("Are you Sure Want to Delete ?");
				if(r==true)
				{
					jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "index.php/users/delete_users",
							datatype:"text",
							data:{id:id},
							success:function(response)
							{
								$('#get_table').empty();
								$('#get_table').append(response);
							},
							error:function (xhr, ajaxOptions, thrownError){}
							});
				}	
		   }
		   function show_common_message()
		   {
			   $('#modal_theme_primary1').modal('show');
		   }
		</script>
		<script src='https://cdn.tinymce.com/4/tinymce.min.js'></script>
	   <script>
   
   tinymce.init({
			selector: '#description',
			themes: "modern",
			height : "240",
			plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen"],
			toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent code"
			
		  });
   
   </script> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
   </head>

   
   <body>
      <div id="divLoading"> 
    </div>
	      <div class="navbar navbar-inverse">
         <div class="navbar-header">
            <a class="navbar-brand" href="index.php#"><img src="<?php echo base_url();?>/admin_assets/assets/logo.png" alt=""></a>
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Users</span></h4>
                    </div>
					 <div class="heading-elements">
							<div class="heading-btn-group">
								<a href="<?php echo site_url('users/add_new');?>">
									<button class="btn btn-primary" style="margin-right: 11px;">New User</button></a>
								<a href="javascript:void(0);">
									<button class="btn btn-primary" style="margin-right: 11px;" onclick="show_common_message();">Common Message</button></a>
							</div>
                     </div>
                    
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
			<div class="content">
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
									<th>Si</th>
									<th>Full Name</th>
									<th>Username</th>
									<th>Password</th>
									<th>Email</th>
									<th>Phone</th>
									<th>More</th>
								</tr>
							</thead>
							<tbody id="get_table">
								<?php
								$i=1;
								
								foreach($users as $row)
								{
									$id=$row['id'];
									$en_id=base64_encode($id);
									echo '
											<tr>
											<td>'.$i.'</td>
											<td>'.$row['full_name'].'</td>
											<td>'.$row['username'].'</td>
											<td>'.$row['psd'].'</td>
											<td>'.$row['email'].'</td>
											<td>'.$row['phone'].'</td>						
											<td>
													<ul class="icons-list">
														<li class="dropdown">
															<a href="#" class="dropdown-toggle" data-toggle="dropdown">
																<i class="icon-menu9"></i>
															</a>
															<ul class="dropdown-menu dropdown-menu-right">
																<li><a href="'.site_url('users/update_users_info/'.$row['id']).'"><i class="fa fa-upload" aria-hidden="true"></i> Update Info</a></li>
																<li><a href="'.site_url('users/edit_user/'.$row['id']).'"><i class="fa fa-pencil"></i> Edit Details</a></li>
																<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_users(this.id)"><i class="fa fa-trash-o"></i> Delete</a></li>
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
				<div id="modal_theme_primary1" class="modal fade">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h5 class="modal-title">Users Common Information</h5>
							</div>
							<hr>
							<form id="my_form" action="<?php echo site_url('users/update_common_message');?>" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group">
										<div class="row">
											<div class="col-sm-12">
												<label>Users Information</label>
												
												<textarea placeholder="Client Information" name="user_msg" id="description" rows="7" class="form-control" autocomplete="off" >
												<?php echo $common_msg[0]['message'];?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
            </div>
         </div>
      </div>
   </body>
</html>