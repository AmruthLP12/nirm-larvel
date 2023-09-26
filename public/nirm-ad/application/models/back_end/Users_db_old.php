<?php
defined('BASEPATH') OR exit('No direct script access allowed');  
  
class Users_db extends CI_Model 
{  
    function __construct()  
    {
        parent::__construct();
		$this->load->database();
		$this->load->library("session");
    }
	function get_all_users()
	{
		$this->db->where('user_type!=','0');
		$this->db->order_by('id','DESC');
		$query=$this->db->get('musermst');
		$q=$query->result_array();
		return $q;
	}
	function get_user_details()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$query=$this->db->get('musermst');
		$q=$query->result_array();
		return $q;
	}
	function save_users()
	{
		$user_type=$this->input->post('user_type');
		$username=$this->input->post('username');
		$psd=$this->input->post('password');
		$status=$this->input->post('status');
		$password=md5($psd);
		$date=date("Y-m-d");
		
		$data=array(
					"username"=>$username,"password"=>$password,"psd"=>$psd,"user_type"=>$user_type,"date"=>$date,"status"=>$status);
			
			$this->db->insert('musermst',$data);
		
	}
	function update_users()
	{
		$id=$this->uri->segment(3);
		
		$user_type=$this->input->post('user_type');
		$username=$this->input->post('username');
		$psd=$this->input->post('password');
		$status=$this->input->post('status');
		$password=md5($psd);
		$date=date("Y-m-d");
		
		$data=array("username"=>$username,"password"=>$password,"psd"=>$psd,"user_type"=>$user_type,"status"=>$status);
			$this->db->where('id',$id);
			$this->db->update('musermst',$data);
		
	}
	function change_user_status()
	{
		$id=$this->input->post('id');
		$value=$this->input->post('value');
		
		$data=array('status'=>$value);
		$this->db->where('id',$id);
		$this->db->update('musermst',$data);
	}
	function delete_user()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('musermst');
	}
}  
?>