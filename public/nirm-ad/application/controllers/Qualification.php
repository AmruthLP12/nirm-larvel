<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualification extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/qualification_db','qualification');	
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['qualification']=$this->qualification->get_all_qualification();
			$this->load->view('admin/back_end/qualification/index',$data);
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
			$this->load->view('admin/back_end/qualification/add_new');
		}
		else
		{
			redirect('home/index');
		}	
	}
	function edit_qualification()
	{
		if($this->session->userdata('admin_login'))
		{
			$id=$this->uri->segment(3);
			$data['qualification']=$this->qualification->get_qualification_details($id);
			$this->load->view('admin/back_end/qualification/edit_qualification',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_qualification()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->qualification->save_qualification();
			redirect('qualification/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->qualification->update_details();
			redirect('qualification/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_qualification()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->qualification->delete_qualification();
			$jobs=$this->qualification->get_all_qualification();
			$i=1;					
			foreach($jobs as $row)
			{
				$id=$row['id'];
				$status="";
				if($row['status']==0)
				{
					$status="Enabled";
				}
				else
				{
					$status="Disabled";
				}
				echo '
						<tr>
						<td>'.$i.'</td>
						<td>'.$row['qualification'].'</td>			
						<td>'.$status.'</td>					
						<td><a href="'.site_url('qualification/edit_qualification/'.$row['id']).'"><i class="fa fa-pencil"></i> Edit Details</a></td>
						<td><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_qualification(this.id)"><i class="fa fa-trash-o"></i> Delete</a></td>
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
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
