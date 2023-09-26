 <script type="text/javascript" src="js/webo.js"></script>
  <style>
.top-bar a, .top-bar span{padding: 0px 6px 2px 0px;}

</style>
  
  <style>
			/* The Modal (background) */
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 9999; /* Sit on top */
				padding-top: 100px; /* Location of the box */
				
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
				background-color: #fefefe;
				margin: auto;
				padding: 20px;
				padding-bottom: 0%;
				border: 1px solid #888;
				    border-radius: 2%;
				width: 40%;
			}

			/* The Close Button */
			.close {
				color: #aaaaaa;
				float: right;
				font-size: 28px;
				font-weight: bold;
			}

			.close:hover,
			.close:focus {
				color: #000;
				text-decoration: none;
				cursor: pointer;
			}
	</style>

<style>
		@media only screen and (max-width: 768px) 
		{
			/* For mobile phones: */
			.modal-content 
			{
				width: 80%;
			}
		}
</style>
  
  
  
  
  <div class="cell-6 right-bar">
                            <ul class="left">
                                <li><a href="#"><i class="fa fa-newspaper-o"></i>Publications</a></li>
                                <li><a href="#"><i class="fa fa-book"></i>	Library </a></li>
                                <li><a href="http://www.nirm.in/information-cell.php"><i class="fa fa-bookmark"></i>RTI  </a></li>
                                <li><a href="#"><i class="fa fa-file-text-o"></i>Tenders</a></li>
                                <li><a href="#"><i class="fa fa-desktop"></i>e-Portal</a></li>
                                <li><a href="#"><i class="fa fa-male"></i>Employee Section</a></li>
                                <li><a href="mailto:webmaster.nirm@gmail.com"><i class="fa fa-envelope"></i>Webmaster</a></li>
                            </ul>
                        </div>
                        <div class="cell-5 right-bar">
						
						   <ul class="right">
								 <?php
									if($this->session->userdata('candidate_login'))
									{
											echo '<li><a href="'.site_url('home/logout').'"><i class="fa fa-sign-out" aria-hidden="true"></i>'.$this->session->userdata('candidate_name').', Logout</a></li>';
										
									}
								?>
                            </ul>
                        </div>
		
			<div id="myModal" class="modal">
				<div class="modal-content">
					<span class="close" onclick="close_popup();" style="color: #000;">&times;</span>		  
						 <div class="contact-form" id="contact" style="width:100%;padding: 2px 13px;">
                                <h3 class="block-head" style="margin-bottom: 10px;padding: 0 0 4px;">Client LogIn</h3>
                                <form class="" method="post" action="sendmail.php"  autocomplete="on">
                                    <div class="form-input">
                                        <label>Username<span class="red">*</span></label>
                                       <input type="text" required="required" name="username" id="username" autocomplete="off">
                                    </div>
                                   
                                    <div class="form-input" style="margin: 0 0 10px 0;">
                                        <label>Password<span class="red">*</span></label>
                                        <input type="password" required="required" name="password" id="password" autocomplete="off">
                                    </div>
									
                                    <div class="form-input" style="margin: 0px 0 15px 0;">
                                        <input type="button" onclick="login();" name="submit"  id="submit" style="font-size: 15px;" class="btn btn-large main-bg" value="Login">
                                    </div>
                                </form>
                            </div>
				</div>
			</div>
		<script>
				
		</script>