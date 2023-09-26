<?php 
 $emp_cer="";
 $edu_cer="";
?>
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
	<body class="body" onload="window.print()" style="padding:0 !important; margin:0 !important; display:block !important; background:#ffffff; -webkit-text-size-adjust:none">
										
										
							<div class="sectionWrapper" style="padding-top:3%;padding-bottom:5%;">
					<div class="container">
					   <div class="col-md-12 ">			
							<?php $a=1;?>
							<center><img src="<?php echo base_url();?>../assets/logo.png" width="300"></center>
							<p style="text-align:center;font-size:12px;">
								Eshwar Nagar, Outer Ring Road, Banashankari 2nd Stage,<br>
								BENGALURU - 560 070, Karnataka, India <br>
							</p>
							<hr>
							<h3 style="text-align:center"><b>Application for Contractual appointment</b></h3>
							<h4 style="text-align:center;font-size:14px">
								<b><?php echo $details[0]['job_title']?></b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Post Code & Category : </b> <?php echo $details[0]['post_code'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b>Date : </b> <?php echo date("d-m-Y",strtotime($details[0]['applied_date']));?>
							</h4>
						<div class="row">
							<div class="col-md-6">
								<h4><b>Application No : </b>: <?php echo $details[0]['application_no'];?></h4>			
								<h4><b>Acknowledgment No: </b>: <?php echo $details[0]['ack_no'];?></h4>			
								<h4></h4>			
								<h4></h4>			
								<h4><b>1. Name </b>: <?php echo $details[0]['name'];?></h4>			
								<h4><b>2.(a) Father's Name </b>: <?php echo $details[0]['father_name'];?></h4>	
								<h4 style="margin-left: 1%;"><b>(b) Occupation </b>: <?php echo $details[0]['occupation'];?></h4>
								<h4><b>3.(a) Address for communication </b>:<?php echo $details[0]['address_communication'];?></h4>	
								<h4 style="margin-left: 1%;"><b>(b) Permanent address </b>: <?php echo $details[0]['permanent_address'];?></h4>
								<h4 style="margin-left: 1%;"><b>(c) Contact Phone No.</b> : <?php echo $details[0]['phone'];?></h4>	
								<h4 style="margin-left: 1%;"><b>(d) e-mail id</b>: <?php echo $details[0]['email'];?></h4>	
								<h4><b>4.(a) Nationality</b>: <?php echo $details[0]['nationality'];?></h4>	
								<h4><b>5.(a) Whether a citizen of India by birth ?</b>: <?php echo $details[0]['indian_citizen'];?></b></h4>
								<?php
									if($details[0]['indian_citizen']=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b>(b) Which State you belong ?</b>: '.$details[0]['state'].'</h4>';
									}
									else if($details[0]['indian_citizen']=="No")
									{
										echo '<h4 style="margin-left: 1%;"><b>(b) Which Category you belong ?</b>: '.$details[0]['other_country'].'</h4>';
									}
								?>
								
								<h4><b>6.(a) Date of Birth</b>: <?php echo date("d-m-Y",strtotime($details[0]['date_birth']));?></h4>		
								<h4 style="margin-left: 1%;"><b>(b) Place of Birth</b>: <?php echo $details[0]['place_birth'];?></h4>
								<h4 style="margin-left: 1%;"><b>(c) Marital Status</b>: <?php echo $details[0]['maritial_status'];?></h4>	
							</div>
							<div class="col-md-6">
									<center><img src="<?php echo base_url()."../".$details[0]['profile_picture'];?>" width="150"></center>
							</div>
						</div>
							<h4><b>7. Nature of present work/ job ( Govt. Servant / Private Employee / Contract Worker)</b>:<?php echo $details[0]['present_work'];?></h4>
							<h4><b>8. Category (General / SC / ST / OBC)</b>: <?php echo $details[0]['caste_category'];?></h4>	
							<h4><b>9.(a) Have you ever been suspended / dismissed from past service </b>: <?php echo $details[0]['suspended_dismissed'];?></h4>	
								<?php 
									if($details[0]['suspended_dismissed']=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b> Reason for suspended / dismissed from past  service </b>: '.$details[0]['suspended_info'].'</h4>';
										$a++;
									}
								?>	
							<h4 style="margin-left: 1%;"><b>(b) Have you ever been arrested / prosecuted (while in service or otherwise) </b>: <?php echo $details[0]['arrested_prosecuted'];?></h4>		
								<?php 
									if($details[0]['arrested_prosecuted']=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b> Reason for arrested / prosecuted (while in service or otherwise) </b>: '.$details[0]['arrested_info'].'</h4>';
										$a++;
									}
								?>	
							<h4><b>10. Do you have any medical infirmity or have you been hospitalized for over three months </b>: <?php echo $details[0]['medical_infirmity'];?></h4>		
								<?php 
									if($details[0]['medical_infirmity']=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b>(a) Provide Details, if you have any medical infirmity or have you been hospitalized for over three months </b>: '.$details[0]['medical_infirmity_details'].'</h4>';
										$a++;
									}
								?>
							<h4><b>11.(a) Religion to which you belong</b>: <?php echo $details[0]['religion'];?></h4>
							<h4 style="margin-left: 17px;"><b>(b) Have you ever changed your religion </b>: <?php echo $details[0]['changed_religion'];?></h4>	
									<h4><b>12. Educational & Professional qualifications - (Start with SSLC/ SSC)*</h4>	
									<!--<h4 ><b> Minimum Qualification ?</b>: <?php //echo $details('qualification');?></h4>-->
								<?php
									$edu_cer="";
									if(!empty($education_details))
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
															Marks
																</th><th style="font-size:12px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
																CGPA / % of Marks
																</th>
																
																<th style="font-size:12	px;text-align:left;padding:7px;width:30%;border-top: 1px solid #000;">
															Class
																</th>
															  </tr>
															  <?php
																	$edu_cer="";																
																	foreach($education_details as $res)
																	{
																		
																			echo '
																				 <tr>
																					<td>'.$res['exam_passed'].'</td>
																					<td>'.$res['university'].'</td>
																					<td>'.$res['duration_study'].'</td>
																					<td>'.$res['year_passing'].'</td>
																					<td>'.$res['major_subjects'].'</td>
																					<td>'.$res['cgpa'].'</td>
																					<td>'.$res['type'].'</td>
																					<td>'.$res['class'].'</td>
																				  </tr>';
																		$edu_cer.='<input type="checkbox" required=""checked> '.$res['exam_passed'].' &nbsp;&nbsp;';
																	}
																	
															  ?>
															 
															</tbody>
														</table>	
									<?php
									}
									?>
													<h4><b>13. No. of publications</b></h4>
													<h4 style="margin-left: 17px;"><b>(a). International (Journals)</b>: <?php echo $details[0]['international_journals'];?></h4>
													<h4 style="margin-left: 17px;"><b>(b). National (Journal)</b>: <?php echo $details[0]['national_journals'];?></h4>		
													<h4 style="margin-left: 17px;"><b>(c). International (Symposium)</b>: <?php echo $details[0]['international_symposium'];?></h4>	
													<h4 style="margin-left: 17px;"><b>(d). National (Symposium)</b>: <?php echo $details[0]['national_symposium'];?></h4>	
													<h4 style="margin-left: 17px;"><b>(e). Other publications</b>: <?php echo $details[0]['other_publications'];?></h4>
													<h4 style="margin-left: 17px;line-height:1.8"><b>(f). List details of three significant publications separately, if space provided is less.</b>: <br><?php echo $details[0]['significant_publications_1'];?> <br> <?php echo $details[0]['significant_publications_2'];?><br><?php echo $details[0]['significant_publications_3'];?></h4>			
													<h4><b>14. Any significant achievements (mention in detail) :</b><?php echo $details[0]['significant_achievements'];?></h4>			
													<h4><b>15. Have you been outside India ? If yes, please provide details below :</b><?php echo $details[0]['outside_india'];?></h4>
													<?php
														if($details[0]['outside_india']=="Yes")
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
																	foreach($country_details as $res1)
																	{
																			echo '
																				<tr>
																					<td>'.$res1['country_visited'].'</td>
																					<td>'.$res1['period_visit'].'</td>
																					<td>'.$res1['purpose_visit'].'</td>
																				</tr>
																			';
																	}
														}
													?>
													</table>
													
													<h4><b>16. Employment details (in reverse chronological order)
(Enclose certificate of experience in respect of minimum desirable qualification)</h4>	
													<h4><b>&nbsp;&nbsp;&nbsp; Total Experience :</b><?php echo $details[0]['total_experience'];?></h4>
								<?php
									if(!empty($emp_details))
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
											  $emp_cer="";
													foreach($emp_details as $res2)
													{
															echo '
																 <tr>
																	<td>'.$res2['employer'].'</td>
																	<td>'.date("d-m-Y",strtotime($res2['date_joining'])).'</td>
																	<td>'.date("d-m-Y",strtotime($res2['date_leaving'])).'</td>
																	<td>'.$res2['designation'].'</td>
																	<td>'.$res2['nature_job'].'</td>
																	<td>'.$res2['gross_month_salary'].'</td>
																  </tr>';
														$emp_cer.='<input type="checkbox" required=""checked> '.$res2['employer'].' &nbsp;&nbsp;';
													}	
											  ?>
											</tbody>
										</table>	
									<?php 
									}
									?>
										
									
										<h4><b>17. Have you applied for any other post(s) at NIRM earlier ? (If applied during the last five years, please mention details):</b> <?php echo $details[0]['applied_earlier_nirm'];?></h4>		
									<?php
										
										if(!empty($nirm_applied))
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
													foreach($nirm_applied as $res3)
													{
														echo '
														 <tr>
															<td>'.$res3['advt_no'].'</td>
															<td>'.date("d-m-Y",strtotime($res3['date_application'])).'</td>
															<td>'.$res3['post_applied_for'].'</td>
															<td>'.$res3['called_interview'].'</td>
															<td>'.date("d-m-Y",strtotime($res3['date_interview'])).'</td>
														  </tr>';
													}	
											  ?>
											</tbody>
										</table>	
										<?php
										}
										?>
										
										<h4 style="line-height:2"><b>18. Name and address of two Referees for verifying your credentials</b>
										<span><br>i. <?php echo $details[0]['referees_1'];?><br>ii.<?php echo $details[0]['referees_2'];?></span></h4>
										<h4><b>19.(a) Are you a Government Servant ?</b> : <?php echo $details[0]['govt_servant'];?></h4>
										<h4 style="margin-left: 17px;"><b>(b) Nature of Appointment ?</b> : <?php echo $details[0]['nature_appoinment'];?></h4>		
										<h4><b>20.(a) You willing to accept the minimum initial emoluments offered ?</b> : <?php echo $details[0]['accept_minimal_salary'];?></h4>
										<h4 style="margin-left: 17px;"><b>(b) Lowest Initial monthly emoluments expected per month ?</b> : <?php echo $details[0]['expected_month'];?></h4>		
										<h4 style="margin-left: 17px;"><b>(c) Minimum joining time required, if selected for the post in days ?(Any request for extension of joining time will not normally be considered)</b> : <?php echo $details[0]['joining_time_required'];?></h4>	
										<h3 style="font-size: 14px;">Document Attached : </h3>
										<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;">
												<input type="checkbox" required="" checked> DOB proof &nbsp;&nbsp;</p>
										<?php 
											if($details[0]['reserved_proof']!="")
											{
												echo '<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;">
												<input type="checkbox" required="" checked> Reserved Category &nbsp;&nbsp;</p>';
											}
										?>
										<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;">
												<?php
													echo $edu_cer."<br>".$emp_cer;
												?>
												
											<?php
												if($details[0]['govt_servant']=="Yes")
												{
													if($details[0]['noa_document']!="")
													{
														echo '<input type="checkbox" required=""checked> NOC Document &nbsp;&nbsp;';
													}
												}
											?>
										</p>
										
										<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;">
										<?php
											foreach($doc_certificate as $row)
											{
												echo '<input type="checkbox" required=""checked> '.$row['document_name'].' &nbsp;&nbsp;';
											}	
										?>
										</p>
										<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;"></p>
										<p style="margin-left: 0%;font-size: 12px;text-align: left;line-height: 2;"></p>	
										<h4> <input type="checkbox" required="" checked> I here by agree that I have read the terms and conditions for the contractual appointment for which I am applying the post.  Under no circumstances I shall not have a claim for a regular jobs/position at NIRM in future.
											</h4>
								</div>		
										
										
										
										
										
										
	</body>
</html>