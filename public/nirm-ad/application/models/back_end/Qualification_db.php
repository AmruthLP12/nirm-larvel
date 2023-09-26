<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Qualification_db extends CI_Model 
	{  
		function __construct()  
		{
			parent::__construct();
			$this->load->database();
			$this->load->library("session");
		}
		function get_all_qualification()
		{
			$query=$this->db->query("select * from qualifications where status !=2 order by id DESC");
			$q=$query->result_array();
			return $q;
		}
		function get_qualification_details()
		{
			$id=$this->uri->segment(3);
			
			$this->db->where('id',$id);
			$query=$this->db->get("qualifications");
			$q=$query->result_array();
			return $q;
		}
		function save_qualification()
		{
			$job_qualification=$this->input->post('job_qualification');
			$status=$this->input->post('status');
			
			$data=array("qualification"=>$job_qualification,"status"=>$status);
			$this->db->insert('qualifications',$data);
		}
		function update_details()
		{
			$id=$this->uri->segment(3);
			
			$job_qualification=$this->input->post('job_qualification');
			$status=$this->input->post('status');
			
			$data=array("qualification"=>$job_qualification,"status"=>$status);
			
			$this->db->where('id',$id);
			$this->db->update('qualifications',$data);
		}
		function delete_qualification()
		{
			$id=$this->input->post('id');
			$data=array("status"=>2);
			$this->db->where('id',$id);
			$this->db->update('qualifications',$data);
		}
	}  
?>