<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('users');
	}

	public function index()
	{
		
		$this->load->view('header');
		$data['roles'] = $this->users->get_all_roles();
		
		$this->load->view('users/user', $data);
		$this->load->view('footer');

	}

	function insert()
	{	
		if($this->input->is_ajax_request()){
			$this->form_validation->set_rules('fname', 'Fname', 'required');
			$this->form_validation->set_rules('lname', 'Lname', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|min_length[7]');
			$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');
        	$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
			$this->form_validation->set_rules('role_id', 'Role_id', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
			

			if($this->form_validation->run() == FALSE)
			{
				$data = array('responce' => 'error', 'message' => validation_errors());
				echo json_encode($data);die;
			}
			else{				
				
				$user_data = array();
				$user_data['fname'] = $this->input->post('fname');
				$user_data['lname'] = $this->input->post('lname');
				$user_data['phone'] = $this->input->post('phone');
				$user_data['email'] = $this->input->post('email');
				$user_data['password'] = $this->input->post('password');
				$user_data['role_id'] = $this->input->post('role_id');
				$user_data['gender'] = $this->input->post('gender');

				if($this->users->insert_entry($user_data)) {
					$data = array('responce' => 'success', 'message' => 'Record added successfully');
				}
				else{
					$data = array('responce' => 'error', 'message' => 'Failed to add record');
				}
			}
			echo json_encode($data);
		}
		else{
			echo "No direct script access allowed";
		}
	}
	public function fetch()
	{
		$data = $this->Users->get_entries();
		$i = 1;
		foreach ($data as $row) {
			echo "<tr>";
			echo "<td>".$i."</td>";
			echo "<td>".$row->role."</td>";
			echo "<td>".$row->fname."</td>";
			echo "<td>".$row->lname."</td>";
			echo "<td>".$row->phone."</td>";
			echo "<td>".$row->mobile."</td>";
			echo "<td>".$row->email."</td>";
			echo "<td>".$row->gender

			."</td>";
		}
		// if($this->input->is_ajax_request()){
		// 	if($posts = $this->users->get_entries()){
		// 		$data = array('responce' => 'success','posts' => $posts);
		// 	} else{
		// 		$data = array('responce' => 'error', 'message' => 'Failed to fetch data');
		// 	}
		// 	echo json_encode($data);
		// }else{
		// 	echo "No direct script access allowed";
		// }
	}
	


}
