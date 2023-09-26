<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					 
					$this->load->helper('url');
					$this->load->model('back_end/home_db','home');
					$this->load->library("pagination");
					$this->load->library('email');
        }
	public function index()
	{
		$data['job']=$this->home->get_job_details();
		if($this->session->userdata('candidate_id'))
		{
			$data['candidate_info']="";
		}
		$this->load->view('front_end/index',$data);
	}
	public function save_application()
	{
		$data=$this->home->save_application();
		redirect('home/acknowledgement/');
	}
	public function acknowledgement()
	{
		$data['ack_data']=$this->home->get_acknowledgement();
		$data['file_uploaded']=$this->home->get_job_education_details();
		$this->load->view('front_end/acknowledgement',$data);
	}
	public function validate_qualification()
	{
		$data=$this->home->validate_qualification();
		echo $data;
	}
	public function validate_age()
	{
		$data=$this->home->validate_age();
		echo $data;
	}
	public function get_job()
	{
		$data=$this->home->get_job();
		$job_posting=$data[0]['job_posting_for'];
		$first_class=$data[0]['first_class'];
		
		$posting=explode(",",$job_posting);
		$posting_for="";
		$age_details="";
		foreach($posting as $res)
		{
			if($res=="All")
			{
				$posting_for.=$res;
				$age_details='
						<p><b>Age Limit For General </b>: '.$data[0]['general_age_limit'].'</p>
						<p><b>Age Limit For OBC </b>: '.$data[0]['obc_age_limit'].'</p>
						<p><b>Age Limit For SC / ST </b>: '.$data[0]['sc_st_age_limit'].'</p>';
			}
			else if($res=="SC / ST")
			{
				$posting_for.=$res;
				$age_details.='<p><b>Age Limit For SC / ST </b>: '.$data[0]['sc_st_age_limit'].'</p>';
			}
			else if($res=="OBC")
			{
				$posting_for.=$res;
				$age_details.='<p><b>Age Limit For OBC </b>: '.$data[0]['obc_age_limit'].'</p>';
			}
			else if($res=="General")
			{
				$posting_for.=$res;
				$age_details.='<p><b>Age Limit For General </b>: '.$data[0]['general_age_limit'].'</p>';
			}
				//<p><b>Minimum Qualification </b>: '.$data[0]['min_qualification'].'</p>
		}
				echo $job_posting.'****';
				echo $first_class.'****';
				echo $age_details;
				echo '
						<p><b>Job Type </b>: '.$data[0]['job_type'].'</p>
						<p><b>Nature of Job </b>: '.$data[0]['job_nature'].'</p>
						<p><b>Job For </b>: '.$job_posting.'</p>';
	}
	public function get_job_post_code()
	{
		$data=$this->home->get_job_post_code();
		$post_code_arr=$data[0]['post_code'];
		$result=explode('/',$post_code_arr);
		echo '<option value="">Select</option>';
		foreach($result as $row)
		{
			if($row!="")
			{
					echo '<option value="'.$row.'">'.$row.'</option>';
			}
		}
	}
	public function save_details()
	{
		$id=$this->input->post('id');
		$value=$this->input->post('value');
		$this->session->set_userdata($id,$value);
	}
	public function save_continue()
	{
		$this->home->save_continue();
		//redirect('home/');
		//$this->load->view('front_end/saved_successfull');
	}
	public function preview_submit()
	{
		echo '
			<div class="row">
				<div class="cell-6">
					<div class="form-input" style="margin: 0px 0 15px 0;">
						<label>Name<span class="red">*</span></label>
						<input type="text" required="required" name="name" id="name" style="width:100%;padding: 4px 13px;">
						<input type="hidden" required="required" name="base_url" id="base_url" value="<?php echo base_url();?>" style="width:100%;padding: 4px 13px;">
					</div>
				</div>
				<div class="cell-6">
					<div class="form-input" style="margin: 0px 0 15px 0;">
						<label>Email<span class="red">*</span></label>
						<input type="email" required="required" name="email" id="candidate_email" onchange="check_user_email_availability();" style="width:100%;padding: 4px 13px;">
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		
		';
	}
	public function check_job_condition()
	{
		$data=$this->home->check_job_condition();
		echo $data;
	}
	public function get_candidate_info()
	{
		$data=$this->home->get_candidate_info();
		$dob="";
		if($data[0]['date_birth']!="0000-00-00" and $data[0]['date_birth']!="")
		{
			$dob=date("d-m-Y",strtotime($data[0]['date_birth']));
		}
		if(!empty($data))
		{
			$candidate=$data[0]['name']."****".$data[0]['email']."****".$data[0]['phone']."****".$data[0]['father_name']."****".$data[0]['occupation']."****".$data[0]['address_communication']."****".$data[0]['permanent_address']."****".$data[0]['nationality']."****".$data[0]['indian_citizen']."****".$data[0]['state']."****".$data[0]['other_country']."****".$data[0]['maritial_status']."****".$dob."****".$data[0]['place_birth']."****".$data[0]['present_work']."****".$data[0]['caste_category']."****".$data[0]['suspended_dismissed']."****".$data[0]['arrested_prosecuted']."****".$data[0]['medical_infirmity']."****".$data[0]['medical_infirmity_details']."****".$data[0]['religion']."****".$data[0]['changed_religion']."****".$data[0]['international_journals']."****".$data[0]['international_symposium']."****".$data[0]['national_journals']."****".$data[0]['national_symposium']."****".$data[0]['other_publications']."****".$data[0]['significant_publications_1']."****".$data[0]['significant_publications_2']."****".$data[0]['significant_publications_3']."****".$data[0]['significant_achievements']."****".$data[0]['outside_india']."****".$data[0]['retiree_vrs']."****".$data[0]['details_retiree_vrs']."****".$data[0]['applied_earlier_nirm']."****".$data[0]['referees_1']."****".$data[0]['referees_2']."****".$data[0]['govt_servant']."****".$data[0]['nature_appoinment']."****".$data[0]['accept_minimal_salary']."****".$data[0]['expected_month']."****".$data[0]['joining_time_required']."****".$data[0]['suspended_info']."****".$data[0]['arrested_info']."****".$data[0]['religion_info']."****".$data[0]['post_code'];
			echo $candidate;
		}
	}
	public function take_print()
	{
		$data['details']=$this->home->get_details();
		$data['education_details']=$this->home->get_edu_details();
		$data['country_details']=$this->home->get_country_details();
		$data['emp_details']=$this->home->get_emp_details();
		$data['nirm_applied']=$this->home->get_nirm_applied();
		$data['doc_certificate']=$this->home->get_doc_certificate();
		$this->load->view('front_end/take_print',$data);
	}
	public function my_application()
	{
		$ack_no=$this->uri->segment(3);
		
		$this->db->where('ack_no',$ack_no);
		$query=$this->db->get('job_application');
		$q=$query->result_array();
		if($q)
		{
			$job_id=$q[0]['id'];
			
			$data['details']=$this->home->my_get_details($job_id);
			$data['education_details']=$this->home->my_get_edu_details($job_id);
			$data['country_details']=$this->home->my_get_country_details($job_id);
			$data['emp_details']=$this->home->my_get_emp_details($job_id);
			$data['nirm_applied']=$this->home->my_get_nirm_applied($job_id);
			$data['doc_certificate']=$this->home->my_get_doc_certificate($job_id);
			
			$this->load->view('front_end/take_print',$data);
		}
		else
		{
			redirect('');
		}
	}
	public function add_enquiry_div()
	{
		$counter=$_POST['counter'];
		$counter++;
		
			echo '
				<tr id="row_'.$counter.'">
					<td><input name="document_name[]" type="text" id="document_name_'.$counter.'" placeholder="Document Name"></td>
					<td><input type="file" name="document_file[]" class="form_control" id="document_file _'.$counter.'"></td>
					<td><a href="javascript:void(0);" id="'.$counter.'" onclick="remove_cycle_div(this.id)"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
				</tr>';
	}
	public function add_exp_table()
	{
		$counter1=$_POST['counter1'];
		$counter1++;
		
		echo '<tr id="abc_'.$counter1.'">
					<td><input name="employer[]" type="text" id="employer_'.$counter1.'" placeholder="Employer"></td>
					<td><input name="doj[]" type="text" id="doj_'.$counter1.'" class="datepicker" readonly autocomplete="off" placeholder="Date of Joining"></td>
					<td><input name="date_leave[]" type="text" id="date_leave_'.$counter1.'" class="datepicker" readonly autocomplete="off" placeholder="Date of Leaving"></td>
					<td><input name="designation[]" type="text" id="designation_'.$counter1.'" placeholder="Designation"></td>
					<td><input name="job_done[]" type="text" id="job_done_'.$counter1.'" placeholder="Nature of Job done"></td>
					<td><input name="gross_pay[]" type="text" id="gross_pay_'.$counter1.'" onkeypress="return isNumber(event)" maxlength="8" placeholder="Gross monthly pay"></td>
					<td><input name="exp_file[]" type="file" id="exp_file"></td>
					<td><a href="javascript:void(0);" id="'.$counter1.'" onclick="remove_exp_table(this.id)"><i class="fa fa-times-circle" aria-hidden="true"></i></td>
				</tr>';
	}
	public function add_edu_details()
	{
		$counter2=$_POST['counter2'];
		$counter2++;
		
		echo '<tr id="edu_'.$counter2.'">
					<td><input name="exam_passed[]" type="text" id="exam_passed_'.$counter2.'" required></td>
					<td><input name="board[]" onkeypress="return isalpha(event)" type="text" id="board_'.$counter2.'" required></td>
					<td><input name="study[]" maxlength="2" onkeypress="return isNumber(event)" type="text" id="study_'.$counter2.'" required></td>
					<td><input name="year_passing[]" maxlength="4" onkeypress="return isNumbera(event)" type="text" id="year_passing_'.$counter2.'" required></td>
					<td><input name="major_subjects[]" onkeypress="return isalpha(event)"  type="text" id="major_subjects_'.$counter2.'" required></td>
					<td>
						<select name="type[]" type="text" id="type_'.$counter2.'" required>
							<option value="">Select</option>
							<option value="%">%</option>
							<option value="CGPA">CGPA</option>
						</select>
					</td>
					<td><input name="cgpa[]" type="text" id="cgpa_'.$counter2.'" onkeypress="return validateFloatKeyPress(this,event);" required></td>
					<td><input name="class[]" onkeypress="return isalpha(event)" type="text" id="class_'.$counter2.'" required></td>
					<td><input name="edu_file[]" type="file" id="edu_file" required></td>					
					<td><a href="javascript:void(0);" id="'.$counter2.'" onclick="remove_edu_table(this.id)"><i class="fa fa-times-circle" aria-hidden="true"></i></a></td>
		
					
					
				</tr>';
	}
	function candidate_login()
	{
		$data=$this->home->candidate_login();
	}
	function candidate_register()
	{
		$data=$this->home->candidate_register();
		redirect('home/#thankyou');
	}
	function check_user_email_availability()
	{
		$data=$this->home->check_user_email_availability();
		echo $data;
	}
	function check_user_phone_availability()
	{
		$data=$this->home->check_user_phone_availability();
		echo $data;
	}
	function get_qualification()
	{
		$data=$this->home->get_qualification();
		
		echo "<option value=''>Select</option>";
		foreach($data as $res)
		{
			echo '<option value="'.$res['qualification'].'">'.$res['qualification'].'</option>';
		}
	}
	function check_mail_forgot()
	{
		$data=$this->home->check_mail_forgot();
		echo $data;
	}
	function forgot_password()
	{
		$data=$this->home->forgot_password();
		echo $data;
	}
	function logout()
	{
		$this->session->unset_userdata('candidate_login');
		$this->session->unset_userdata('candidate_id');
		redirect('http://nirm.in');
	}
}
