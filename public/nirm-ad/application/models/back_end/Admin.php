<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Admin extends CI_Model {  
  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function check_login()
	{
		$name=$this->input->post('username');
		$password=md5($this->input->post('password'));
		
		$this->db->where("user_name",$name);
		$this->db->where("user_password",$password);
		$query=$this->db->get('musermst');
		$res=$query->result_array();
		if($query->num_rows()==1)
		{
			$this->session->set_userdata('admin_id',$res[0]['user_id']);	
			$this->session->set_userdata('admin_login','true');
			$this->session->set_userdata('admin_name',$res[0]['user_name']);
			return "success";
		}
		else
		{
			return "false";
		}
	}

	function get_all_user()
	{
		$query=$this->db->get('user_details');
		$q=$query->result_array();
		return $q;
	}
	function get_single_user($id)
	{
		$this->db->where('id',$id);
		$query=$this->db->get('user_details');
		$q=$query->result_array();
		return $q;
	}
	function delete_user()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('user_details');
		
		$this->db->order_by('id','DESC');
		$query=$this->db->get('user_details');
		$q=$query->result_array();
		return $q;
	}
	
	function update_logout()
	{
		$id=$this->session->userdata('admin_id');
		$this->db->where('id',$id);
		$date_time=date('Y-m-d H:i:s');
		$data=array('last_logout'=>$date_time,'online_status'=>0);
		$this->db->update('musermst',$data);
	}
}  
?>