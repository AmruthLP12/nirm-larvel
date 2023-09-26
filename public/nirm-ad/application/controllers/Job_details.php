<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_details extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/job_details_db','job');	
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['job']=$this->job->get_all_job();
			//print_r($data['job']);
			$this->load->view('admin/back_end/job_details/index',$data);
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
			$data['qualification']=$this->job->get_all_qualifications();
			$this->load->view('admin/back_end/job_details/add_job',$data);
		}
		else
		{
			redirect('home/index');
		}	
	}
	function edit_job_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$id=$this->uri->segment(3);
			$data['qualification']=$this->job->get_all_qualifications();
			$data['job_details']=$this->job->get_job_details($id);
			$this->load->view('admin/back_end/job_details/edit_job_details',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	function save_job_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->job->save_job_details();
			redirect('job_details/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function update_job_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->job->update_job_details();
			redirect('job_details/');
		}
		else
		{
			redirect('home/index');
		}
	}
	function delete_job_details()
	{
		if($this->session->userdata('admin_login'))
		{
			$data=$this->job->delete_job_details();
			$jobs=$this->job->get_all_job();
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
						<td>'.$row['job_title'].'</td>
						<td>'.substr($row['job_description'],0,150).'....</td>
						<td>'.$row['general_age_limit'].'</td>
						<td>'.$row['sc_st_age_limit'].'</td>
						<td>'.$row['qualification'].'</td>					
						<td>'.$status.'</td>					
						<td>
								<ul class="icons-list">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<i class="icon-menu9"></i>
										</a>
										<ul class="dropdown-menu dropdown-menu-right">
												
											<li><a href="'.site_url('job_details/edit_job_details/'.$row['id']).'"><i class="fa fa-pencil"></i> Edit Details</a></li>
											<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_job_details(this.id)"><i class="fa fa-trash-o"></i> Delete</a></li>
										</ul>
									</li>
								</ul>
							</td>
						</tr>';
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
