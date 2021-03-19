<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	function __construct() 
	{
        parent::__construct();  
        $this->load->database();  
        $this->load->model('users');    
    }

    public function index()
    {
    	$this->load->view('login');
    	
    }

    function user_login()
    { 
		$this->form_validation->set_rules('email', 'User Email', 'trim|xss_clean|required|min_length[7]');
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[6]');
	
		if($this->form_validation->run() == FALSE)
		{			
			$this->session->set_flashdata('error', validation_errors());
			$this->load->view('login');
			return;
		}	
		$username = $this->input->post('email');
		$password = $this->input->post('password');	
		$remember = $this->input->post('remember');
		$result = $this->users->getUserByEmail($username);
		if($result->num_rows() == 0 || $result == FALSE)
		{
			$this->session->set_flashdata('error', 'Invalid Email');
            $this->load->view('login');
			return;
		}

		$data = $result->row();
		$database_password = $data->password;
		$user_id = $data->id;	
		if(password_verify($password, $database_password))
		{
			$update_data['last_login'] = date('Y-m-d H:i:s', time());
			$this->users->update_user($update_data, $data->id);
			$user = array(
				'user_id' => $data->id,
				'isLogin' => TRUE,
				'email'  => $email_id,
				'fname'  => $data->fname,
				'gender'  => $data->gender,
				'role_id' => $data->role_id
			);
			$this->session->set_userdata($user);
			redirect('home');
		}
		else
		{
			$this->session->set_flashdata('error', 'Invalid Password');
            $this->load->view('login');
			return;
		}
	
    }
}