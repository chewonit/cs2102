<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    
    private $table_name = "users";
	private $column = array('email','password','first_name','last_name','nationality','contact','gender','role');
	
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 * Optional to filter by email column.
	 *
	 * @access	public
	 * @param	string [$email] The email row to select only
	 * @return	
	 */
    public function get($email = NULL)
    {
        if ( !is_null($email )) {
            $this -> db -> where('email', $email);
        }
        return $this -> db -> get($this->table_name);
    }
	
	/**
	 * Retrieves only the email column by email and password.
	 *
	 * @access	public
	 * @param	string [$email] The email row to select only
	 * @param	string [$password] The password row to select only
	 * @return	
	 */
    public function get_by_email_password($email, $password)
    {
		$this->db->select('email');
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		$this->db->limit(1);
		return $this->db->get($this->table_name);
    }

    /**
	 * Inserts a new row.
	 *
	 * @access	public
	 * @param	array [$data] The new row data
	 * @return	
	 */
    public function insert($data)
    {
        return $this -> db -> insert($this->table_name, $data);
    }

    /**
	 * Updates a row with specified email.
	 *
	 * @access	public
	 * @param	string [$email] The email to find
	 * @param	array [$data] The data to update row
	 * @return	
	 */
    public function update($email, $data)
    {
        $this -> db -> where('email', $email);
        return $this -> db -> update($this->table_name, $data);
    }

    /**
	 * Delete a row with specified email.
	 *
	 * @access	public
	 * @param	string [$email] The email to find
	 * @return	
	 */
    public function delete($email)
    {
        $this -> db -> where('email', $email);
        return $this -> db -> delete($this->table_name);
	}
	
	/**
	 * Retrieves only the email and role column by email and role.
	 *
	 * @access	public
	 * @param	string [$email] The email row to select only
	 * @param	string [$role] The role row to select only
	 * @return	
	 */
    public function get_by_email_role($email, $role)
    {
		$this->db->where('email', $email);
		$this->db->where('role', $role);
		$this->db->limit(1);
		return $this->db->get($this->table_name);
    }
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		
		if($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	
	private function _get_datatables_query()
	{
		
		$this->db->from($this->table_name);

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value']) {
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			}
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
	}
}
