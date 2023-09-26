<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/home_db','home');	
					$this->load->library("pagination");
        }
	
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['clients']=$this->home->get_all_clients();
			$this->load->view('admin/back_end/client/index',$data);
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
			$this->load->view('admin/back_end/client/add_client');
		}
		else
		{
			redirect('home/index');
		}	
	}
	function edit_clients()
	{
		if($this->session->userdata('admin_login'))
		{
			$id=$this->uri->segment(3);
			$data['client_details']=$this->home->get_client_details($id);
			$this->load->view('admin/back_end/client/edit_client',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_clients()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->home->save_clients();
			redirect('clients/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_clients()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->home->update_clients();
			redirect('clients/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_client()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->home->delete_client();
			$clients=$this->home->get_all_clients();
			$i=1;
			foreach($clients as $row)
			{
				$id=$row['id'];
				$en_id=base64_encode($id);
				echo '
						<tr>
						<td>'.$i.'</td>
						<td>'.$row['company_name'].'</td>
						<td>'.$row['client_name'].'</td>
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
											<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="client_info(this.id)"><i class="fa fa-upload" aria-hidden="true"></i> Update Info</a></li>
											<li><a href="'.site_url('clients/edit_clients/'.$row['id']).'"><i class="fa fa-pencil"></i> Edit Details</a></li>
											<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_client(this.id)"><i class="fa fa-trash-o"></i> Delete</a></li>
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
		$data=$this->home->client_username_available();
	}
	function check_client_phone_available()
	{
		$data=$this->home->check_client_phone_available();
	}
	function check_client_email_available()
	{
		$data=$this->home->check_client_email_available();
	}
	function update_client_info()
	{
		$id=$this->uri->segment(3);
		$data['client_id']=$id;
		$data['client_info']=$this->home->client_info($id);
		$this->load->view('admin/back_end/client/add_client_updates',$data);
	}
	function save_client_updates()
	{
		$data=$this->home->save_client_updates();
		redirect('clients/');
	}
	function delete_client_updates()
	{
		$data=$this->home->delete_client_updates();
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
