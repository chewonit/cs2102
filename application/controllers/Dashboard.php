<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	private $data = array(
		'page_title' => "Dashboard",
		'form_target' => null,
		'form_validation' => FALSE,
		'submitted' => FALSE
		);
		
	public function index()
	{
		if (!$this->is_loggedin()) 
		{
			redirect("login/");
		}
	
		$page = 'dashboard_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->data['user_info'] =$this->get_user_info();

		$this->load_view($this->data, $page);
	}
	
	public function update() {
		$this->form_validation->set_rules('inputContact', 'Contact', 'trim|required|is_natural');
		
		$update_user_data = array(
			'contact' => $this->input->post('inputContact')
		);
		
		// The update details form has been submitted.
		$this->data['submitted'] = TRUE;
		
		if ( $this->form_validation->run() ) 
		{
			// Form validation was successful.
			$this->data['form_validation'] = TRUE;
			
			if ( $this->auth->update($update_user_data) ) 
			{
				$this->data['form_target'] = "update";
				$this->index();
			}
			else 
			{
				// Error when trying to add user to the database.
				$this->data['form_target'] = "update_error";
				$this->index();
			}
		}
		else
		{
			// Form validation was not successful.
			$this->data['form_validation'] = FALSE;
			$this->index();
		}
	}
	
	public function change_password() {
		$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|min_length[8]|callback_password_check');
		$this->form_validation->set_rules('inputPassword2', 'PasswordConfirmation', 'trim|required|min_length[8]|callback_password_check|matches[inputPassword]');
		$this->form_validation->set_message('is_unique', 'The email has already been registered.');
		$this->form_validation->set_message('password_check', 'The password must contain Alphabets and Numbers.');
		$this->form_validation->set_message('matches', 'The passwords entered do not match.');
		
		$password = $this->input->post('inputPassword');
		
		// The update details form has been submitted.
		$this->data['submitted'] = TRUE;
		
		if ( $this->form_validation->run() ) 
		{
			// Form validation was successful.
			$this->data['form_validation'] = TRUE;
			
			if ( $this->auth->change_password($password) ) 
			{
				$this->data['form_target'] = "password";
				$this->index();
			}
			else 
			{
				// Error when trying to add user to the database.
				$this->data['form_target'] = "password_error";
				$this->index();
			}
		}
		else
		{
			// Form validation was not successful.
			$this->data['form_validation'] = FALSE;
			$this->data['form_target'] = "password";
			$this->index();
		}
	}
	
	private function get_user_info() {
		$user_info = $this->auth->get_info();
		return array (
			'email' => $user_info->email,
			'first_name' => ucwords($user_info->first_name),
			'last_name' => ucwords($user_info->last_name),
			'nationality' => ucwords($user_info->nationality),
			'gender' => ucwords($user_info->gender),
			'contact' => $user_info->contact,
		);
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
