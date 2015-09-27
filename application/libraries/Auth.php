<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentication Library
 *
 * To handle the authentication and sessions of uses.
 */
class Auth {
	
	private $ci;
	private $user_table;
	private $identifier_field;
	private $username_field;
	private $password_field;
	
	function __construct()
	{
		// Assign CodeIgniter object to $this->ci
		$this->ci =& get_instance();
		
		// Set database table names and attributes
		$this->user_table = 'users';
		$this->identifier_field = 'id';
		$this->username_field = 'email';
		$this->password_field = 'password';
		
		$this->ci->load->database();
		$this->ci->load->library('session');
	}
	
	public function create_user($username, $password)
	{
		
	}
	
	/**
	 * Login and set Session data.
	 *
	 * @access	public
	 * @param	string [$username] The username of the user to authenticate
	 * @param	string [$password] The password to authenticate
	 * @return	boolean TRUE on match found in database. Otherwise FALSE.
	 */
	public function login($username, $password)
	{
		$this->ci->db
			->select($this->identifier_field.' as identifier, '.$this->username_field.' as username');
		$this->ci->db->where($this->username_field, $username);
		$this->ci->db->where($this->password_field, md5($password));
		$this->ci->db->limit(1);
		$user = $this->ci->db->get($this->user_table);
			
		// Check if username and password entry is found
		if ($user->num_rows() == 1)
		{
			$user_details = $user->row();
			
			// Set the userdata for the current user
			$this->ci->session->set_userdata(array(
				'identifier' => $user_details->identifier,
				'username' => $user_details->username,
				'logged_in' => $_SERVER['REQUEST_TIME']
			));
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * Check if a user is logged in
	 *
	 * @access	public
	 * @return	boolean TRUE if user is logged in. Otherwise FALSE
	 */
	public function is_loggedin()
	{
		return (bool) $this->ci->session->userdata('identifier');
	}
	
	/**
	 * Log a user out and clear Session data.
	 *
	 * @access	public
	 * @return	boolean TRUE
	 */
	public function logout()
	{
		// Remove userdata
		$this->ci->session->unset_userdata('identifier');
		$this->ci->session->unset_userdata('username');
		$this->ci->session->unset_userdata('logged_in');
		// Set logged out userdata
		$this->ci->session->set_userdata(array(
			'logged_out' => $_SERVER['REQUEST_TIME']
		));
		// Return true
		return TRUE;
	}
}
