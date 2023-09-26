<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Home_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_job_details()
	{
		$this->db->where('status','0');
		$this->db->order_by('priority','DESC');
		$query=$this->db->get('job_details');
		$q=$query->result_array();
		return $q;
	}
	function save_application()
	{
		$user_id=$this->session->userdata('candidate_id');
		$application_no=$this->input->post('application_no');
		$ack_no=$this->input->post('ack_no');
		$post_name=$this->input->post('post_name');
		$post_code=$this->input->post('post_code');
		$qualification=$this->input->post('qualification');
		$name=$this->input->post('name');
		$fname=$this->input->post('fname');
		$occupation=$this->input->post('occupation');
		$address=str_replace("'","",$this->input->post('address'));
		$permanent_address=str_replace("'","",$this->input->post('permanent_address'));
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$nationality=$this->input->post('nationality');
		$passport=$this->input->post('passport');
		$citizen=$this->input->post('citizen');
		$state=$this->input->post('state');
		$other_country=$this->input->post('other_country');
		$skikkim=$this->input->post('skikkim');
		$marital=$this->input->post('marital');
		$dob=$this->input->post('dob');
		$place_birth=$this->input->post('place_birth');
		$present_work=$this->input->post('present_work');
		$category=$this->input->post('category');
		$suspended=$this->input->post('suspended');
		$arrested=$this->input->post('arrested');
		$medical=$this->input->post('medical');
		$medical_details=$this->input->post('medical_details');
		$religion=$this->input->post('religion');
		$religion_changed=$this->input->post('religion_changed');
		$int_journals=$this->input->post('int_journals');
		$int_symposium=$this->input->post('int_symposium');
		$national_journals=$this->input->post('national_journals');
		$national_symposium=$this->input->post('national_symposium');
		$other_publications=$this->input->post('other_publications');
		$significant_1=str_replace("'","",$this->input->post('significant_1'));
		$significant_2=str_replace("'","",$this->input->post('significant_2'));
		$significant_3=str_replace("'","",$this->input->post('significant_3'));
		$any_significant=$this->input->post('any_significant');
		$outside=$this->input->post('outside');
		$vrs=$this->input->post('vrs');
		$vrs_details=$this->input->post('vrs_details');
		$nirm_earlier=$this->input->post('nirm_earlier');
		$referees_1=str_replace("'","",$this->input->post('referees_1'));
		$referees_2=str_replace("'","",$this->input->post('referees_2'));
		$govt_servant=$this->input->post('govt_servant');
		$nature_app=$this->input->post('nature_app');
		$min_emoluments=$this->input->post('min_emoluments');
		$lowest_initial=$this->input->post('lowest_initial');
		$notice_period=$this->input->post('notice_period');
		
		$exam_passed=$this->input->post('exam_passed');
		$board=$this->input->post('board');
		$study=$this->input->post('study');
		$year_passing=$this->input->post('year_passing');
		$major_subjects=$this->input->post('major_subjects');
		$type=$this->input->post('type');
		$cgpa=$this->input->post('cgpa');
		$edu_class=$this->input->post('class');
		
		$country_visited=$this->input->post('country_visited');
		$period_visit=$this->input->post('period_visit');
		$purpose_visit=$this->input->post('purpose_visit');
		
		$employer=$this->input->post('employer');
		$doj=$this->input->post('doj');
		$date_leave=$this->input->post('date_leave');
		$designation=$this->input->post('designation');
		$job_done=$this->input->post('job_done');
		$gross_pay=$this->input->post('gross_pay');
		
		$advt_no=$this->input->post('advt_no');
		$date_apply=$this->input->post('date_apply');
		$post_applied=$this->input->post('post_applied');
		$called_interview=$this->input->post('called_interview');
		$date_interview=$this->input->post('date_interview');
		
		$suspended_info=str_replace("'","",$this->input->post('suspended_info'));
		$arrested_info=str_replace("'","",$this->input->post('arrested_info'));
		$religion_info=str_replace("'","",$this->input->post('religion_info'));
		
		$document_name=$this->input->post('document_name');
		
		$total_exp=$this->input->post('total_exp');
		$noa_doc="";
		
		$db_dob=date("Y-m-d",strtotime($dob));
		$db_apply_date=date("Y-m-d");
		
		if (!empty($_FILES['file']['name']))
        {
			$rand_no=date("is");
			$old_new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["file"]['name']));
			$new_name=str_replace(array('&'), '-',$old_new_name1);
            $config['upload_path'] = '../uploads/profile/';
            $config['allowed_types'] = '*';			
			$config['file_name'] = $new_name;
			$this->load->library('upload',$config);
            if ($this->upload->do_upload('file'))
            {
				$path="uploads/profile/".$new_name;
			}
		}
		if (!empty($_FILES['dob_proof']['name']))
        {
			$rand_no=date("is");
			$old_new_name2 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["dob_proof"]['name']));
			$new_name2=str_replace(array('&'), '-',$old_new_name2);
            $config2['upload_path'] = '../uploads/dob_proof/';
            $config2['allowed_types'] = '*';  
			$config2['file_name'] = $new_name2;
			$this->load->library('upload',$config2);
			$this->upload->initialize($config2);
            if ($this->upload->do_upload('dob_proof'))
            {
				$dob_proof="uploads/dob_proof/".$new_name2;
			}
		}
		if (!empty($_FILES['reserved']['name']))
        {
			$rand_no=date("is");
			$old_new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["reserved"]['name']));
			$new_name1=str_replace(array('&'), '-',$old_new_name1);
            $config1['upload_path'] = '../uploads/reserved_proof/';
            $config1['allowed_types'] = '*';  
			$config1['file_name'] = $new_name1;
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if ($this->upload->do_upload('reserved'))
            {
				$reserved="uploads/reserved_proof/".$new_name1;
			}
		}
		if (!empty($_FILES['noa_doc']['name']))
        {
			$rand_no=date("is");
			$old_new_name1 = $rand_no.rand(10,99).str_replace(" ","_",($_FILES["noa_doc"]['name']));
			$new_name1=str_replace(array('&'), '-',$old_new_name1);
            $config1['upload_path'] = '../uploads/noa_doc/';
            $config1['allowed_types'] = '*';  
			$config1['file_name'] = $new_name1;
			$this->load->library('upload',$config1);
			$this->upload->initialize($config1);
            if ($this->upload->do_upload('noa_doc'))
            {
				$noa_doc="uploads/noa_doc/".$new_name1;
			}
		}
		$sql=$this->db->query("INSERT INTO job_application(user_id,qualification,post_code,application_no,ack_no,job_applied_for,name,profile_picture,email,phone,father_name,occupation,address_communication,permanent_address,nationality,passport_no, indian_citizen,state,other_country,residence_nepal,maritial_status,date_birth,place_birth,present_work,caste_category,suspended_dismissed,arrested_prosecuted, medical_infirmity,medical_infirmity_details,religion,changed_religion,international_journals,international_symposium,national_journals,national_symposium, other_publications,significant_publications_1,significant_publications_2,significant_publications_3,significant_achievements,outside_india,retiree_vrs, details_retiree_vrs,applied_earlier_nirm,referees_1,referees_2,govt_servant,nature_appoinment,accept_minimal_salary,expected_month,joining_time_required,applied_date,suspended_info,arrested_info,religion_info,dob_proof,reserved_proof,total_experience,noa_document) 
		VALUES('$user_id','$qualification','$post_code','$application_no','$ack_no','$post_name', '$name', '$path', '$email', '$phone', '$fname', '$occupation', '$address', '$permanent_address', '$nationality', '$passport', '$citizen', '$state', '$other_country', '$skikkim', '$marital', '$db_dob', '$place_birth', '$present_work', '$category', '$suspended', '$arrested', '$medical', '$medical_details', '$religion', '$religion_changed', '$int_journals', '$int_symposium', '$national_journals', '$national_symposium', '$other_publications', '$significant_1', '$significant_2', '$significant_3', '$any_significant', '$outside', '$vrs', '$vrs_details', '$nirm_earlier', '$referees_1', '$referees_2', '$govt_servant', '$nature_app', '$min_emoluments', '$lowest_initial', '$notice_period', '$db_apply_date','$suspended_info','$arrested_info','$religion_info','$dob_proof','$reserved','$total_exp','$noa_doc')");
		
		$application_id=$this->db->insert_id();
		$this->session->set_userdata('ack_no',$application_id);
		
		for($i=0;$i<count($exam_passed);$i++)
		{
				$exam=$exam_passed[$i];
				$univer=$board[$i];
				$duration=$study[$i];
				$passing=$year_passing[$i];
				$major=$major_subjects[$i];
				$mark_type=$type[$i];
				$percentage=$cgpa[$i];
				$class=$edu_class[$i];
				$fpath="";
				if($_FILES["edu_file"]["size"][$i]>0)
				{
					$digit=rand(0,999);
					$filen = $digit.$_FILES["edu_file"]['name'][$i]; //file name
					$path = "../uploads/edu_certificate/".$filen;
					$fpath="uploads/edu_certificate/".$filen;										
					if(move_uploaded_file($_FILES["edu_file"]['tmp_name'][$i],$path)) 
					{
					}
				}
			if($exam !="" and $univer !="")
			{
				$qry1=$this->db->query("INSERT INTO job_education_details(job_app_id,exam_passed,university,duration_study,year_passing,major_subjects,cgpa,path,type,class)
				VALUES ('$application_id', '$exam', '$univer', '$duration', '$passing', '$major', '$percentage', '$fpath','$mark_type','$class')");
			}
		}
		for($j=0;$j<count($employer);$j++)
		{
			$emp=$employer[$j];
			$joining=date("Y-m-d",strtotime($doj[$j]));
			$leaving=date("Y-m-d",strtotime($date_leave[$j]));
			$position=$designation[$j];
			$job=$job_done[$j];
			$gross=$gross_pay[$j];
			$exp_path="";
				if($_FILES["exp_file"]["size"][$j]>0)
				{
					$digit=rand(0,999);
					$filen = $digit.$_FILES["exp_file"]['name'][$j]; //file name
					$path = "../uploads/experience_cert/".$filen;
					$exp_path="uploads/experience_cert/".$filen;										
					if(move_uploaded_file($_FILES["exp_file"]['tmp_name'][$j],$path)) 
					{
					}
				}
				if($emp !="")
				{
					$qry2=$this->db->query("INSERT INTO job_employment_details(job_app_id,employer,date_joining,date_leaving,designation,nature_job,gross_month_salary,certificate) 
					VALUES ('$application_id', '$emp', '$joining', '$leaving', '$position', '$job', '$gross','$exp_path')");
				}
		}
		for($k=0;$k<count($country_visited);$k++)
		{
			$visited=$country_visited[$k];
			$period=$period_visit[$k];
			$purpose=$purpose_visit[$k];
				if($visited !="")
				{
					$qry3=$this->db->query("INSERT INTO job_country_visited(job_app_id,country_visited,period_visit,purpose_visit) 
					VALUES ('$application_id', '$visited', '$period', '$purpose')");
				}
		}
		for($l=0;$l<count($advt_no);$l++)
		{
			$advt=$advt_no[$l];
			$apply_date=date("Y-m-d",strtotime($date_apply[$l]));
			$post_app=$post_applied[$l];
			$inter_called=$called_interview[$l];
			$inter_date=date("Y-m-d",strtotime($date_interview[$l]));
				if($advt !="")
				{
					$qry4=$this->db->query("INSERT INTO job_apply_nirm_earlier(job_app_id,advt_no,date_application,post_applied_for,called_interview,date_interview) 
					VALUES ('$application_id', '$advt', '$apply_date', '$post_app', '$inter_called', '$inter_date')");
				}
		}
		for($l=0;$l<count($document_name);$l++)
		{
			$doc_name=$document_name[$l];
				if($_FILES["document_file"]["size"][$l]>0)
				{
					$digit=rand(0,999);
					$filen = $digit.$_FILES["document_file"]['name'][$l]; //file name
					$path = "../uploads/documents/".$filen;
					$fpath="uploads/documents/".$filen;										
					if(move_uploaded_file($_FILES["document_file"]['tmp_name'][$l],$path)) 
					{
						$qry_ins=$this->db->query("INSERT INTO job_documents(job_app_id,document_name,path) VALUES ('$application_id', '$doc_name', '$fpath')");	
					}
				}
		}
		$this->db->where('id',$post_name);
		$query=$this->db->get('job_details');
		$q=$query->result_array();
		
		$this->load->library('email'); 
		
		$message="You have successfully applied for ".$q[0]['job_title']." under ".$post_code." category, your application no is ".$application_no." applied on ".date("d-m-Y",strtotime($db_apply_date))." and acknowledgment no is ".$ack_no." for your further reference.";
		
		$download_app=site_url('home/my_application/'.$ack_no);	
	
			require 'phpmail/PHPMailerAutoload.php';
			$smtp_usermail='recruitment@nirm.in';
			$smtp_userpwd='RCTnirm_2018@sripad';
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = "mail.nirm.in";
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username =$smtp_usermail;
			$mail->Password = $smtp_userpwd;
			
			$email_body  = "Dear ".$name.",<br><br>";
			$email_body .= $message."<br><br>";
			$email_body .= "<a href=".$download_app." target=_blank>Click here to print your application</a><br><br>";
			
			$subject="Job Application Submitted";
			$s_name="NIRM";
			$tomailLists = array($email);
			$arrlength = count($tomailLists);
			$mail->setFrom($smtp_usermail,$s_name);
			$mail->addReplyTo("nirmrecruitment@gmail.com", "NIRM");

				for($x = 0; $x < $arrlength; $x++) 
				{     
					$mail->addAddress($tomailLists[$x]);
				}
			$mail->Subject = $subject;
			$mail->msgHTML($email_body);
			$mail->send();
			
			$smtp_usermail1='recruitment@nirm.in';
			$smtp_userpwd1='RCTnirm_2018@sripad';
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = "mail.nirm.in";
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username =$smtp_usermail1;
			$mail->Password = $smtp_userpwd1;
			
			$message1="You have received new application for ".$q[0]['job_title']." under ".$post_code." category, Application no is ".$application_no." applied on ".date("d-m-Y",strtotime($db_apply_date))." and acknowledgment no is ".$ack_no." for your further reference.";
			
			$email_body1 = $message1."<br><br>";
			$email_body1 .= "<a href=".$download_app." target=_blank>Click here to Print </a><br><br>";
			$subject="New Application";
			$s_name="NIRM";
			$tomailLists = array("recruitment@nirm.in");
			$arrlength = count($tomailLists);
			$mail->setFrom($smtp_usermail,$s_name);
			$mail->addReplyTo($email, $name);

				for($x = 0; $x < $arrlength; $x++) 
				{     
					$mail->addAddress($tomailLists[$x]);
				}
			$mail->Subject = $subject;
			$mail->msgHTML($email_body1);
			$mail->send();
	}
	function save_continue()
	{
		$user_id=$this->session->userdata('candidate_id');
		$post_name=$this->input->post('post_name');
		$post_code=$this->input->post('post_code');
		$qualification=$this->input->post('qualification');
		$name=$this->input->post('name');
		$fname=$this->input->post('fname');
		$occupation=$this->input->post('occupation');
		$address=$this->input->post('address');
		$permanent_address=$this->input->post('permanent_address');
		$phone=$this->input->post('phone');
		$email=$this->input->post('email');
		$nationality=$this->input->post('nationality');
		$passport=$this->input->post('passport');
		$citizen=$this->input->post('citizen');
		$state=$this->input->post('state');
		$other_country=$this->input->post('other_country');
		$skikkim=$this->input->post('skikkim');
		$marital=$this->input->post('marital');
		$dob=$this->input->post('dob');
		$place_birth=$this->input->post('place_birth');
		$present_work=$this->input->post('present_work');
		$category=$this->input->post('category');
		$suspended=$this->input->post('suspended');
		$arrested=$this->input->post('arrested');
		$medical=$this->input->post('medical');
		$medical_details=$this->input->post('medical_details');
		$religion=$this->input->post('religion');
		$religion_changed=$this->input->post('religion_changed');
		$int_journals=$this->input->post('int_journals');
		$int_symposium=$this->input->post('int_symposium');
		$national_journals=$this->input->post('national_journals');
		$national_symposium=$this->input->post('national_symposium');
		$other_publications=$this->input->post('other_publications');
		$significant_1=$this->input->post('significant_1');
		$significant_2=$this->input->post('significant_2');
		$significant_3=$this->input->post('significant_3');
		$any_significant=$this->input->post('any_significant');
		$outside=$this->input->post('outside');
		$vrs=$this->input->post('vrs');
		$vrs_details=$this->input->post('vrs_details');
		$nirm_earlier=$this->input->post('nirm_earlier');
		$referees_1=$this->input->post('referees_1');
		$referees_2=$this->input->post('referees_2');
		$govt_servant=$this->input->post('govt_servant');
		$nature_app=$this->input->post('nature_app');
		$min_emoluments=$this->input->post('min_emoluments');
		$lowest_initial=$this->input->post('lowest_initial');
		$notice_period=$this->input->post('notice_period');
				
		$suspended_info=$this->input->post('suspended_info');
		$arrested_info=$this->input->post('arrested_info');
		$religion_info=$this->input->post('religion_info');
		
		$db_dob="";
		if($dob!="")
		{
			$db_dob=date("Y-m-d",strtotime($dob));
		}
		
		$today=date("Y-m-d");
		
		$this->db->where('user_id',$user_id);
		$this->db->where('job_applied_for',$post_name);
		$count=$this->db->count_all_results('temp_job_application');
		if($count>=1)
		{
			$data=array("user_id"=>$user_id,"job_applied_for"=>$post_name,"post_code"=>$post_code,"qualification"=>$qualification,"name"=>$name,"email"=>$email,"phone"=>$phone,"father_name"=>$fname,"occupation"=>$occupation,"address_communication"=>$address,"permanent_address"=>$permanent_address,"nationality"=>$nationality,"passport_no"=>$passport,"indian_citizen"=>$citizen,"state"=>$state,"other_country"=>$other_country,"maritial_status"=>$marital,"date_birth"=>$db_dob,"place_birth"=>$place_birth,"present_work"=>$present_work,"caste_category"=>$category,"suspended_dismissed"=>$suspended,"arrested_prosecuted"=>$arrested,"medical_infirmity"=>$medical,"medical_infirmity_details"=>$medical_details,"religion"=>$religion,"changed_religion"=>$religion_changed,"international_journals"=>$int_journals,"international_symposium"=>$int_symposium,"national_journals"=>$national_journals,"national_symposium"=>$national_symposium,"other_publications"=>$other_publications,"significant_publications_1"=>$significant_1,"significant_publications_2"=>$significant_2,"significant_publications_3"=>$significant_3,"significant_achievements"=>$any_significant,"outside_india"=>$outside,"retiree_vrs"=>$vrs,"details_retiree_vrs"=>$vrs_details,"applied_earlier_nirm"=>$nirm_earlier,"referees_1"=>$referees_1,"referees_2"=>$referees_2,"govt_servant"=>$govt_servant,"nature_appoinment"=>$nature_app,"accept_minimal_salary"=>$min_emoluments,"expected_month"=>$lowest_initial,"joining_time_required"=>$notice_period,"suspended_info"=>$suspended_info,"arrested_info"=>$arrested_info,"religion_info"=>$religion_info,"date"=>$today);
			
			$this->db->where('user_id',$user_id);
			$this->db->where('job_applied_for',$post_name);
			$this->db->update("temp_job_application",$data);
			
		}
		else
		{
			$data=array("user_id"=>$user_id,"job_applied_for"=>$post_name,"post_code"=>$post_code,"qualification"=>$qualification,"name"=>$name,"email"=>$email,"phone"=>$phone,"father_name"=>$fname,"occupation"=>$occupation,"address_communication"=>$address,"permanent_address"=>$permanent_address,"nationality"=>$nationality,"passport_no"=>$passport,"indian_citizen"=>$citizen,"state"=>$state,"other_country"=>$other_country,"maritial_status"=>$marital,"date_birth"=>$db_dob,"place_birth"=>$place_birth,"present_work"=>$present_work,"caste_category"=>$category,"suspended_dismissed"=>$suspended,"arrested_prosecuted"=>$arrested,"medical_infirmity"=>$medical,"medical_infirmity_details"=>$medical_details,"religion"=>$religion,"changed_religion"=>$religion_changed,"international_journals"=>$int_journals,"international_symposium"=>$int_symposium,"national_journals"=>$national_journals,"national_symposium"=>$national_symposium,"other_publications"=>$other_publications,"significant_publications_1"=>$significant_1,"significant_publications_2"=>$significant_2,"significant_publications_3"=>$significant_3,"significant_achievements"=>$any_significant,"outside_india"=>$outside,"retiree_vrs"=>$vrs,"details_retiree_vrs"=>$vrs_details,"applied_earlier_nirm"=>$nirm_earlier,"referees_1"=>$referees_1,"referees_2"=>$referees_2,"govt_servant"=>$govt_servant,"nature_appoinment"=>$nature_app,"accept_minimal_salary"=>$min_emoluments,"expected_month"=>$lowest_initial,"joining_time_required"=>$notice_period,"suspended_info"=>$suspended_info,"arrested_info"=>$arrested_info,"religion_info"=>$religion_info,"date"=>$today);
			
			$this->db->insert("temp_job_application",$data);
		}
	}
	function get_job_post_code()
	{
		$id=$this->input->post('job_id');
		
		$this->db->where('id',$id);
		$query=$this->db->get('job_details');
		$q=$query->result_array();
		return $q;
	}
	function check_job_condition()
	{
		$user_id=$this->session->userdata('candidate_id');
		$job_id=$this->input->post('job_id');
		$post_code=$this->input->post('post_code');
		
		$this->db->where('user_id',$user_id);
		$this->db->where('job_applied_for',$job_id);
		$this->db->where('post_code',$post_code);
		$count=$this->db->count_all_results('job_application');
		return $count;
	}
	function get_candidate_info()
	{
		$user_id=$this->session->userdata('candidate_id');
		$job_id=$this->input->post('job_id');
		$post_code=$this->input->post('post_code');
		$this->db->where('user_id',$user_id);
		$this->db->where('job_applied_for',$job_id);
		$this->db->where('post_code',$post_code);
		$query=$this->db->get('temp_job_application');
		$q=$query->result_array();
		if($q)
		{
			return $q;
		}
	}
	function validate_qualification()
	{
		$job_id=$this->input->post('post_name');
		$qualification=$this->input->post('qualification');
		
		$this->db->where('id',$job_id);
		$query=$this->db->get('job_details');
		$q=$query->result_array();
		
		$job_qualification=$q[0]['min_qualification'];
		
		if($qualification == $job_qualification)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function validate_age()
	{
		$dob=$this->input->post('dob');
		$category=$this->input->post('category');
		$job_id=$this->input->post('post_name');
		$vrs=$this->input->post('vrs');
		$job_for=$this->input->post('job_for');
		$post_code=$this->input->post('post_code');
		
		$db_dob=date('Y-m-d',strtotime($dob));
		
		$from = new DateTime($db_dob);
		$to   = new DateTime('today');
		
		$age=$from->diff($to)->y;
		
		$this->db->where('id',$job_id);
		$query=$this->db->get('job_details');
		$q=$query->result_array();
		
		$gen_age=$q[0]['general_age_limit'];
		$obc_age=$q[0]['obc_age_limit'];
		$sc_age=$q[0]['sc_st_age_limit'];
		
		if( strpos( $job_for, $category ) !== false)
		{
			if($category =="SC / ST" || $category =="ST")
			{
				if($post_code=="UR")
				{
					if($age<=$gen_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
				else
				{
					if($age<=$sc_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
			}
			else if($category =="General")
			{
				
				if($age<=$gen_age)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else if($category =="OBC")
			{
				if($post_code=="UR")
				{
					if($age<=$gen_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
				else
				{
					if($age<=$obc_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
			}
		}
		if( strpos( $job_for, "All") !== false)
		{
			if($category =="SC / ST" || $category =="ST")
			{
				if($post_code=="UR")
				{
					if($age<=$gen_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
				else
				{
					if($age<=$sc_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
			}
			else if($category =="General")
			{
				if($age<=$gen_age)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else if($category =="OBC")
			{
				if($post_code=="UR")
				{
					if($age<=$gen_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
				else
				{
					if($age<=$obc_age)
					{
						return 1;
					}
					else
					{
						return 0;
					}
				}
			}
		}
		else if(strpos( $job_for,"General") !== false)
		{
			if($post_code=="UR")
			{
				if($age<=$gen_age)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				if($age<=$gen_age)
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
		}
		else
		{
			return 0;
		}
	}
	function get_job()
	{
		$job_id=$this->input->post('job_id');
		
		$this->db->where('id',$job_id);
		$query=$this->db->get('job_details');
		$q=$query->result_array();
		return $q;
	}
	function get_acknowledgement()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->select('a.*,b.job_title');
		$this->db->from('job_application a');
		$this->db->join('job_details b','a.job_applied_for=b.id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_job_education_details()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->where('job_app_id',$id);
		
		$query=$this->db->get('job_education_details');
		$q=$query->result_array();
		return $q;
	}
	function get_doc_certificate()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_documents');
		$q=$query->result_array();
		return $q;
	}
	function get_details()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->select('a.*,b.job_title');
		$this->db->from('job_application a');
		$this->db->join('job_details b','a.job_applied_for=b.id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
	}
	function get_edu_details()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_education_details');
		$q=$query->result_array();
		return $q;
	}
	function get_country_details()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_country_visited');
		$q=$query->result_array();
		return $q;
	}
	function get_emp_details()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_employment_details');
		$q=$query->result_array();
		return $q;
	}
	function get_nirm_applied()
	{
		$id=$this->session->userdata('ack_no');
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_apply_nirm_earlier');
		$q=$query->result_array();
		return $q;
	}
	function candidate_login()
	{
		$uname=$this->input->post('uname');
		$password=$this->input->post('password');
		$en_psd=md5($password);
		
		$this->db->where("email",$uname);
		$this->db->where("password",$en_psd);
		$this->db->where("status","0");
		
		$count=$this->db->count_all_results('candidate_details');
		if($count>=1)
		{
			$this->db->where("email",$uname);
			$this->db->where("password",$en_psd);
			$this->db->where("status","0");
			$query=$this->db->get('candidate_details');
			$q=$query->result_array();
			$this->session->set_userdata('candidate_login','true');
			$this->session->set_userdata('candidate_id',$q[0]['id']);
			$this->session->set_userdata('candidate_name',$q[0]['name']);
			$this->session->set_userdata('candidate_phone',$q[0]['phone']);
			$this->session->set_userdata('candidate_email',$q[0]['email']);
			echo "success";
		}
		else
		{
			echo "failed";
		}
	}
	function candidate_register()
	{
		$name=$this->input->post('name');
		$email=$this->input->post('email');
		$phone=$this->input->post('phone');
		$user_pass=rand(100000,9999999);
		$date=date("Y-m-d");
		$enc_password=md5($user_pass);
		$data=array("name"=>$name,"email"=>$email,"phone"=>$phone,"password"=>$enc_password,"normal_psd"=>$user_pass,"date"=>$date);
		$this->db->insert("candidate_details",$data);
		$id=$this->db->insert_id();
		if($id)
		{
			$message="You have successfully registered with NIRM. Your password is ".$user_pass.".";
			require 'phpmail/PHPMailerAutoload.php';
			
			$smtp_usermail='recruitment@nirm.in';
			$smtp_userpwd='RCTnirm_2018@sripad';
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = "mail.nirm.in";
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username =$smtp_usermail;
			$mail->Password = $smtp_userpwd;
			
			$email_body  = "Dear ".$name.",<br><br>";
			$email_body .= $message."<br><br>";
			$email_body .= "<a href=https://nirm.in/apply-job/>Click here</a>"." to Login<br><br>";
			$email_body .= "Thanking You,"."<br><br>";
			$email_body .= "Team NIRM."."<br><br>";
			
			$subject="Online Registration";
			$s_name="NIRM";
			$tomailLists = array($email);
			$arrlength = count($tomailLists);
			$mail->setFrom($smtp_usermail,$s_name);
			$mail->addReplyTo("recruitment@nirm.in", "NIRM");

				for($x = 0; $x < $arrlength; $x++) 
				{     
					$mail->addAddress($tomailLists[$x]);
				}
			$mail->Subject = $subject;
			$mail->msgHTML($email_body);
			$mail->send();
		}
	}
	function check_user_email_availability()
	{
		$email=$this->input->post('email');
		$this->db->where('email',$email);
		$count=$this->db->count_all_results('candidate_details');
		return $count;
	}
	function check_user_phone_availability()
	{
		$phone=$this->input->post('phone');
		$this->db->where('phone',$phone);
		$count=$this->db->count_all_results('candidate_details');
		return $count;
	}
	function get_qualification()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$query=$this->db->get('job_details');
		$q=$query->result_array();
		$id=$q[0]['min_qualification'];
			
			$array=explode(",",$id);
			$str="";
			$i=1;
			foreach($array as $res)
			{
				if($i!=1)
				{
					$str.=",";
				}
				$str.="'".$res."'";
				$i++;
			}
		$query1=$this->db->query("select * from qualifications where id IN ($str) order by qualification ASC");
		$q1=$query1->result_array();
		
		return $q1;
	}
	function my_get_doc_certificate($id)
	{
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_documents');
		$q=$query->result_array();
		return $q;
	}
	function my_get_details($id)
	{
		$this->db->select('a.*,b.job_title');
		$this->db->from('job_application a');
		$this->db->join('job_details b','a.job_applied_for=b.id','left');
		$this->db->where('a.id',$id);
		$query=$this->db->get();
		$q=$query->result_array();
		return $q;
		
	}
	function my_get_edu_details($id)
	{
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_education_details');
		$q=$query->result_array();
		return $q;
	}
	function my_get_country_details($id)
	{
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_country_visited');
		$q=$query->result_array();
		return $q;
	}
	function my_get_emp_details($id)
	{
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_employment_details');
		$q=$query->result_array();
		return $q;
	}
	function my_get_nirm_applied($id)
	{
		$this->db->where('job_app_id',$id);
		$query=$this->db->get('job_apply_nirm_earlier');
		$q=$query->result_array();
		return $q;
	}
	function check_mail_forgot()
	{
		$email=$this->input->post('email');
		$this->db->where('email',$email);
		$count=$this->db->count_all_results('candidate_details');
		return $count;
	}
	function forgot_password()
	{
		$email=$this->input->post('email');
		$this->db->where('email',$email);
		$query=$this->db->get('candidate_details');
		$q=$query->result_array();
		if($q)
		{
			$name=$q[0]['name'];
			$psd=$q[0]['normal_psd'];
			
			require 'phpmail/PHPMailerAutoload.php';
			$smtp_usermail='recruitment@nirm.in';
			$smtp_userpwd='RCTnirm_2018@sripad';
			
			
			$mail = new PHPMailer;
			$mail->isSMTP();
			$mail->SMTPDebug = 0;
			$mail->Debugoutput = 'html';
			$mail->Host = "mail.nirm.in";
			$mail->Port = 587;
			$mail->SMTPAuth = true;
			$mail->Username =$smtp_usermail;
			$mail->Password = $smtp_userpwd;
			
			$email_body  = "Dear ".$name.",<br><br>";
			$email_body .= "Your Password is :".$psd."<br><br>";
			$email_body .= "<a href=https://nirm.in/apply-job/>Click here</a>"." to Login<br><br>";
			$email_body .= "Thanking You,"."<br><br>";
			$email_body .= "Team NIRM."."<br><br>";
			
			$subject="Online Registration";
			$s_name="NIRM";
			$tomailLists = array($email);
			$arrlength = count($tomailLists);
			$mail->setFrom($smtp_usermail,$s_name);
			$mail->addReplyTo("recruitment@nirm.in", "NIRM");

				for($x = 0; $x < $arrlength; $x++) 
				{     
					$mail->addAddress($tomailLists[$x]);
				}
			$mail->Subject = $subject;
			$mail->msgHTML($email_body);
			$mail->send();
			
			return 1;
			
		}
	}
}
?>