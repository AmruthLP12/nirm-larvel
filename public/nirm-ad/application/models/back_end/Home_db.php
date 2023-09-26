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
	function get_all_clients()
	{
		$this->db->order_by('id','ASC');
		$query=$this->db->get('client');
		$q=$query->result_array();
		return $q;
	}
	function get_client_details($id)
	{
		$this->db->where('id',$id);
		$query=$this->db->get('client');
		$q=$query->result_array();
		return $q;
	}
	function save_clients()
	{
			$cmp_name=$this->input->post('cmp_name');
			$emp_name=$this->input->post('emp_name');
			$email=$this->input->post('email');
			$phone=$this->input->post('phone');
			$user_name=$this->input->post('user_name');
			$password=$this->input->post('pass');
			$en_psd=md5($password);
			
			$date=date("Y-m-d");
					
			$q=$this->db->query("INSERT INTO client(company_name,client_name,username,password,email,phone,psd,date) VALUES ('$cmp_name', '$emp_name', '$user_name', '$en_psd', '$email', '$phone', '$password', '$date')");	
	}
	function update_clients()
	{
		$id=$this->uri->segment(3);
		$cmp_name=$_POST['cmp_name'];
		
		$emp_name=$_POST['emp_name'];
		$email=$_POST['email'];
		$phone=$_POST['phone'];
		$user_name=$_POST['user_name'];
		$password=$_POST['pass'];
		$en_psd=md5($password);
			
		$date=date("Y-m-d");
		
		$q=$this->db->query("UPDATE client SET 
			company_name ='$cmp_name',client_name='$emp_name',username='$user_name',password='$en_psd',email='$email',phone='$phone',psd='$password' where id='$id'");	
	}
	function check_client_email_available()
	{
		$email=$this->input->post('email');
		$this->db->where('email',$email);
		$count=$this->db->count_all_results('client');
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
	function check_client_phone_available()
	{
		$phone=$this->input->post('phone');
		$this->db->where('phone',$phone);
		$count=$this->db->count_all_results('client');
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
		$count=$this->db->count_all_results('client');
		
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
	function delete_client()
	{
		$id=$this->input->post('id');
		$i=1;
		$sql=$this->db->query("delete from client where id='$id'");
	}
	
	function client_info($id)
	{
		$sql=$this->db->query("select * from client_updates where client_id='$id'");
		$q=$sql->result_array();
		
		return $q;
	}
	function save_client_updates()
	{
		$id=$this->uri->segment(3);
		
		$date=$this->input->post('date');
		$description=$this->input->post('description');
		
		$db_date=date("Y-m-d",strtotime($date));
		
		$data=array(
					"client_id"=>$id,
					"date"=>$db_date,
					"content"=>$description
					);
					
		$this->db->insert('client_updates',$data);
	}
	function delete_client_updates()
	{
		$id=$this->input->post('id');
		$this->db->where('id',$id);
		$this->db->delete('client_updates');
	}
	function change_psd()
	{
		$user_name=$this->input->post('user_name');
		$pass=$this->input->post('pass');
		$en_psd=md5($pass);
		
		$data=array('user_name'=>$user_name,'user_password'=>$en_psd);
		$this->db->where('user_id','1');
		$this->db->update('musermst',$data);
		
	}
}  
?>