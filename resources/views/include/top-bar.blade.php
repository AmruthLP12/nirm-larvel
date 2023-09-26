<script type="text/javascript" src="js/webo.js"></script>
  <style>
.top-bar a, .top-bar span{padding: 0px 6px 2px 0px;}
.top-bar a, .top-bar span{text-decoration:none !important;}
</style>
  
  <style>
			/* The Modal (background) */
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 9999; /* Sit on top */
				padding-top: 150px; /* Location of the box */
				
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
  
  
  <div id="abc">
  
  <div class="cell-6 right-bar">
                            <ul class="left">
                                <li><a href="publications.php"><i class="fa fa-newspaper-o"></i>Publications</a></li>
                                <li><a href="#"><i class="fa fa-book"></i>	Library </a></li>
                                <li><a href="information-cell.php"><i class="fa fa-bookmark"></i>RTI  </a></li>
                                <li><a href="icc-women.php"><i class="fa fa-bookmark"></i>ICC(Women)</a></li>
                                <li><a href="Tender_Notice.php"><i class="fa fa-file-text-o"></i>Tenders</a></li>
                                <li><a href="#"><i class="fa fa-desktop"></i>e-Portal</a></li>
                                <li><a href="#"><i class="fa fa-male"></i>Employee Section</a></li>
                                <li><a href="mailto:webmaster.nirm@gmail.com"><i class="fa fa-envelope"></i>Webmaster</a></li>

                            </ul>
                        </div>
                        <div class="cell-5 right-bar">
                            <ul class="right">
                               <?php
									if(isset($_SESSION['client_login']))
									{
										if($_SESSION['client_login']=="true")
										{
											echo '<li><a href="client-details.php"><i class="fa fa-user"></i>'.$_SESSION['client_name'].'</a></li>';
										}
										else
										{
											echo '<li><a href="javascript:void(0);" onclick="show_login()"><i class="fa fa-user"></i>Client Login</a></li>';
										}
									}
									else
										{
											echo '<li><a href="javascript:void(0);" onclick="show_login()"><i class="fa fa-user"></i>Client Login</a></li>';
										}
								?>
								 <?php
									if(isset($_SESSION['user_login']))
									{
										if($_SESSION['user_login']=="true")
										{
											echo '<li><a href="user-details.php"><i class="fa fa-unlock-alt"></i>'.$_SESSION['user_name'].'</a></li>';
										}
										else
										{
											echo '<li><a href="javascript:void(0);" onclick="show_user_login()"><i class="fa fa-unlock-alt"></i>User Login</a></li>';
										}
									}
									else
										{
											echo '<li><a href="javascript:void(0);" onclick="show_user_login()"><i class="fa fa-unlock-alt"></i>User Login</a></li>';
										}
								?>
                              
                                <li><a href="contactus.php"><i class="fa fa-phone"></i>Contact Us</a></li>
								<?php
									if(isset($_SESSION['client_login']))
									{
										if($_SESSION['client_login']=="true")
										{
											echo '<li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>';
										}
									}
								?>
                                <li><a href="#"  class="up"><i class="fa fa-plus-square"></i>A+</a></li>
                                <li><a href="#"  class="down"><i class="fa fa-minus-square"></i>A-</a></li>
                                

                            </ul>
                        </div>
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
			<div id="user_login" class="modal">
				<div class="modal-content">
					<span class="close" onclick="close_popup();" style="color: #000;">&times;</span>		  
						 <div class="contact-form" id="contact" style="width:100%;padding: 2px 13px;">
                                <h3 class="block-head" style="margin-bottom: 10px;padding: 0 0 4px;">User LogIn</h3>
                                <form class="" method="post" action="sendmail.php"  autocomplete="on">
                                    <div class="form-input">
                                        <label>Username<span class="red">*</span></label>
                                       <input type="text" required="required" name="user_username" id="user_username" autocomplete="off">
                                    </div>
                                   
                                    <div class="form-input" style="margin: 0 0 10px 0;">
                                        <label>Password<span class="red">*</span></label>
                                        <input type="password" required="required" name="user_password" id="user_password" autocomplete="off">
                                    </div>
									
                                    <div class="form-input" style="margin: 0px 0 15px 0;">
                                        <input type="button" onclick="user_login();" name="submit"  id="submit" style="font-size: 15px;" class="btn btn-large main-bg" value="Login">
                                    </div>
                                </form>
                            </div>
				</div>
			</div>				
						
				<script>
if ($(window).width() < 767) 
{
$(window).scroll(function() 
{
if ($(this).scrollTop()>0)
{	
$('#abc').css("display","none");
}
else
{
$('#abc').css("display","block");
}
});
} 
</script>