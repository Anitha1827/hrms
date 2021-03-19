<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	function __construct()
	{
		parent::__construct();	
		$this->load->helper(['url', 'language']);		
		if(!$this->session->userdata('isLogin')){
           redirect('signin');
        }

        $this->load->model('holiday');
	}

	function index()
	{

		redirect('home');			
	}


	function home()
	{
		$data['holidays'] = $this->holiday->get_holiday();
		//print_r($data['holidays']);exit;
		$this->load->view('header');
		$this->load->view('dashboard', $data);
		$this->load->view('footer');
		
	}


	function load()
	 {
	  	$event_data = $this->holiday->get_holiday();
	  	foreach($event_data->result_array() as $row)
	  	{
		   $data[] = array(
		    'id' => $row['id'],
		    'title' => $row['title'],
		    'start' => $row['start_date'],
		    'end' => $row['end_date']
		   );
	  	}
	  	echo json_encode($data);
	 }


	 function insert()
	 {
	 	if($this->input->post('title'))
	 	{
	 		$data = array(
	 			'title' => $this->input->post('title'),
	 			'start_date' => $this->input->post('start'),
	 			'end_date' => $this->input->post('end')
	 		);
	 		$this->holiday->insert_event($data);
	 	}
	 }


	 function update()
	 {
	 	if ($this->input->post('id'))
	 	{
	 		$data = array(
	 			'title' => $this->input->post('title'),
	 			'start_date' => $this->input->post('start'),
	 			'end_date' => $this->input->post('end')
	 		);
	 		$this->holiday->update_event($data, $this->input->post('id'));
	 	}
	 }

	 function delete()
	 {
	 	if ($this->input->post('id'))
	 	{
	 		$this->holiday->delete_event($this->input->post('id'));
	 	}
	 }
}