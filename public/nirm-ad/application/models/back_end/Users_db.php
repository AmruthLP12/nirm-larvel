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
		$this->db->order_by('id','ASC');
		$query=$this->db->get('users');
		$q=$query->result_array();
		return $q;
	}
	function get_users_details($id)
	{
		$this->db->where('id',$id);
		$query=$this->db->get('users');
		$q=$query->result_array();
		return $q;
	}
	function save_users()
	{
			$full_name=$this->input->post('full_name');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$user_name=$this->input->post('user_name');
			$password=$this->input->post('pass');
			$en_psd=md5($password);
			
			$date=date("Y-m-d");
			
			$data=array("full_name"=>$full_name,"username"=>$user_name,"password"=>$en_psd,"email"=>$email,"phone"=>$phone,"psd"=>$password,"date"=>$date);
			$this->db->insert('users',$data);
			
	}
	function update_user()
	{
		$id=$this->uri->segment(3);
		
			$full_name=$this->input->post('full_name');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$user_name=$this->input->post('user_name');
			$password=$this->input->post('pass');
			$en_psd=md5($password);
			
			$data=array("full_name"=>$full_name,"username"=>$user_name,"password"=>$en_psd,"email"=>$email,"phone"=>$phone,"psd"=>$password);
		
			$this->db->where('id',$id);
			$this->db->update('users',$data);
	}
	function check_users_email_available()
	{
		$email=$this->input->post('email');
		$this->db->where('email',$email);
		$count=$this->db->count_all_results('users');
		if($count>=1)
		{  
			
			$msg="true";
			echo $msg;
		} 
		else
		{
			$msg="false";
			echo $msg;
		}	
		
		exit(0);
	}
	function check_users_phone_available()
	{
		$phone=$this->input->post('phone');
		$this->db->where('phone',$phone);
		$count=$this->db->count_all_results('users');
		if($count>=1)
		{  
			$msg="true";
			echo $msg;
		} 
		else
		{
			$msg="false";
			echo $msg;
		}
		exit(0);
	}
	function client_username_available()
	{
		$u_name=$this->input->post('u_name');
		$this->db->where('username',$u_name);
		$count=$this->db->count_all_results('users');
		
		if($count>=1)
		{  
			$msg="true";
			echo $msg;
		} 
		else
		{
			$msg="false";
			echo $msg;
		}	
		
		exit(0);
	}
	function delete_users()
	{
		$id=$this->input->post('id');
		$i=1;
		$sql=$this->db->query("delete from users where id='$id'");
	}
	
	function users_info($id)
	{
		$sql=$this->db->query("select * from user_updates where user_id='$id' order by id DESC");
		$q=$sql->result_array();
		
		return $q;
	}
	function save_users_updates()
	{
		$id=$this->uri->segment(3);
		
		$date=$this->input->post('date');
		$description=$this->input->post('description');
		$db_date=date("Y-m-d",strtotime($date));
		
		$data=array("user_id"=>$id,"date"=>$db_date,"content"=>$description);
					
		$this->db->insert('user_updates',$data);
	}
	function delete_users_updates()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('user_updates');
		
	}
	function users_common_msg()
	{
		$this->db->where('id','1');
		$query=$this->db->get('user_common_information');
		$q=$query->result_array();
		return $q;
	}
	function update_common_message()
	{
		$user_msg=$this->input->post('user_msg');
		$db_date=date("Y-m-d");
		
		$data=array("date"=>$db_date,"message"=>$user_msg);
		$this->db->where('id','1');
		$this->db->update('user_common_information',$data);
	}
}  
?>