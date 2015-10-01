<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    
    private $table_name = "users";
    
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
}
