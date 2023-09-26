<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_application extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/job_app_db','job');	
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['job']=$this->job->get_all_application();
			$data['all_job']=$this->job->get_all_job();
			$this->load->view('admin/back_end/job_application/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function filter_date()
	{
		$data=$this->job->filter_date();
		$i=1;			
				foreach($data as $row)
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
												<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_application(this.id)"><i class="fa fa-trash-o"></i> Delete</a></li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>';
					$i++;
				}
	}
	
	function view_application_details()
	{
		$data=$this->job->get_application_details();
		
		$id=$data[0]['id'];
		
		echo '
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<div class="col-md-10 col-sm-6">
							<h5 class="modal-title">'.ucwords($data[0]['name']).'</h5>
						</div>
						<div class="col-md-2 col-sm-6">
							<img src="../../../'.$data[0]['profile_picture'].'" width="100">
						</div>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-4 col-sm-6">
							<p><b>Name :</b> <span>'.ucwords($data[0]['name']).'</span></p>
							<p><b>DOB :</b> <span>'.date("d-m-Y",strtotime($data[0]['date_birth'])).'</span></p>
							<p><b>Father Name :</b> <span>'.ucwords($data[0]['father_name']).'</span></p>
							<p><b>Passport No :</b> <span>'.ucwords($data[0]['passport_no']).'</span></p>
							<p><b>Whether a person migrated from Pakistan/ Bangladesh ?:</b> <span>'.ucwords($data[0]['other_country']).'</span></p>
							<p><b>Place Birth :</b> <span>'.ucwords($data[0]['place_birth']).'</span></p>
							<p><b>Address for Communication :</b> <span>'.ucwords($data[0]['address_communication']).'</span></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<p><b>Job Applied For :</b> <span>'.$data[0]['job_title'].'</span></p>
							<p><b>Phone No :</b> <span>'.$data[0]['phone'].'</span></p>
							<p><b>Occupation :</b> <span>'.$data[0]['occupation'].'</span></p>
							
							<p><b>Whether a subject of Nepal or resident of Sikkim :</b> <span>'.$data[0]['residence_nepal'].'</span></p>
							<p><b>Nature of present work/ job :</b> <span>'.$data[0]['present_work'].'</span></p>
							<p><b>Permanent Address :</b> <span>'.$data[0]['permanent_address'].'</span></p>
						</div>
						<div class="col-md-4 col-sm-6">
							<p><b>Post Code & Category :</b> <span>'.$data[0]['post_code'].'</span></p>
							<p><b>Date of Apply :</b> <span>'.date("d-m-Y",strtotime($data[0]['applied_date'])).'</span></p>
							<p><b>Email :</b> <span>'.$data[0]['email'].'</span></p>
							<p><b>Nationality :</b> <span>'.$data[0]['nationality'].'</span></p>
							<p><b>Indian Citizen :</b> <span>'.$data[0]['indian_citizen'];
							if($data[0]['indian_citizen']=="Yes")
							{
								echo ' (State : '.$data[0]['state'].')';
							}
							echo '
							</span></p>
							<p><b>Maritial Status :</b> <span>'.$data[0]['maritial_status'].'</span></p>
							<p><b>Category :</b> <span>'.$data[0]['caste_category'].'</span></p>
						</div>
					</div>
					<hr>';
					echo '
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Have you ever been suspended / dismissed from past service :</b> <span> '.ucwords($data[0]['suspended_dismissed']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Have you ever been arrested / prosecuted (while in service or otherwise) :</span></b><span> '.ucwords($data[0]['arrested_prosecuted']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>You have any medical infirmity or have you been hospitalized for over three months :</b> <span> '.$data[0]['medical_infirmity'].'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Reason For Suspended :</b> <span> '.ucwords($data[0]['suspended_info']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Reason for arrested / prosecuted :</span></b><span> '.ucwords($data[0]['arrested_info']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Details for medical infirmity :</b> <span> '.ucwords($data[0]['medical_infirmity_details']).'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Religion :</span></b><span> '.ucwords($data[0]['religion']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Changed Religion :</b> <span> '.$data[0]['changed_religion'].'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Details fo Changed religion :</b> <span> '.$data[0]['religion_info'].'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>International Journals :</span></b><span> '.ucwords($data[0]['international_journals']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>International Symposium :</span></b><span> '.ucwords($data[0]['international_symposium']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>National Journals :</span></b><span> '.ucwords($data[0]['national_journals']).'</span></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>National Symposium :</span></b><span> '.ucwords($data[0]['national_symposium']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Other Publications :</span></b><span> '.ucwords($data[0]['other_publications']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Significant Publications (1) :</span></b><span> '.ucwords($data[0]['significant_publications_1']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Significant Publications (2) :</span></b><span> '.ucwords($data[0]['significant_publications_2']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Significant Publications (3) :</span></b><span> '.ucwords($data[0]['significant_publications_3']).'</span></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Significant Achievements :</span></b><span> '.ucwords($data[0]['significant_achievements']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Have you been outside India :</span></b><span> '.ucwords($data[0]['outside_india']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Are you a retiree/ VRS/ ex-servicemen :</span></b><span> '.ucwords($data[0]['retiree_vrs']).'</span></p>';
								if($data[0]['retiree_vrs']=="Yes")
								{
									echo '<p><b>If you a retiree/ ex-servicemen :</span></b><span> '.ucwords($data[0]['details_retiree_vrs']).'</span></p>';
								}
							echo '			
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Applied at Nirm Earlier :</span></b><span> '.ucwords($data[0]['applied_earlier_nirm']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Referees 1 :</span></b><span> '.ucwords($data[0]['referees_1']).'</span></p>
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Referees 2 :</span></b><span> '.ucwords($data[0]['referees_2']).'</span></p>		
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-6">
								<p><b>Are you a Government Servant :</span></b><span> '.ucwords($data[0]['govt_servant']).'</span></p>';
								if($data[0]['govt_servant']=="Yes")
								{
									echo '<p><b>Nature of Appointment :</span></b><span> '.ucwords($data[0]['nature_appoinment']).'</span></p>';
									echo '<p><b>Total Experience :</span></b><span> '.ucwords($data[0]['total_experience']).'</span></p>';
								}
								echo '	
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Accept the minimum initial emoluments :</span></b><span> '.ucwords($data[0]['accept_minimal_salary']).'</span></p>';
								if($data[0]['accept_minimal_salary']=="Yes")
								{
									echo '<p><b>Expected per month :</span></b><span> '.ucwords($data[0]['expected_month']).'</span></p>';
								}
								echo '	
							</div>
							<div class="col-md-4 col-sm-6">
								<p><b>Minimum joining time required :</span></b><span> '.ucwords($data[0]['joining_time_required']).'</span></p>
							</div>
						</div>
						<hr>
					';
					echo '<div class="row">
						<p><b>Education Details :</span></b></p>
						<table class="table">
							<thead>
								<tr>
									<th>Exam Passed</th>
									<th>University</th>
									<th>Duration Study</th>
									<th>Year Passing</th>
									<th>Major Subjects</th>
									<th>Type</th>
									<th>Mark</th>
									<th>Class</th>
									<th>Certificate</th>
								</tr>
							</thead>
							<tbody>';
							$qry1=$this->db->query("select * from job_education_details where job_app_id='$id'");
							$job_edu=$qry1->result_array();
							foreach($job_edu as $res1)
							{
								echo '
									<tr>
										<td>'.$res1['exam_passed'].'</td>
										<td>'.$res1['university'].'</td>
										<td>'.$res1['duration_study'].'</td>
										<td>'.$res1['year_passing'].'</td>
										<td>'.$res1['major_subjects'].'</td>
										<td>'.$res1['type'].'</td>
										<td>'.$res1['cgpa'].'</td>
										<td>'.$res1['class'].'</td>
										<td><a href="'.base_url()."../".$res1['path'].'" target="_blank"><i class="fa fa-file"></i></a></td>
									</tr>
								';
							}
					echo '	</tbody>
						</table>
						<hr>
					';
					echo '</div>';
					echo '<div class="row">
						<p><b>Employment Details :</span></b></p>					
						<table class="table">
							<thead>
								<tr>
									<th>Employer</th>
									<th>Date Joining</th>
									<th>Date Leaving</th>
									<th>Designation</th>
									<th>Nature Job</th>
									<th>Gross Month Salary</th>
									<th>Certificate</th>
								</tr>
							</thead>
							<tbody>';
							
							$qry2=$this->db->query("select * from job_employment_details where job_app_id='$id'");
							$job_emp=$qry2->result_array();
							
							foreach($job_emp as $res2)
							{
								echo '
									<tr>
										<td>'.$res2['employer'].'</td>
										<td>'.date("d-m-Y",strtotime($res2['date_joining'])).'</td>
										<td>'.date("d-m-Y",strtotime($res2['date_leaving'])).'</td>
										<td>'.$res2['designation'].'</td>
										<td>'.$res2['nature_job'].'</td>
										<td>'.$res2['gross_month_salary'].'</td>
										<td><a href="'.base_url()."../".$res2['certificate'].'" target="_blank"><i class="fa fa-file"></i></a></td>
									</tr>
								';
							}
					echo '	</tbody>
						</table>
					';
					echo '</div><hr>';
					if($data[0]['outside_india']=="Yes")
					{
						echo '<div class="row">
						<p><b>Country Visited :</span></b></p>					
						<table class="table">
							<thead>
								<tr>
									<th>Country Visited</th>
									<th>Period Visit</th>
									<th>Purpose Visit</th>
								</tr>
							</thead>
							<tbody>';
							
							$qry3=$this->db->query("select * from job_country_visited where job_app_id='$id'");
							$job_country=$qry3->result_array();
							
							foreach($job_country as $res3)
							{
								echo '
									<tr>
										<td>'.$res3['country_visited'].'</td>
										<td>'.$res3['period_visit'].'</td>
										<td>'.$res3['purpose_visit'].'</td>
									</tr>
								';
							}
					echo '</tbody></table>';
						echo '</div><hr>';
					}
					if($data[0]['applied_earlier_nirm']=="Yes")
					{
						echo '<div class="row">
						<p><b>Applied to Nirm :</span></b></p>					
						<table class="table">
							<thead>
								<tr>
									<th>Advt No</th>
									<th>Date Application</th>
									<th>Post Applied For</th>
									<th>Called Interview</th>
									<th>Date Interview</th>
								</tr>
							</thead>
							<tbody>';
							
							$qry4=$this->db->query("select * from job_apply_nirm_earlier where job_app_id='$id'");
							$job_apply_nirm=$qry4->result_array();
							foreach($job_apply_nirm as $res4)
							{
								echo '
									<tr>
										<td>'.$res4['advt_no'].'</td>
										<td>'.date("d-m-Y",strtotime($res4['date_application'])).'</td>
										<td>'.$res4['post_applied_for'].'</td>
										<td>'.$res4['called_interview'].'</td>
										<td>'.date("d-m-Y",strtotime($res4['date_interview'])).'</td>
									</tr>
								';
							}
					echo '</tbody></table>';
						echo '</div><hr>';
					}
						echo '<div class="row">';
							$i=1;
							
								echo '
									<div class="col-md-3 col-sm-6">
										<p><a href="../../../'.$data[0]['dob_proof'].'" target="_blank">Date of Birth Proof</a></p>
									</div>
									<div class="col-md-3 col-sm-6">
										<p><a href="../../../'.$data[0]['reserved_proof'].'" target="_blank">Reserved Category Proof</a></p>
									</div>
									
								';
								if($data[0]['govt_servant']=="Yes")
								{
									if($data[0]['noa_document']!="")
									{
										echo '<div class="col-md-3 col-sm-6">
											<p><a href="../../../'.$data[0]['noa_document'].'" target="_blank">NOA Document</a></p>
										</div>';
									}
								}
							
					
						echo '</div><hr>';
						
						echo '<div class="row">
						<p><b>Attached Other Documents :</span></b></p>';
							$i=1;
							$qry5=$this->db->query("select * from job_documents where job_app_id='$id'");
							$attachment=$qry5->result_array();
							foreach($attachment as $res5)
							{
								echo '
									<div class="col-md-3 col-sm-6">
										<p><a href="../../../'.$res5['path'].'" target="_blank">'.$res5['document_name'].'</a></p>
									</div>
								';
								$i++;
							}
					
						echo '</div><hr>';
					
			echo '</div>';
		
	}
	function download_report()
	{
		if($this->session->userdata('admin_login'))
		{
				$this->load->library('Excel');
				 $this->excel->setActiveSheetIndex(0);
				 
				 $this->excel->getActiveSheet()->setTitle('Application Report');
				 
				for($col = 'A'; $col != 'CC'; $col++) 
				{
					$this->excel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
				}
				 
				 $this->excel->getActiveSheet()->getStyle("A1:CB1")->applyFromArray(array("font" => array("bold" => true)));

				  $this->excel->setActiveSheetIndex(0)->setCellValue('A1', 'Sl. No');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('B1', 'Name of post applied for');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('C1', 'Name');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('D1', 'Qualification');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('E1', 'Profile Picture');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('F1', 'Email');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('G1', 'Phone');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('H1', 'Father Name');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('I1', 'Occupation');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('J1', 'Address Communication');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('K1', 'Permanent Address');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('L1', 'Nationality');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('M1', 'Indian Citizen');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('N1', 'State');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('O1', 'Other Country');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('P1', 'Residence Nepal');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('Q1', 'Maritial Status');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('R1', 'Date Birth');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('S1', 'Place Birth');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('T1', 'Present Work');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('U1', 'Caste Category');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('V1', 'Suspended Dismissed');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('W1', 'Reason for Suspended');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('X1', 'Arrested Prosecuted');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('Y1', 'Reason for Arrested');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('Z1', 'Medical Infirmity');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AA1', 'Medical Infirmity Details');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AB1', 'Religion');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AC1', 'Changed Religion');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AD1', 'Reason for Changed Religion');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AE1', 'International Journals');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AF1', 'International Symposium');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AG1', 'National Journals');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AH1', 'National Symposium');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AI1', 'Other Publications');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AJ1', 'Significant Publications_1');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AK1', 'Significant Publications_2');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AL1', 'Significant Publications_3');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AM1', 'Significant Achievements');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AN1', 'Outside India');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AO1', 'Applied Earlier Nirm');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AP1', 'Referees1');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AQ1', 'Referees2');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AR1', 'Govt Servant');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AS1', 'Nature of Appoinment');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AT1', 'Accept Minimal Salary');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AU1', 'Expected Month');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AV1', 'Joining Time Required');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AW1', 'Applied Date');
				  
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AX1', 'Exam Passed');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AY1', 'University / Board');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('AZ1', 'Study Duration');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BA1', 'Year of Passing');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BB1', 'Major Subjects');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BC1', 'Mark Type');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BD1', 'CGPA');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BE1', 'Class');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BF1', 'Certificate');
				 
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BG1', 'Employer');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BH1', 'Date Joining');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BI1', 'Date Leaving');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BJ1', 'Designation');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BK1', 'Nature Job');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BL1', 'Gross Month Salary');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BM1', 'Certificate');
				  
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BN1', 'Country Visited');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BO1', 'Period Visit');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BP1', 'Purpose Visit');
				  
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BQ1', 'Advt No');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BR1', 'Date Application');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BS1', 'Post Applied For');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BT1', 'Called Interview');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BU1', 'Date Interview');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BV1', 'DOB Proof');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BW1', 'Reserved Category Proof');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BY1', 'Uploaded Documents Name');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('BZ1', 'Path');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('CB1', 'Post Code & Category');
				  $this->excel->setActiveSheetIndex(0)->setCellValue('CC1', 'NOA Document');


			/**************************************************************************************************************************/
					$n=3;
					$i=1;
				$data=$this->job->filter_date_download();
				
				foreach($data as $row)
				{
					  $this->excel->setActiveSheetIndex(0)->setCellValue('A'.$n, $i);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('B'.$n, $row['job_title']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('C'.$n, $row['name']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('D'.$n, $row['qualification']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('E'.$n, base_url().'../'.$row['profile_picture']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('F'.$n, $row['email']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('G'.$n, $row['phone']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('H'.$n, $row['father_name']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('I'.$n, $row['occupation']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('J'.$n, $row['address_communication']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('K'.$n, $row['permanent_address']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('L'.$n, $row['nationality']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('M'.$n, $row['indian_citizen']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('N'.$n, $row['state']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('O'.$n, $row['other_country']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('P'.$n, $row['residence_nepal']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('Q'.$n, $row['maritial_status']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('R'.$n, date("d-m-Y",strtotime($row['date_birth'])));
					  $this->excel->setActiveSheetIndex(0)->setCellValue('S'.$n, $row['place_birth']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('T'.$n, $row['present_work']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('U'.$n, $row['caste_category']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('V'.$n, $row['suspended_dismissed']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('W'.$n, $row['suspended_info']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('X'.$n, $row['arrested_prosecuted']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('Y'.$n, $row['arrested_info']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('Z'.$n, $row['medical_infirmity']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AA'.$n, $row['medical_infirmity_details']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AB'.$n, $row['religion']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AC'.$n, $row['changed_religion']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AD'.$n, $row['religion_info']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AE'.$n, $row['international_journals']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AF'.$n, $row['international_symposium']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AG'.$n, $row['national_journals']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AH'.$n, $row['national_symposium']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AI'.$n, $row['other_publications']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AJ'.$n, $row['significant_publications_1']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AK'.$n, $row['significant_publications_2']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AL'.$n, $row['significant_publications_3']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AM'.$n, $row['significant_achievements']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AN'.$n, $row['outside_india']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AO'.$n, $row['applied_earlier_nirm']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AP'.$n, $row['referees_1']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AQ'.$n, $row['referees_2']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AR'.$n, $row['govt_servant']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AS'.$n, $row['nature_appoinment']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AT'.$n, $row['accept_minimal_salary']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AU'.$n, $row['expected_month']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AV'.$n, $row['joining_time_required']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('AW'.$n, date("d-m-Y",strtotime($row['applied_date'])));
					  
					  $a=$n;
					  $b=$n;
					  $c=$n;
					  $d=$n;
					  $e=$n;
					  $f=$n;
					  $g=$n;
					  $this->db->where('job_app_id',$row['id']);
					  $query1=$this->db->get('job_education_details');
					  $q1=$query1->result_array();
					  foreach($q1 as $res1)
					  {
							  $this->excel->setActiveSheetIndex(0)->setCellValue('AX'.$a, $res1['exam_passed']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('AY'.$a, $res1['university']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('AZ'.$a, $res1['duration_study']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('BA'.$a, $res1['year_passing']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('BB'.$a, $res1['major_subjects']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('BC'.$a, $res1['type']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('BD'.$a, $res1['cgpa']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('BE'.$a, $res1['class']);
							  $this->excel->setActiveSheetIndex(0)->setCellValue('BF'.$a, base_url().'../'.$res1['path']);	
						 $a++;
					  }
					  $this->db->where('job_app_id',$row['id']);
					  $query2=$this->db->get('job_employment_details');
					  $q2=$query2->result_array();
					  foreach($q2 as $res2)
					  {
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BG'.$b, $res2['employer']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BH'.$b, date('d-m-Y',strtotime($res2['date_joining'])));
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BI'.$b, date('d-m-Y',strtotime($res2['date_leaving'])));
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BJ'.$b, $res2['designation']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BK'.$b, $res2['nature_job']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BL'.$b, $res2['gross_month_salary']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BM'.$b, base_url().'../'.$res2['certificate']);
						  
						  $b++;
					  }
					  $this->db->where('job_app_id',$row['id']);
					  $query3=$this->db->get('job_country_visited');
					  $q3=$query3->result_array();
					  foreach($q3 as $res3)
					  {
							$this->excel->setActiveSheetIndex(0)->setCellValue('BN'.$c, $res3['country_visited']);
							$this->excel->setActiveSheetIndex(0)->setCellValue('BO'.$c, $res3['period_visit']);
							$this->excel->setActiveSheetIndex(0)->setCellValue('BP'.$c, $res3['purpose_visit']);
						
							$c++;
					  }
					  $this->db->where('job_app_id',$row['id']);
					  $query4=$this->db->get('job_apply_nirm_earlier');
					  $q4=$query4->result_array();
					  foreach($q4 as $res4)
					  {
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BQ'.$d, $res4['advt_no']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BR'.$d, date("d-m-Y",strtotime($res4['date_application'])));
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BS'.$d, $res4['post_applied_for']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BT'.$d, $res4['called_interview']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BU'.$d, date("d-m-Y",strtotime($res4['date_interview'])));
						  $d++;
					  }
					  $this->excel->setActiveSheetIndex(0)->setCellValue('BV'.$n, base_url().'../'.$row['dob_proof']);
					  $this->excel->setActiveSheetIndex(0)->setCellValue('BW'.$n, base_url().'../'.$row['reserved_proof']);
					  
					  $this->db->where('job_app_id',$row['id']);
					  $query5=$this->db->get('job_documents');
					  $q5=$query5->result_array();
					  foreach($q5 as $res5)
					  {
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BY'.$e, $res5['document_name']);
						  $this->excel->setActiveSheetIndex(0)->setCellValue('BZ'.$e, base_url().'../'.$res5['path']);
						  $e++;
					  }
					   $this->excel->setActiveSheetIndex(0)->setCellValue('CB'.$n, $row['post_code']);
					   if($row['noa_document'] !="")
					   {
						    $this->excel->setActiveSheetIndex(0)->setCellValue('CC'.$n, base_url().'../'.$row['noa_document']);
					   }
					  
					   
						$result=array($a,$b,$c,$d,$e);
						$n=max($result);
					  $n++;
					  $i++;
				}                                                               
				
				  
			/**************************************************************************************************************************/  
				  
						  $filename=date("d-m-Y").' Application Details.xls';
						  header('Content-Type: application/vnd.ms-excel');
						  header('Content-Disposition: attachment;filename="'.$filename.'"');
						  header('Cache-Control: max-age=0');
						  $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
						  $objWriter->save('php://output');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_job_application()
	{
		$data=$this->job->delete_job_application();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
