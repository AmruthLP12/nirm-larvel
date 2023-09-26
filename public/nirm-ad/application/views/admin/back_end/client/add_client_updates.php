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
	  <link href = "<?php echo base_url();?>/admin_assets/assets/js/date/jquery-ui.css" rel = "stylesheet">
		<script src = "<?php echo base_url();?>/admin_assets/assets/js/date/jquery-ui.js"></script>
			<script>
			 $(function() 
			 {
				$(".date").datepicker({ dateFormat: "dd-mm-yy"}).val();
			 });
		  </script>	
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/form_inputs.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/tables/datatables/datatables.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/pages/datatables_advanced.js"></script>
      <!-- /theme JS files -->
	  <script src='http://cdn.tinymce.com/4/tinymce.min.js'></script>
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
   <script>
		function delete_client_updates(id)
		{
				r=confirm("Are you Sure Want to Delete ?");
				if(r==true)
				{
					jQuery.ajax({
							type:"POST",
							url:"<?php echo base_url(); ?>" + "index.php/clients/delete_client_updates",
							datatype:"text",
							data:{id:id},
							success:function(response)
							{
								location.reload();
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
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Add Clients Info</span></h4>
                     </div>
					<div class="heading-elements">
                        <ul class="icons-list">
                           <li><a href="<?php echo site_url('clients/');?>"><i class="glyphicon glyphicon-search"></i></a></li>
                        </ul>
                     </div>
                   
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
               <div class="content">
                  <!-- Form horizontal -->
				<form class="form-validation" action="<?php echo site_url('clients/save_client_updates/'.$client_id);?>" method="POST">
                  <div class="panel panel-white" >
                     <div class="panel-body" >
                        
                           <fieldset class="content-group">
                              <legend class="text-bold">Add Client Info</legend>
								<div class="col-md-1">
								</div>
								<div class="col-md-11">
									<div class="container-fluid">
										<div class="row">
											<div class="col-md-6">	
												<div class="form-group">
													<label class="control-label">Date<strong style="color: red;">*</strong></label>
													<input type="text" class="form-control date" name="date" id="date" placeholder="Date" autocomplete="off" rows="12">
												 </div>
											</div>
											<div class="col-md-12">	
												<div class="form-group">
													<label class="control-label">Updates<strong style="color: red;">*</strong></label>
													<textarea class="form-control" name="description" id="description" placeholder="Client Updates" autocomplete="off" rows="12">
													</textarea>
												 </div>
											</div>
										</div>
										<div class="row">
											<div class="text-right">
											  <button type="submit" class="btn btn-primary" name="submit_now">Save <i class="icon-arrow-right14 position-right"></i></button>
											</div>
										</div>
									</div>
								</div>
                           </fieldset>
							  
                       
                     </div>
                  </div>
				   </form>
				   <form class="form-validation" action="#" method="POST">
						<div class="panel panel-white" >
							<div class="panel-body" >
								<fieldset class="content-group">
									<legend class="text-bold">Previous Client Info</legend>
								</fieldset>
								<table class="table datatable-basic table-bordered table-hover" style="border: 1px solid #bbb;">
									<thead>
										<tr>
											<th>Si</th>
											<th>Date</th>
											<th style="width:70%">Content</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody id="get_table">
										<?php 
											$i=1;
											foreach($client_info as $row)
											{
												echo '
												<tr>
													<td>'.$i.'</td>
													<td>'.date('d-m-Y',strtotime($row['date'])).'</td>
													<td>'.$row['content'].'</td>
													<td><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_client_updates(this.id)"><i class="fa fa-trash-o"></i> Delete</a></td>
												</tr>';
												$i++;
											}
										
										?>
									</tbody>
								</table>
							</div>
						</div>
					</form>
					
                  <!-- /form horizontal -->
                  <!-- Footer -->
                  <div class="footer text-muted">
                     &copy; 2018. <a href="#">Mindapps</a>
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