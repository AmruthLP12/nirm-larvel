<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class Candidate_db extends CI_Model 
	{  
		function __construct()  
		{
			parent::__construct();
			$this->load->database();
			$this->load->library("session");
		}
		function get_all_candidates()
		{
			$this->db->order_by('id','DESC');
			$query=$this->db->get('candidate_details');
			$q=$query->result_array();
			return $q;
		}
		function delete_candidates()
		{
			$id=$this->input->post('id');
			$this->db->where('id',$id);
			$this->db->delete('candidate_details');
		}
	}  
?>