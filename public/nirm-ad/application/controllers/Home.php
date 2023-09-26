<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/admin');
					$this->load->model('back_end/home_db','home');	
					$this->load->model('back_end/job_details_db','job');
					$this->load->library("pagination");
        }
	public function index()
	{
		$this->load->view('admin/index');
	}
	public function process_login()
	{
		$data=$this->admin->check_login();
			if($data=="success")
			{
				redirect('home/dashboard');
			}
			else
			{
				$this->session->set_flashdata('abc','error');
				redirect('home/index');
			}
	}
	public function dashboard()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['job']=$this->job->get_all_job();
			$this->load->view('admin/back_end/job_details/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function reset_password()
	{
		if($this->session->userdata('admin_login'))
		{
			$query=$this->db->get('musermst');
			$data['user_details']=$query->result_array();
			$this->load->view('admin/back_end/change_password/reset_password',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function change_psd()
	{
		if($this->session->userdata('admin_login'))
		{
			$this->home->change_psd();
			redirect('home/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
