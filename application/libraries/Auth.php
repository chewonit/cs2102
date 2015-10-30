<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Authentication Library
 *
 * To handle the authentication and sessions of uses.
 */
class Auth {

	public $roles = array(
		"admin" => "admin",
		"jobseeker" => "jobseeker",
		"employer" => "employer"
	);
	
	private $ci;
	private $password_field;
	
	function __construct()
	{
		// Assign CodeIgniter object to $this->ci
		$this->ci =& get_instance();
		
		// Set database table names and attributes
		$this->password_field = 'password';
		
		$this->ci->load->database();
		$this->ci->load->library('session');
	}
	
	/**
	 * Creates new user.
	 *
	 * @access	public
	 * @param	array [$data] the data fields for the new user.
	 * @return	boolean TRUE if the new user was successfully added.
	 */
	public function create_user($data)
	{
		$create_user_data = array(
			'email' => $data['email'],
			'password' => md5($data['password']),
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'nationality' => $data['nationality'],
			'contact' => $data['contact'],
			'gender' => $data['gender'],
			'role' => $data['role'],
			'dob' => $data['dob']
		);
		
		return $this->ci->users_model->insert($create_user_data);
	}
	
	/**
	 * Check if the email is unique
	 *
	 * @access	public
	 * @param	string [$email] The email to check upon
	 * @return	boolean
	 */
	public function check_unique_email($email)
	{
		$query = $this->ci->users_model->get($email);
			
		if ($query->num_rows() == 0)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * Login and set Session data.
	 *
	 * @access	public
	 * @param	string [$email] The email of the user to authenticate
	 * @param	string [$password] The password to authenticate
	 * @return	boolean TRUE on match found in database. Otherwise FALSE.
	 */
	public function login($email, $password)
	{
		$user = $this->ci->users_model->get_by_email_password($email, $password);
			
		// Check if email and password entry is found
		if ($user->num_rows() == 1)
		{
			$user_details = $user->row();
			
			// Set the userdata for the current user
			$this->ci->session->set_userdata(array(
				'email' => $user_details->email,
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
		return (bool) $this->ci->session->userdata('email');
	}
	
	/**
	 * Check if a user is of a role
	 *
	 * @access	public
	 * @return	boolean TRUE if user is of the specified role. Otherwise FALSE
	 */
	public function is_role($role)
	{
		$email = $this->ci->session->userdata('email');
		$user = $this->ci->users_model->get_by_email_role($email, $role);
		
		// Check if email and role entry is found
		if ($user->num_rows() == 1)
		{
			return TRUE;
		}
		
		return FALSE;
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
		$this->ci->session->unset_userdata('email');
		$this->ci->session->unset_userdata('logged_in');
		// Set logged out userdata
		$this->ci->session->set_userdata(array(
			'logged_out' => $_SERVER['REQUEST_TIME']
		));
		// Return true
		return TRUE;
	}
	
	/**
	 * Get all authentication information on the user
	 *
	 * @access	public
	 * @return	
	 */
	public function get_info()
	{
		$email = $this->ci->session->userdata('email');
		$user_info = $this->ci->users_model->get( $email );
		
		$result = $user_info->result();
		return $result[0];
	}
	
	/**
	 * Updates the user information.
	 *
	 * @access	public
	 * @return	
	 */
	public function update($update_user_data)
	{
		$email = $this->ci->session->userdata('email');
		$result = $this->ci->users_model->update( $email, $update_user_data );
		
		return $result;
	}
	
	/**
	 * Change password
	 *
	 * @access	public
	 * @param	string [$password] The new password
	 * @param	string [$email] The email of the user
	 * @return	boolean 
	 */
	public function change_password($password, $email = null)
	{
		if ( is_null($email) )
		{
			// Ensure the current user is logged in
			if ($this->is_loggedin())
			{
				$email = $this->ci->session->userdata('email');
			} else {
				return FALSE;
			}
		}
		
		$data = array(
			$this->password_field => md5($password)
		);
		
		if ($this->ci->users_model->update($email, $data))
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
