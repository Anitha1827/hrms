<?php

class Holiday extends CI_Model
{
	function __construct()
	{
		parent::__construct();		
		$this->_table = 'holiday';
				
	}

	function get_holiday()
	{
		return $this->db->get($this->_table);
	}

	function insert_event($data)
	{
		return $this->db->insert('holiday',$data);
	}

	function update_event($data, $id)
	{
		$this->db->where('id',$id);
		return $this->db->update('holiday',$data);
	}

	function delete_event($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('holiday');
	}

}