<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/users_db','users');	
					$this->load->library("pagination");
        }
	
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['common_msg']=$this->users->users_common_msg();
			$data['users']=$this->users->get_all_users();
			$this->load->view('admin/back_end/users/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function add_new()
	{
		if($this->session->userdata('admin_login'))
		{
			$this->load->view('admin/back_end/users/add_user');
		}
		else
		{
			redirect('home/index');
		}	
	}
	function edit_user()
	{
		if($this->session->userdata('admin_login'))
		{
			$id=$this->uri->segment(3);
			$data['user_details']=$this->users->get_users_details($id);
			$this->load->view('admin/back_end/users/edit_user',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_users()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->users->save_users();
			redirect('users/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_user()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->users->update_user();
			redirect('users/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_users()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->users->delete_users();
			$users=$this->users->get_all_users();
			$i=1;
			foreach($users as $row)
			{
				$id=$row['id'];
				$en_id=base64_encode($id);
				echo '
						<tr>
						<td>'.$i.'</td>
						<td>'.$row['full_name'].'</td>
						<td>'.$row['username'].'</td>
						<td>'.$row['psd'].'</td>
						<td>'.$row['email'].'</td>
						<td>'.$row['phone'].'</td>						
						<td>
								<ul class="icons-list">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>
										<ul class="dropdown-menu dropdown-menu-right">
											<li><a href="'.site_url('users/update_client_info/'.$row['id']).'"><i class="fa fa-upload" aria-hidden="true"></i> Update Info</a></li>
											<li><a href="'.site_url('users/edit_user/'.$row['id']).'"><i class="fa fa-pencil"></i> Edit Details</a></li>
											<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_users(this.id)"><i class="fa fa-trash-o"></i> Delete</a></li>
										</ul>
									</li>
								</ul>
							</td>
						
						</tr>
				';
				$i++;
			}
		}
		else
		{
			redirect('home/index');
		}
	}
	function client_username_available()
	{
		$data=$this->users->client_username_available();
	}
	function check_users_phone_available()
	{
		$data=$this->users->check_users_phone_available();
	}
	function check_users_email_available()
	{
		$data=$this->users->check_users_email_available();
	}
	function update_users_info()
	{
		$id=$this->uri->segment(3);
		$data['user_id']=$id;
		$data['user_info']=$this->users->users_info($id);
		
		$this->load->view('admin/back_end/users/add_user_updates',$data);
	}
	function save_users_updates()
	{
		$data=$this->users->save_users_updates();
		redirect('users/');
	}
	function delete_users_info()
	{
		$data=$this->users->delete_users_updates();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
	function update_common_message()
	{
		$data=$this->users->update_common_message();
		redirect('users/');
	}
}
