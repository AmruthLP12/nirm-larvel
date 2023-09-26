<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Job_details_db extends CI_Model 
	{  
		function __construct()  
		{
			parent::__construct();
			$this->load->database();
			$this->load->library("session");
		}
		function get_all_job()
		{
			$query=$this->db->query("select * from job_details where status !=2 order by priority DESC");
			$q=$query->result_array();
			$result=array();
			$i=0;
			foreach($q as $res)
			{
				$data['id']=$res['id'];
				$data['job_title']=$res['job_title'];
				$data['job_description']=$res['job_description'];
				$data['job_type']=$res['job_type'];
				$data['job_nature']=$res['job_nature'];
				$data['general_age_limit']=$res['general_age_limit'];
				$data['obc_age_limit']=$res['obc_age_limit'];
				$data['sc_st_age_limit']=$res['sc_st_age_limit'];
				$data['job_posting_for']=$res['job_posting_for'];
				$data['status']=$res['status'];
				$data['qualification']=$this->get_qualification_name($res['min_qualification']);
				array_push($result,$data);
			}
			
			return $result;
		}
		function get_qualification_name($id)
		{
			$array=explode(",",$id);
			$str="";
			foreach($array as $res)
			{
				$this->db->select('qualification');
				$this->db->where('id',$res);
				$query1=$this->db->get('qualifications');
				$q1=$query1->result_array();
				if(!empty($q1))
				{
					$str.=$q1[0]['qualification'].",";
				}
			}
			return $str;
		}
		function get_all_qualifications()
		{
			$this->db->where('status','0');
			$query=$this->db->get('qualifications');
			$q=$query->result_array();
			return $q;
		}
		function get_job_details()
		{
			$id=$this->uri->segment(3);
			
			$this->db->where('id',$id);
			$query=$this->db->get("job_details");
			$q=$query->result_array();
			return $q;
		}
		function save_job_details()
		{
			$job_title=$this->input->post('job_title');
			$min_qualification=$this->input->post('min_qualification');
			$job_type=$this->input->post('job_type');
			$job_nature=$this->input->post('job_nature');
			$description=$this->input->post('description');
			$general_age=$this->input->post('general_age');
			$obc_age=$this->input->post('obc_age');
			$sc_st_limit=$this->input->post('sc_st_limit');
			$posting_for=$this->input->post('posting_for');
			$status=$this->input->post('status');
			$post_code=$this->input->post('post_code');
			$priority=$this->input->post('priority');
			
			$min_qualify=implode(',',$min_qualification);
			$posting=implode(',',$posting_for);
			
			$data=array("job_title"=>$job_title,"job_description"=>$description,"job_type"=>$job_type,"job_nature"=>$job_nature,"post_code"=>$post_code,"job_posting_for"=>$posting,"general_age_limit"=>$general_age,"obc_age_limit"=>$obc_age,"sc_st_age_limit"=>$sc_st_limit,"min_qualification"=>$min_qualify,"status"=>$status,"priority"=>$priority);
			
			$this->db->insert('job_details',$data);
			$job_id=$this->db->insert_id();
		}
		function update_job_details()
		{
			$id=$this->uri->segment(3);
			$job_title=$this->input->post('job_title');
			$min_qualification=$this->input->post('min_qualification');
			$job_type=$this->input->post('job_type');
			$job_nature=$this->input->post('job_nature');
			$description=$this->input->post('description');
			$general_age=$this->input->post('general_age');
			$obc_age=$this->input->post('obc_age');
			$sc_st_limit=$this->input->post('sc_st_limit');
			$posting_for=$this->input->post('posting_for');
			$status=$this->input->post('status');
			$post_code=$this->input->post('post_code');
			$priority=$this->input->post('priority');
			
			$min_qualify=implode(',',$min_qualification);
			$posting=implode(',',$posting_for);

			$data=array("job_title"=>$job_title,"job_type"=>$job_type,"job_nature"=>$job_nature,"post_code"=>$post_code,"job_posting_for"=>$posting,"job_description"=>$description,"general_age_limit"=>$general_age,"obc_age_limit"=>$obc_age,"sc_st_age_limit"=>$sc_st_limit,"min_qualification"=>$min_qualify,"status"=>$status,"priority"=>$priority);
			$this->db->where('id',$id);
			$this->db->update('job_details',$data);
		}
		function delete_job_details()
		{
			$id=$this->input->post('id');
			$data=array("status"=>2);
			$this->db->where('id',$id);
			$this->db->update('job_details',$data);
		}
	}  
?>