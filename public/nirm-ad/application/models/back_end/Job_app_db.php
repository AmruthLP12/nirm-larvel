<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
 
	class Job_app_db extends CI_Model 
	{  
		function __construct()  
		{
			parent::__construct();
			$this->load->database();
			$this->load->library("session");
		}
		function get_all_application()
		{
			$this->db->select("a.*,b.job_title");
			$this->db->from("job_application a");
			$this->db->join("job_details b","a.job_applied_for=b.id");
			$this->db->order_by('a.id','DESC');
			$query=$this->db->get();
			$q=$query->result_array();
			return $q;
		}
		function get_application_details()
		{
			$id=$this->input->post('id');
			
			$this->db->select("a.*,b.job_title");
			$this->db->from("job_application a");
			$this->db->join("job_details b","a.job_applied_for=b.id");
			$this->db->where('a.id',$id);
			$query=$this->db->get();
			$q=$query->result_array();
			return $q;
		}
		function get_all_job()
		{
			$query=$this->db->query("select * from job_details where status !=2 order by priority DESC");
			$q=$query->result_array();
			return $q;
		}
		function filter_date()
		{
			$job=$this->input->post('job_id');
			$fdate=$this->input->post('fdate');
			$tdate=$this->input->post('tdate');
			$post_code=$this->input->post('post_code');
			
			$from_date=date('Y-m-d',strtotime($fdate));
			$to_date=date('Y-m-d',strtotime($tdate));
			
			$this->db->select("a.*,b.job_title");
			$this->db->from("job_application a");
			$this->db->join("job_details b","a.job_applied_for=b.id");
			
			if($job !="")
			{
				$this->db->where('a.job_applied_for',$job);
			}
			if($fdate !="" && $tdate!="")
			{
				$this->db->where('a.applied_date >=',$from_date);
				$this->db->where('a.applied_date <=',$to_date);
			} 
			if($fdate !="" && $tdate=="")
			{
				$this->db->where('a.applied_date',$from_date);
			}
			if($post_code !="")
			{
				$this->db->where('a.post_code',$post_code);
			}
			$query=$this->db->get();
			$q=$query->result_array();
			return $q;
		}
		function filter_date_download()
		{
			$job=$this->input->post('job_id');
			$fdate=$this->input->post('pick_date');
			$tdate=$this->input->post('to_date');
			
			$from_date=date('Y-m-d',strtotime($fdate));
			$to_date=date('Y-m-d',strtotime($tdate));
			
			$this->db->select("a.*,b.job_title");
			$this->db->from("job_application a");
			$this->db->join("job_details b","a.job_applied_for=b.id");
			
			if($job !="")
			{
				$this->db->where('a.job_applied_for',$job);
			}
			if($fdate !="" && $tdate!="")
			{
				$this->db->where('a.applied_date >=',$from_date);
				$this->db->where('a.applied_date <=',$to_date);
			} 
			if($fdate !="" && $tdate=="")
			{
				$this->db->where('a.applied_date',$from_date);
			}
			$query=$this->db->get();
			$q=$query->result_array();
			
			return $q;
		}
		function delete_job_application()
		{
			$id=$this->input->post('id');
			$this->db->where('id',$id);
			$this->db->delete('job_application');
		}
	}
	
?>