<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_process extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					 
					$this->load->helper('url');
					$this->load->model('back_end/home_db','home');
					$this->load->library("pagination");
					$this->load->library('email');
        }
	
	public function preview_submit()
	{
		$a=1;
		echo ' <div class="col-md-12 ">			
							
							<center><img src="'.base_url().'../assets/logo.png" width="300"></center>
							<hr>
							<h3 style="text-align:center"><b>Application for Contractual appointment</b></h3>
						<div class="row">
							<div class="col-md-6">		
								<h4><b>1. Name </b>: '.$this->input->post('name').'</h4>			
								<h4><b>2.(a) Father Name </b>: '.$this->input->post('fname').'</h4>	
								<h4 style="margin-left: 1%;"><b>(b) Occupation </b>: '.$this->input->post('occupation').'</h4>
								<h4><b>3.(a) Address for communication </b>: '.$this->input->post('address').'</h4>	
								<h4 style="margin-left: 1%;"><b>(b) Permanent address </b>: '.$this->input->post('permanent_address').'</h4>
								<h4 style="margin-left: 1%;"><b>(c) Contact Phone No.</b> : '.$this->input->post('phone').'</h4>	
								<h4 style="margin-left: 1%;"><b>(d) e-mail id</b>: '.$this->input->post('email').'</h4>	
								<h4><b>4.(a) Nationality</b>: '.$this->input->post('nationality').'</h4>	
								<h4><b>5.(a) Whether a citizen of India by birth ?</b>: '.$this->input->post('citizen').'</b></h4>';
									if($this->input->post('citizen')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b>(b) Which State you belong ?</b>: '.$this->input->post('state').'</h4>';
									}
									else if($this->input->post('citizen')=="No")
									{
										echo '<h4 style="margin-left: 1%;"><b>(b) Which Category you belong ?</b>: '.$this->input->post('other_country').'</h4>';
									}
							echo'<h4><b>6.(a) Date of Birth</b>: '.$this->input->post('dob').'</h4>		
								<h4 style="margin-left: 1%;"><b>Place of Birth</b>: '.$this->input->post('place_birth').'</h4>
								<h4 style="margin-left: 1%;"><b>(b) Marital Status</b>: '.$this->input->post('marital').'</h4>	
							</div>
							
						</div>
							<h4><b>7. Nature of present work/ job ( Govt. Servant / Private Employee / Contract Worker)</b>: '.$this->input->post('present_work').'</h4>
							<h4><b>8. Category (General / SC / ST / OBC)</b>: '.$this->input->post('category').'</h4>	
							<h4><b>9.(a) Have you ever been suspended / dismissed from past service ?</b>: '.$this->input->post('suspended').'</h4>';
								
									if($this->input->post('suspended')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b> Reason for suspended / dismissed from past  service ?</b>: '.$this->input->post('suspended_info').'</h4>';
										$a++;
									}
						echo '		
							<h4 style="margin-left: 1%;"><b>(b) Have you ever been arrested / prosecuted (while in service or otherwise) ?</b>: '.$this->input->post('arrested').'</h4>	';
									if($this->input->post('arrested')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b> Reason for arrested / prosecuted (while in service or otherwise) ?</b>: '.$this->input->post('arrested_info').'</h4>';
										$a++;
									}
						echo '
							<h4><b>10. Do you have any medical infirmity or have you been hospitalized for over three months ?</b>: '.$this->input->post('suspended').'</h4>';
								
									if($this->input->post('medical')=="Yes")
									{
										echo '<h4 style="margin-left: 1%;"><b>(a) Provide Details, if you have any medical infirmity or have you been hospitalized for over three months ?</b>: '.$this->input->post('medical_details').'</h4>';
										$a++;
									}
					echo '	<h4><b>11.(a) Religion to which you belong?</b>:'.$this->input->post('religion').'</h4>
							<h4 style="margin-left: 17px;"><b>(b) Have you ever changed your religion ?</b>: '.$this->input->post('religion_changed').'</h4>	
									<h4><b>12. Educational & Professional qualifications - (Start with SSLC/ SSC)*</h4>	';
							
									$edu_cer="";
									if($this->input->post('exam_passed'))
									{
										echo '
													<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
															<tbody>
															  <tr>
																<th>Exam Passed</th>
																<th>Board/University</th>
																<th>Duration of study</th>
																<th>Year of passing</th>
																<th>Major Subject(s)</th>
																<th>CGPA / % of Marks</th>
																<th>Marks</th>
																<th>Class</th>
															  </tr>';
															
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
																
														echo '	</tbody>
														</table>';
									}
									
										echo '		<h4><b>13. No. of publications</b></h4>
													<h4><b>(a). International (Journals)</b>: '.$this->input->post('int_journals').'</h4>
													<h4><b>(b). National (Journal)</b>: '. $this->input->post('national_journals').'</h4>		
													<h4><b>(c). International (Symposium)</b>: '.$this->input->post('int_symposium').'</h4>	
													<h4><b>(d). National (Symposium)</b>: '.$this->input->post('national_symposium').'</h4>	
													<h4><b>(e). Other publications</b>: '.$this->input->post('other_publications').'</h4>
													<h4><b>(f). List details of three significant publications separately, if space provided is less.</b>: <br> i.'. $this->input->post('significant_1').'<br> ii.'.$this->input->post('significant_2').'<br> iii.'.$this->input->post('significant_3').'</h4>			
													<h4><b>14. Any significant achievements (mention in detail) :</b> '.$this->input->post('any_significant').'</h4>			
													<h4><b>15. Have you been outside India ? If yes, please provide details below :</b> '.$this->input->post('outside').'</h4>';
													
														if($this->input->post('outside')=="Yes")
														{
															echo '
																<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
																	<tbody>
																	  <tr style="background-color: #337ab7;color: #fff;border: none;">
																		<td>Country Visited</td>
																		<td>Period of Visit</td>
																		<td>Purpose of Visit</td>
																	  </tr>';
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
															echo '</tbody></table>';
														}
													
													
											echo '<h4><b>16. Employment details (in reverse chronological order)(Enclose certificate of experience in respect of minimum desirable qualification)</h4>	
													<h4><b>&nbsp;&nbsp;&nbsp; Total Experience :</b> '.$this->input->post('total_exp').'</h4>';
							
									if($this->input->post('employer'))
									{
										echo '
										<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
											<tbody>
												<tr>
												<th>Employer</th>
												<th>Date of Joining</th>
												<th>Date of Leaving</th>
												<th>Designation</th>
												<th>Nature of Job done</th>
												<th>Gross monthly pay</th>
											  </tr>';
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
										echo '	</tbody>
										</table>';
									}
								echo '<h4><b>17. Have you applied for any other post(s) at NIRM earlier ? (If applied during the last five years, please mention details):</b> '.$this->input->post('nirm_earlier').'</h4>';	
									
									if($this->input->post('advt_no'))
									{
										echo '<table class="table table1" border="1" style="border-collapse:collapse;width:100%;margin-bottom:20px;">
											<tbody>
												<tr>
													<th>Advt. No</th>
													<th>Date of Application</th>
													<th>Post applied for</th>
													<th>Whether called for Interview</th>
													<th>Date of Intervie</th>
												  </tr>';
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
											 echo '
											</tbody>
										</table>';
										}
								echo '	<h4 style="line-height:2"><b>18. Name and address of two Referees for verifying your credentials</b>
										<span><br>i. '.$this->input->post('referees_1').'<br>ii.'.$this->input->post('referees_2').'</span></h4>
										<h4><b>19.(a) Are you a Government Servant </b> : '.$this->input->post('govt_servant').'</h4>';
									
											if($this->input->post('govt_servant')=="Yes")
											{
												echo '<h4 style="margin-left: 17px;"><b>(b) Nature of Appointment ?</b> :'.$this->input->post('nature_app').'</h4>';
											}
										
									
								echo '	<h4><b>20.(a) You willing to accept the minimum initial emoluments offered ?</b> : '.$this->input->post('min_emoluments').'</h4>';
											if($this->input->post('min_emoluments')=="No")
											{
												echo '<h4 style="margin-left: 17px;"><b>(b) Lowest Initial monthly emoluments expected per month ?</b> :'.$this->input->post('lowest_initial').'</h4>';
											}
								echo '		<h4 style="margin-left: 17px;"><b>(c) Minimum joining time required, if selected for the post in days ?(Any request for extension of joining time will not normally be considered)</b> : '.$this->input->post('notice_period').'</h4>	
									
								</div>							

		';
	}
	function logout()
	{
		$this->session->unset_userdata('candidate_login');
		$this->session->unset_userdata('candidate_id');
		redirect('http://nirm.in');
	}
}
