<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registered_candidates extends CI_Controller 
{
		public function __construct()
        {
                parent::__construct();
					$this->load->helper('url');
					$this->load->model('back_end/Candidate_db','candidate');	
					$this->load->library("pagination");
        }
	public function index()
	{
		if($this->session->userdata('admin_login'))
		{
			$data['candidate']=$this->candidate->get_all_candidates();
			$this->load->view('admin/back_end/candidate/index',$data);
		}
		else
		{
			redirect('home/index');
		}
	}
	public function delete_candidates()
	{
		$data1=$this->candidate->delete_candidates();
		$data=$this->candidate->get_all_candidates();
		
		$i=1;					
		foreach($data as $row)
		{
			$id=$row['id'];
			echo '
					<tr>
					<td>'.$i.'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['phone'].'</td>
					<td>'.$row['normal_psd'].'</td>
					<td  style="width:15%">'.date("d-m-Y",strtotime($row['date'])).'</td>
					<td>
							<ul class="icons-list">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="icon-menu9"></i>
									</a>
									<ul class="dropdown-menu dropdown-menu-right">
										<li><a href="javascript:void(0);" id="'.$row['id'].'" onclick="delete_candidates(this.id)"><i class="fa fa-trash-o"></i> Delete</a></li>
									</ul>
								</li>
							</ul>
						</td>
					</tr>';
			$i++;
		}
	}
	function logout()
	{
		$this->session->unset_userdata('admin_login');
		redirect('home/index');
	}
}
