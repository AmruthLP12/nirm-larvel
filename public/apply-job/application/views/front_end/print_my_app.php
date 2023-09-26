<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
					<meta content="telephone=no" name="format-detection" />
					<title>NIRM</title>
					
					<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
					<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
					<style type="text/css" media="screen">
						/* Linked Styles */
						body { 
						padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none;font-family: times;
						}
						a { color:#00b8e4; text-decoration:underline;font-family: times; }
						h3 a { color:#1f1f1f; text-decoration:none;font-family: times; }
						.text2 a { color:#ea4261; text-decoration:none;font-family: times; }
						
						/* Campaign Monitor wraps the text in editor in paragraphs. In order to preserve design spacing we remove the padding/margin */
						p { padding:0 !important; margin:0 !important;font-family: times; } 
						.content1 p { padding:0 !important;margin-bottom: 1% !important;font-family: times; } 
						ol {font-family: times; } 
						ol li {margin-top:1%;line-height:2}
						
						.table1 td,.table1 th 
						{
							    border: 1px solid black;
						}
						table td,th
						{
							font-family: times;
							font-size:12px;
							  padding-right: 1%;
							  padding-left: 1%;
							   text-align:left;
							      font-weight: 400;
						}
						h4 
						{
							font-size:12px;
							    line-height: 12px;
						}
					</style>
					<style>
						@media print 
						{
							body { 
									padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none;font-family: times;
								}
							a { color:#00b8e4; text-decoration:underline;font-family: times; }
							h3 a { color:#1f1f1f; text-decoration:none;font-family: times; }
							.text2 a { color:#ea4261; text-decoration:none;font-family: times; }
						
							p { padding:0 !important; margin:0 !important;font-family: times; } 
							.content1 p { padding:0 !important;margin-bottom: 1% !important;font-family: times; } 
							ol {font-family: times; } 
							ol li {margin-top:1%;line-height:2}
							.table1 td,.table1 th 
								{
										border: 1px solid black;
								}	
								.gross td
								{
									background: #ecbfbf !important;
								}
							table td,th
							{
								font-family: times;
								font-size:12px;
								padding-right: 1%;
								padding-left: 1%;
								text-align:left;
								font-weight: 400;
							}
							h4 
							{
								font-size:12px;
								    line-height: 12px;
							}
							.col-md-1 {width:8%;  float:left;}
							.col-md-2 {width:16%; float:left;}
							.col-md-3 {width:25%; float:left;}
							.col-md-4 {width:33%; float:left;}
							.col-md-5 {width:42%; float:left;}
							.col-md-6 {width:50%; float:left;}
							.col-md-7 {width:58%; float:left;}
							.col-md-8 {width:66%; float:left;}
							.col-md-9 {width:75%; float:left;}
							.col-md-10{width:83%; float:left;}
							.col-md-11{width:92%; float:left;}
							.col-md-12{width:100%; float:left;}
						}
					</style>
					<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
					
				</head>
	<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
										
										
							<div class="sectionWrapper" style="padding-top:3%;padding-bottom:5%;">
					<div class="container">
					   <div class="col-md-12 ">			
							<?php $a=1;?>
							<center><img src="<?php echo base_url();?>../assets/logo.png" width="300"></center>
							<hr>
							<h3 style="text-align:center"><b>Application for Contractual appointment</b></h3>
						<div class="row">
							<div class="col-md-6">		
								<h4><b>1. Name </b>: <?php echo $this->input->post('name');?></h4>			
								<h4><b>2.(a) Father's Name </b>: <?php echo $this->input->post('fname');?></h4>	
								<h4 style="margin-left: 1%;"><b>(b) Occupation </b>: <?php echo $this->input->post('occupation');?></h4>
								<h4><b>3.(a) Address for communication </b>:<?php echo $this->input->post('address');?></h4>	
								<h4 style="margin-left: 1%;"><b>(b) Permanent address </b>: <?php echo $this->input->post('permanent_address');?></h4>
								<h4 style="margin-left: 1%;"><b>(c) Contact Phone No.</b> : <?php echo $this->input->post('phone');?></h4>	
								<h4 style="margin-left: 1%;"><b>(d) e-mail id</b>: <?php echo $this->input->post('email');?></h4>	
								<h4><b>4.(a) Nationality</b>: <?php echo $this->input->post('nationality');?></h4>	
								<h4><b>5.(a) Whether a citizen of India by birth ?</b>: <?php echo $this->input->post('citizen');?></b></h4>
								<?php
									if($this->input->post('citizen')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b>(b) Which State you belong ?</b>: '.$this->input->post('state').'</h4>';
									}
									else if($this->input->post('citizen')=="No")
									{
										echo '<h4 style="margin-left: 1%;"><b>(b) Which Category you belong ?</b>: '.$this->input->post('other_country').'</h4>';
									}
								?>
								
								<h4><b>6.(a) Date of Birth</b>: <?php echo $this->input->post('dob');?></h4>		
								<h4 style="margin-left: 1%;"><b>Place of Birth</b>: <?php echo $this->input->post('place_birth');?></h4>
								<h4 style="margin-left: 1%;"><b>(b) Marital Status</b>: <?php $this->input->post('marital');?></h4>	
							</div>
							
						</div>
							<h4><b>7. Nature of present work/ job ( Govt. Servant / Private Employee / Contract Worker)</b>:<?php echo $this->input->post('present_work');?></h4>
							<h4><b>8. Category (General / SC / ST / OBC)</b>: <?php echo $this->input->post('category');?></h4>	
							<h4><b>9.(a) Have you ever been suspended / dismissed from past service ?</b>: <?php echo $this->input->post('suspended');?></h4>	
								<?php 
									if($this->input->post('suspended')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b> Reason for suspended / dismissed from past  service ?</b>: '.$this->input->post('suspended_info').'</h4>';
										$a++;
									}
								?>	
							<h4 style="margin-left: 1%;"><b>(b) Have you ever been arrested / prosecuted (while in service or otherwise) ?</b>: <?php echo $this->input->post('arrested');?></h4>		
								<?php 
									if($this->input->post('arrested')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b> Reason for arrested / prosecuted (while in service or otherwise) ?</b>: '.$this->input->post('arrested_info').'</h4>';
										$a++;
									}
								?>	
							<h4><b>10. Do you have any medical infirmity or have you been hospitalized for over three months ?</b>: <?php echo $this->input->post('suspended');?></h4>		
								<?php 
									if($this->input->post('medical')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b>(a) Provide Details, if you have any medical infirmity or have you been hospitalized for over three months ?</b>: '.$this->input->post('medical_details').'</h4>';
										$a++;
									}
								?>
							<h4><b>11.(a) Religion to which you belong?</b>: <?php echo $this->input->post('suspended');?></h4>
							<h4 style="margin-left: 17px;"><b>(b) Have you ever changed your religion ?</b>: <?php echo $this->input->post('suspended');?></h4>	
									<h4><b>12. Educational & Professional qualifications - (Start with SSLC/ SSC)*</h4>	
									<!--<h4 ><b> Minimum Qualification ?</b>: <?php //echo $details('qualification');?></h4>-->
								<?php
									$edu_cer="";
									if($this->input->post('exam_passed'))
									{
								?>
									<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
															<tbody>
															  <tr style="background-color: #337ab7;color: #fff;border: none;">
																<th style="width: 20%;font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">
																	Exam Passed	
																</th>
																<th style="font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">
																	Board/University
																</th>
																<th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
																	Duration of study
																</th>
																<th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
																Year of passing
																</th>
																<th style=" width: 20%;font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">
																Major Subject(s)
																</th>
																
																<th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
															CGPA / % of Marks
																</th><th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
																 Marks
																</th>
																
																<th style="font-size:12	px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
															Class
																</th>
															  </tr>
															  <?php
																	$exam=$this->input->post('exam_passed');
																	$board=$this->input->post('board');
																	$study=$this->input->post('study');
																	$year_passing=$this->input->post('exam_passed');
																	$major_subjects=$this->input->post('major_subjects');
																	$type=$this->input->post('type');
																	$cgpa=$this->input->post('cgpa');
																	$class=$this->input->post('class');
																	for($i=0;$i<count($this->input->post('exam_passed'));$i++)
																	{
																		if($exam[$i] !="")
																		{
																			echo '
																				 <tr>
																					<td>'.$exam[$i].'</td>
																					<td>'.$board[$i].'</td>
																					<td>'.$study[$i].'</td>
																					<td>'.$year_passing[$i].'</td>
																					<td>'.$major_subjects[$i].'</td>
																					<td>'.$type[$i].'</td>
																					<td>'.$cgpa[$i].'</td>
																					<td>'.$class[$i].'</td>
																				  </tr>';
																		}
																	}																		
																	
															  ?>
															 
															</tbody>
														</table>	
									<?php
									}
									?>
													<h4><b>13. No. of publications</b></h4>
													<h4 style="margin-left: 17px;"><b>(a). International (Journals)</b>: <?php echo $this->input->post('int_journals');?></h4>
													<h4 style="margin-left: 17px;"><b>(b). National (Journal)</b>: <?php echo $this->input->post('national_journals');?></h4>		
													<h4 style="margin-left: 17px;"><b>(c). International (Symposium)</b>: <?php echo $this->input->post('int_symposium');?></h4>	
													<h4 style="margin-left: 17px;"><b>(d). National (Symposium)</b>: <?php echo $this->input->post('national_symposium');?></h4>	
													<h4 style="margin-left: 17px;"><b>(e). Other publications</b>: <?php echo $this->input->post('other_publications');?></h4>
													<h4 style="margin-left: 17px;line-height:1.8"><b>(f). List details of three significant publications separately, if space provided is less.</b>: <br> i.<?php echo $this->input->post('significant_1');?> <br> ii.<?php echo $this->input->post('significant_2');?><br> iii.<?php echo $this->input->post('significant_3');?></h4>			
													<h4><b>14. Any significant achievements (mention in detail) :</b><?php echo $this->input->post('any_significant');?></h4>			
													<h4><b>15. Have you been outside India ? If yes, please provide details below :</b><?php echo $this->input->post('outside');?></h4>
													<?php
														if($this->input->post('outside')=="Yes")
														{
													?>
															<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
															<tbody>
															  <tr style="background-color: #337ab7;color: #fff;border: none;">
																<th style="width: 20%;font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">Country Visited</th>
																<th style="font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">Period of Visit</th>
																<th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">Purpose of Visit</th>
															  </tr>
													<?php
																	$country_visited=$this->input->post('country_visited');
																	$period_visit=$this->input->post('period_visit');
																	$purpose_visit=$this->input->post('purpose_visit');
																	
																	for($i=0;$i<count($this->input->post('country_visited'));$i++)
																	{
																		if($country_visited[$i] !="")
																		{
																			echo '
																					<tr>
																						<td>'.$country_visited[$i].'</td>
																						<td>'.$period_visit[$i].'</td>
																						<td>'.$purpose_visit[$i].'</td>
																					</tr>
																				';
																		}
																	}
														}
													?>
													</table>
													
													<h4><b>16. Employment details (in reverse chronological order)
(Enclose certificate of experience in respect of minimum desirable qualification)</h4>	
													<h4><b>&nbsp;&nbsp;&nbsp; Total Experience :</b><?php echo $this->input->post('total_exp');?></h4>
								<?php
									if($this->input->post('employer'))
									{
								?>
										<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
											<tbody>
											  <tr style="background-color: #337ab7;color: #fff;border: none;">
												<th style="font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">Employer</th>
												<th style="font-size:12px;text-align:left;padding:7px;width:20%;border-top: 1px solid #000;">Date of Joining</th>
												<th style="font-size:12px;text-align:left;padding:7px;width:20%;border-top: 1px solid #000;">Date of Leaving</th>
												<th style="font-size:12px;text-align:left;padding:7px;width:20%;border-top: 1px solid #000;">Designation</th>
												<th style="font-size:12px;text-align:left;padding:7px; width:20%;border-top: 1px solid #000;">Nature of Job done</th>
												<th style="font-size:12px;text-align:left;padding:7px;width:20%;border-top: 1px solid #000;">Gross monthly pay</th>
											  </tr>
											  <?php
													
													$employer=$this->input->post('employer');
													$doj=$this->input->post('doj');
													$date_leave=$this->input->post('date_leave');
													$designation=$this->input->post('designation');
													$job_done=$this->input->post('job_done');
													$gross_pay=$this->input->post('gross_pay');
																	
													for($i=0;$i<count($this->input->post('employer'));$i++)
													{
														if($employer[$i] !="")
														{
															echo '
																 <tr>
																	<td>'.$employer[$i].'</td>
																	<td>'.$doj[$i].'</td>
																	<td>'.$date_leave[$i].'</td>
																	<td>'.$designation[$i].'</td>
																	<td>'.$job_done[$i].'</td>
																	<td>'.$gross_pay[$i].'</td>
																  </tr>';
														}
													}	
											  ?>
											</tbody>
										</table>	
									<?php 
									}
									?>
										
									
										<h4><b>17. Have you applied for any other post(s) at NIRM earlier ? (If applied during the last five years, please mention details):</b> <?php echo $this->input->post('nirm_earlier');?></h4>		
									<?php
										
										if($this->input->post('advt_no'))
									{
									?>
										<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
											<tbody>
											  <tr style="background-color: #337ab7;color: #fff;border: none;">
												<th style="font-size:12px;text-align:left;padding:7px;border-top: 1px solid #000;">Advt. No
												</th>
												<th style="font-size:12px;text-align:left;padding:7px;width:20%;border-top: 1px solid #000;">Date of Application
												</th>
												<th style="font-size:12px;text-align:left;padding:7px;width:20%;border-top: 1px solid #000;">Post applied for
												</th>
												<th style="font-size:12px;text-align:left;padding:7px;width:20%;border-top: 1px solid #000;">Whether called for Interview
												</th>
												<th style="font-size:12px;text-align:left;padding:7px; width:20%;border-top: 1px solid #000;">Date of Intervie
												</th>
											  </tr>
											  <?php
													$advt_no=$this->input->post('advt_no');
													$date_apply=$this->input->post('date_apply');
													$post_applied=$this->input->post('post_applied');
													$called_interview=$this->input->post('designation');
													$date_interview=$this->input->post('date_interview');
																	
													for($i=0;$i<count($this->input->post('advt_no'));$i++)
													{
														if($advt_no[$i] !="")
														{
															echo '
																 <tr>
																	<td>'.$advt_no[$i].'</td>
																	<td>'.$date_apply[$i].'</td>
																	<td>'.$post_applied[$i].'</td>
																	<td>'.$designation[$i].'</td>
																	<td>'.$date_interview[$i].'</td>
																  </tr>';
														}
													}	
											  ?>
											</tbody>
										</table>	
										<?php
										}
										?>
										
										<h4 style="line-height:2"><b>18. Name and address of two Referees for verifying your credentials</b>
										<span><br>i. <?php echo $this->input->post('referees_1');?><br>ii.<?php echo $this->input->post('referees_2');?></span></h4>
										<h4><b>19.(a) Are you a Government Servant ?</b> : <?php echo $this->input->post('govt_servant');?></h4>
										
										<?php 
											if($this->input->post('govt_servant')=="Yes")
											{
												echo '<h4 style="margin-left: 17px;"><b>(b) Nature of Appointment ?</b> :'.$this->input->post('nature_app').'</h4>';
											}
										
										?>
										<h4><b>20.(a) You willing to accept the minimum initial emoluments offered ?</b> : <?php echo $this->input->post('min_emoluments');?></h4>
										<?php 
											if($this->input->post('min_emoluments')=="No")
											{
												echo '<h4 style="margin-left: 17px;"><b>(b) Lowest Initial monthly emoluments expected per month ?</b> :'.$this->input->post('lowest_initial').'</h4>';
											}
										
										?>	
										<h4 style="margin-left: 17px;"><b>(c) Minimum joining time required, if selected for the post in days ?(Any request for extension of joining time will not normally be considered)</b> : <?php echo $this->input->post('notice_period');?></h4>	
										
										<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;"></p>
										<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;"></p>	
										<h4> <input type="checkbox" required="" checked> I here by agree that I have read the terms and conditions for the contractual appointment for which I am applying the post.  Under no circumstances I shall not have a claim for a regular jobs/position at NIRM in future.
											</h4>
								</div>							
	</body>
</html>