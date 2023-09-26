<?php
?>	
<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><!--<img src="../assets/images/logo3.png" alt="">--></a>
								<div class="media-body">
									<h6>Administrator</h6>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->
					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<!-- Main -->
								<li class="navigation-header"><span>MENU DETAILS</span> <i class="icon-menu" title="Main pages"></i></li>
								<li><a href="<?php echo site_url('home/dashboard/');?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<li><a href="<?php echo site_url('qualification/');?>"><i class="icon-stack2"></i> <span>Qualification</span></a></li>
								<li><a href="<?php echo site_url('job_details/');?>"><i class="icon-stack2"></i> <span>Job Details</span></a></li>
								<li><a href="<?php echo site_url('clients/');?>"><i class="icon-stack2"></i> <span>Client Creation</span></a></li>
								<li><a href="<?php echo site_url('users/');?>"><i class="icon-stack2"></i> <span>User Creation</span></a></li>
								<li><a href="<?php echo site_url('job_application/');?>"><i class="icon-stack2"></i> <span>Job Application</span></a></li>
								<li><a href="<?php echo site_url('registered_candidates/');?>"><i class="icon-stack2"></i> <span>Registered Candidates</span></a></li>
								<li>
									<a href="#"><i class="icon-stack2"></i> <span>Settings</span></a>
									<ul>
										<li><a href="<?php echo site_url('home/reset_password');?>"><i class="icon-arrow-right5"></i> <span>Reset Password</span></a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>