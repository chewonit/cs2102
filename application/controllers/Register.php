<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	private $data = array(
		'page_title' => "Registration",
		'create_success' => FALSE,
		'form_validation' => FALSE,
		'submitted' => FALSE,
		'form_data' => array(
				'first_name' => "",
				'last_name' => "",
				'email' => "",
				'password' =>"",
				'nationality' => "",
				'contact' => "",
				'gender' => ""
			)
		);
	private $page = 'register_page';

	public function index()
	{
		if ($this->is_loggedin()) 
		{
			redirect('dashboard/');
		}

		$this->check_page_files('/views/pages/' . $this->page . '.php');

		$this->load_view($this->data, $this->page);
	}
	
	public function register_user()
	{
		$this->init_form_validation();
		
		$inputDob = trim($this->input->post('inputDob'));
		$inputDob = $inputDob == '' ? date("Y-m-d") : date("Y-m-d", strtotime($inputDob));
		
		$create_user_data = array(
			'first_name' => strtolower($this->input->post('inputFirstName')),
			'last_name' => strtolower($this->input->post('inputLastName')),
			'email' => strtolower($this->input->post('inputEmail')),
			'password' => $this->input->post('inputPassword'),
			'nationality' => strtolower($this->input->post('inputNationality')),
			'contact' => $this->input->post('inputContact'),
			'gender' => strtolower($this->input->post('inputGender')),
			'role' => strtolower($this->input->post('inputAccount')),
			'dob' => $inputDob
		);
		
		// The sign up form has been submitted.
		$this->data['submitted'] = TRUE;
		
		if ( $this->form_validation->run() ) 
		{
			// Form validation was successful.
			$this->data['form_validation'] = TRUE;
			
			if ( $this->auth->create_user($create_user_data) ) 
			{
				$this->data['create_success'] = TRUE;
				$this->load_view($this->data, $this->page);
			}
			else 
			{
				// Error when trying to add user to the database.
				$this->data['form_data'] = $create_user_data;
				$this->load_view($this->$data, $this->page);
			}
		}
		else
		{
			// Form validation was not successful.
			$this->data['form_validation'] = FALSE;
			
			$this->data['form_data'] = $create_user_data;
			$this->load_view($this->data, $this->page);
		}
	}
	
	/*
	 * Sets the rules and error messages for the form validation.
	 *
	 * @access	private
	 * @return	
	 */
	private function init_form_validation() {
		$this->form_validation->set_rules('inputFirstName', 'First Name', 'trim|required');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('inputEmail', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|min_length[8]|callback_password_check');
		$this->form_validation->set_rules('inputNationality', 'Nationality', 'trim|required');
		$this->form_validation->set_rules('inputContact', 'Contact', 'trim|required|is_natural');
		$this->form_validation->set_rules('inputGender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('inputAccount', 'Account', 'trim|required');
		$this->form_validation->set_rules('inputDob', 'Date of Birth', 'trim|required');
		
		$this->form_validation->set_message('is_unique', 'The email has already been registered.');
		$this->form_validation->set_message('password_check', 'The password must contain Alphabets and Numbers.');
	}
	
	/*
	 * Checks if email is unique.
	 *
	 * @access	public
	 * @return	boolean TRUE if the email is unique.
	 */
	public function check_unique_email()
	{
		if ( $this->auth->check_unique_email($this->input->post('inputEmail')) ) {
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	
	/*
	 * Checks if string contains at least 1 alphabet and 1 number.
	 *
	 * @access	public
	 * @param	string [$str] The string to check upon.
	 * @return	boolean TRUE if the string contains at least 1 alphabet and 1 number.
	 */
	public function password_check($str)
	{
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
			return TRUE;
		}
		return FALSE;
	}
}
