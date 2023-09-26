@extends('layout.app')

@section('content')
    <div id="contentWrapper">
				<div class="page-title title-1">
					<div class="container">
						<div class="row">
							<div class="cell-12">
								<h1 class="fx" style="color:#fff;">CONTACT <span style="color:#fff;">NIRM</span></h1>
								<div class="breadcrumbs main-bg fx">
									<span class="bold">You Are In:</span><a href="index.php">Home</a><span class="line-separate"><span class="line-separate">/</span><span>Contact NIRM</span>
								</span></div>
							</div>
						</div>
					</div>
				</div>

				<div class="padd-top-50">
					<div class="container">
						<div class="row">
			    			<div class="cell-7 contact-form fx" data-animate="fadeInLeft" id="contact">
			    				<h3 class="block-head">Get in Touch</h3>
			    				<mark id="message"></mark>
			    				<form class="form-signin cform" method="post" action="sendmail.php" id="cform" autocomplete="on">
			    					<div class="form-input">
				    					<label>First name<span class="red">*</span></label>
				    					<input type="text" required="required" name="name" id="name">
			    					</div>
			    					<div class="form-input">
			    						<label>Email<span class="red">*</span></label>
			    						<input name="email" type="email" id="email" required="required">
			    					</div>
			    					<div class="form-input">
			    						<label>Phone</label>
			    						<input name="phone" type="text" id="phone" maxlength="10">
			    					</div>
			    					<div class="form-input">
			    						<label>Message<span class="red">*</span></label>
			    						<textarea required="required" name="message" cols="40" rows="7" id="messageTxt" spellcheck="true"></textarea>
			    					</div>
                                    <div class="form-input">
                                        <label>Google Captcha<span class="red">*</span></label>
                                          <div class="g-recaptcha" data-sitekey="6LflNpQUAAAAAEn1h1s9DZzdSWz4vLKDEg-a7krU" required="required"></div>
                                      </div>

			    					<div class="form-input">
			    						<input type="submit" class="btn btn-large main-bg" name="send_mail" value="Submit">

			    					</div>
			    				</form>
			    			</div>
			    			<div class="cell-5 contact-detalis">
			    				<h3 class="block-head">Contact Details</h3>
			    				<p class="fx" data-animate="fadeInRight"></p>

			    				<div class="clearfix"></div>
			    				<div class="padding-vertical">
			    					<div class="cell-12 fx" data-animate="fadeInRight">
				    					<h4 class="main-color bold">Head Office</h4>
				    					<p>Address:
				    					National Institute of Rock Mechanics<br>
										Eshwar Nagar, Outer Ring Road,<br>
										Banashankari 2nd Stage<br>
										Bengaluru-560 070 Karnataka, India<br>
										</p>
				    					<p>Email: dto@nirm.in</p>
				    					<p>Phone: +91-80–26934402 / +91-80–26934414</p>
				    					<p>FAX:	+91-80-26934401</p>
				    				</div>
								</div>
								<div class="padding-vertical">
				    				<div class="cell-2"><br></div>
				    				<div class="cell-12 fx" data-animate="fadeInRight">
				    					<h4 class="main-color bold">Registered Office</h4>
				    					<p>Address:
				    					National Institute of Rock Mechanics<br>
										Champion Reefs<br>
										Kolar Gold Fields- 563 117<br>
										Karnataka, INDIA<br>
										</p>
				    					<p>Email: dto@nirm.in</p>
				    					<p>Phone: +91-8153-275000 </p>
				    					<p>FAX: +91-8153-275002</p>
				    				</div>
			    				</div>
			    			</div>
						</div>
					</div>
				</div>

				<div class="padd-vertical-45">
			    	<div class="container">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248861.8326195131!2d77.55622976666119!3d12.941997033441345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae157b7a1fbf35%3A0x464c8daa5e370404!2sNational+Institute+of+Rock+Mechanics!5e0!3m2!1sen!2sin!4v1487759768484" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			    		</div>
		    	</div>
				<div class="padd-vertical-45">
			    	<div class="container">
					<table>
		<thead>
		<tr>
			<th>Department</th>
			<th>Head of Department</th>
			<th>Telephone
			HO : 080-</th>
			<th>Mobile</th>
			<th>e-mail id</th>

		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Director  </td>
			<td>Dr H.S. Venkatesh </td>
			<td>2693 4400 / Fax- 26934401 / PA- 26934402</td>
			<td>9845176287</td>
			<td><a href="mailto:dto@nirm.in">dto@nirm.in</a> </td>

		</tr>
		<tr>
			<td>Scientist-In-Charge, RO, KGF  </td>
			<td>Mr A Rajan Babu </td>
			<td>KGF : 08153 - 275000-04</td>
			<td>9845188807</td>
			<td><a href="mailto:ddstrajan@gmail.com%20%20%20">ddstrajan@gmail.com   </a></td>

		</tr>

		<tr>
		  <td>Project Monitoring Cell </td>
		  <td>Dr V R Balasubramaniam</td>
		  <td>2693 4410</td>
		  <td>94487 13920</td>
		  <td><a href="mailto:hod.pmc.nirm@gmail.com%20">hod.pmc.nirm@gmail.com </a></td>

		</tr>
		<tr>
		  <td>Rock Blasting &amp; Excavation Engineering</td>
		  <td>Dr H S Venkatesh</td>
		  <td>2693 4409</td>
		  <td>9845176287</td>
		  <td><a href="mailto:rbeenirm@gmail.com">rbeenirm@gmail.com</a></td>

		</tr>
		<tr>
		  <td>Centre for Testing Services</td>
		  <td>Mr A Rajan Babu</td>
		  <td>KGF : 08153 - 275000-04</td>
		  <td>9845188807</td>
		  <td><a href="mailto:ddstrajan@gmail.com%20%20%20">ddstrajan@gmail.com   </a></td>

		</tr>

		<tr>
		  <td>Numerical Modelling</td>
		  <td>Dr Sripad R Naik</td>
		  <td>2693 4408</td>
		  <td>9449225973</td>
		  <td><a href="mailto:nmd.nirm@gmail.com">nmd.nirm@gmail.com </a></td>

		</tr>
		<tr>
		  <td>Geotechnical Engineering </td>
		  <td>Dr D S Subrahmanyam</td>
		  <td>2693 4415</td>
		  <td>9448402572</td>
		  <td><a href="mailto:subbu3268@gmail.com%20">subbu3268@gmail.com</a></td>
		</tr>
        <tr>
		  <td>Engineering Seismology </td>
		  <td>Dr V R Balasubramaniam </td>
		  <td>2693 4410</td>
		  <td>94487 13920</td>
		  <td><a href="mailto:vrbala.nirm@gmail.com%20%20">vrbala.nirm@gmail.com  </a></td>

		</tr>
		<tr>
		  <td>Engineering Geology </td>
		  <td>Dr Ajay Kumar Naithani</td>
		  <td>2693 4411</td>
		  <td>9481434153</td>
		  <td><a href="mailto:anaithania@gmail.com">anaithania@gmail.com  </a></td>

		</tr>

        <tr>
            <td>Engineering Geophysics</td>
            <td>Dr Sandeep Nelliat</td>
            <td>2693 4407</td>
            <td>9481826252</td>
            <td><a href="mailto:egp.nirm@gmail.com%20">egp.nirm@gmail.com  </a></td>

        </tr>
        <tr>
		  <td>Seismotectonics </td>
		  <td>Dr Biju John</td>
		  <td>2693 4412</td>
		  <td> 9481057202</td>
		  <td><a href="mailto:b_johnp@yahoo.co.in%20%20">b_johnp@yahoo.co.in </a></td>

		</tr>

        <tr>
            <td>Geomechanics and Ground Control </td>
            <td>Mr. Sultan Singh Meena </td>
            <td>2693 4413</td>
            <td> 9611785711</td>
            <td><a href="mailto:ggcd.nirm@gmail.com%20%20">ggcd.nirm@gmail.com </a></td>

        </tr>

		<tr>
		  <td>Controller of Adminstration </td>
		  <td>Dr Sandeep Nelliat</td>
		  <td>2693 4403</td>
		  <td>9481826252</td>
		  <td><a href="mailto:coa.nirm@gmail.com%20">coa.nirm@gmail.com  </a></td>

		</tr>
		<tr>
		  <td>Purchase &amp; Stores Officer </td>
		  <td>Mr S Ravi</td>
		  <td>2693 4404</td>
		  <td>9448141794</td>
		  <td><a href="mailto:nirmpurchase@gmail.com%20">nirmpurchase@gmail.com   </a></td>

		</tr>
		<tr>
		  <td>Finance &amp; Accounts Officer</td>
		  <td>Mrs Uma Ramakrishna Iyer </td>
		  <td>2693 4405</td>
		  <td></td>
		  <td><a href="mailto:faonirm2018@gmail.com%20">faonirm2018@gmail.com   </a></td>

		</tr>


		<tr>
		  <td>Administrative Officer</td>
		  <td>Mr. N Jothiappa</td>
		  <td>2693 4406</td>
		  <td>9480496164</td>
		  <td><a href="mailto:ao.nirm@gmail.com%20">ao.nirm@gmail.com    </a> </td>

		</tr>


		</tbody>
	</table>
			    		</div>
		    	</div>
			</div>
@endsection