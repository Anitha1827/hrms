<?php

class Users extends CI_Model
{
	function __construct()
	{
		parent::__construct();		
		$this->_table = 'users';
		$this->table2 = 'roles';		
	}

	function get_all_users($role_id = NULL, $is_active = '1')
	{
		$this->db->select($this->_table.'.*');	
		$this->db->select($this->table2.'.name');		
		$this->db->from($this->_table);
		$this->db->join($this->table2, $this->_table.'.role_id ='.$this->table2.'.id' );	
		if(isset($role_id))	
		{
			$this->db->where($this->_table.'.role_id', $role_id);			
		}
		$this->db->where('is_active', $is_active);
		$this->db->order_by('id' , 'desc');
		return $this->db->get();
	}

	function get_all_roles()
	{
		return $this->db->get($this->table2)->result();
	}
	
	function getUser($username, $password)
	{
		$this->db->where('email', $username);		
		$this->db->where('password', $password);
		return $this->db->get($this->_table);		
	}

	function getUserByEmail($email)
	{
		$this->db->where('email', $email);
		return $this->db->get($this->_table);
	}

	function getUserById($id)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->_table);
	}

	function update_user_by_email($data, $email )
	{		
		$data['last_updated_on'] = date('Y-m-d H:i:s', time());
		$this->db->where('email', $email);			
		return $this->db->update($this->_table, $data);
	}

	function update_user($data, $id= NULL, $email= NULL )
	{
		$data['last_updated_by'] = $this->session->userdata('user_id');
		$data['last_updated_on'] = date('Y-m-d H:i:s', time());
		if(isset($email))
		{
			$this->db->where('email', $email);	
		}
		if(isset($id))
		{
			$this->db->where('id', $id);	
		}		
		return $this->db->update($this->_table, $data);
	}

    function user_verification($user_email,$user_code)
    {
	    $this->db->select('email');
	    $this->db->where('email',$user_email);
	    $this->db->where('newpass_key',$user_code);
	    $query = $this->db->get($this->_table);

	    if($query->num_rows() > 0)
	    {        
	        return $query->row_array();
	    }
	    return false;
	}

	function is_email_exist($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get($this->_table);
		 if($query->row_array() > 0)
	    {        
	        return true;
	    }
	    return false;
	}

	function is_user_email_exist($email, $id)
	{
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);
		$query = $this->db->get($this->_table);
		
		if($query->row_array() > 0)
	    {        
	        return true;
	    }
	    return false;
	}

	function insert_user($data)
	{
		$data['created_on'] = date('Y-m-d H:i:s', time());
		$data['created_by'] = $this->session->userdata('user_id');
		$this->db->insert($this->_table, $data);
		if($this->db->affected_rows() == 1)
		{
			return $this->db->insert_id();
		}
		return false;
	}

	function add_user_log_attempt($data)
	{
		$this->db->insert('user_activity', $data);
		if($this->db->affected_rows() == 1)
		{
			return $this->db->insert_id();
		}
		return false;
	}

	function get_user_activity($start_date, $end_date)
	{
		//$end_date = date('Y-m-d', strtotime($end_date . ' +1 day'));
		$this->table3 = 'user_activity';
		$this->db->select($this->_table.'.fname');
		$this->db->select($this->_table.'.lname');
		$this->db->select($this->_table.'.is_otp_enable');
		$this->db->select($this->table3.'.*');
		$this->db->select($this->table2.'.name');
		$this->db->from($this->table3);
		$this->db->join($this->_table, $this->table3.'.user_id ='.$this->_table.'.id' );
		$this->db->join($this->table2, $this->_table.'.role_id ='.$this->table2.'.id' );
		$this->db->where($this->_table.'.is_active', '1');
		$this->db->where("DATE($this->table3.time) >=", $start_date);
		$this->db->where("DATE($this->table3.time) <=", $end_date);
		$this->db->order_by($this->table3.'.time' , 'desc');
		return $this->db->get();
	}

	function delete_user_by_id($id)
	{
		$this->db->where('id', $id);	
		return $this->db->delete($this->_table);
	}

	function get_email_ids_by_user_id($user_id)
	{
		$this->db->select('id');
		$this->db->select('email');		
		
		if(is_array($user_id) == TRUE)
		{
			$this->db->where_in('id', $user_id);
		}
		else
		{
			$this->db->where('id', $user_id);
		}
		$results = $this->db->get($this->_table);
		$customer_admins = array();
		foreach($results->result() as $result)
		{
			// $customer_admins[''.$result->id.''] = $result->email;
			$customer_admins[] = $result->email;
		}
		return $customer_admins;
	}

	
	function insert_entry($data)
	{
		$var =  $this->db->insert('users',$data);
		$query = $this->db->insert_id();
		return $query;
	}
	
	public function get_entries()
    {
        $query = $this->db->get('users');
        if (count( $query->result() ) > 0)
        {
        	return $query->result();
        }
         return $query->result();
        
    }

}

