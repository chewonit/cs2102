<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function view()
	{
		$page = 'login_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Login";

		$this->load_view($data, $page);
	}
	
	/**
	 * Log in the user and redirects to home page.
	 * Form parameters are grabbed via POST.
	 *
	 * @access	public
	 * @return	
	 */
	public function login_user(){
		if ( $this->auth->login($this->input->post('inputLoginEmail'), $this->input->post('inputLoginPassword')) ) 
		{
			redirect('?login=true');
		}
		redirect('?login=false');
	}
	
	/**
	 * Logs the user out and redirects to home page.
	 *
	 * @access	public
	 * @return	
	 */
	public function logout_user(){
		if ( $this->auth->logout() ) 
		{
			redirect('?logout=true');
		}
		redirect('?logout=false');
	}
	
}
