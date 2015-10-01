<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function index()
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
			$this->session->set_flashdata('login_result', TRUE);
			redirect('dashboard');
		}
		
		$this->session->set_flashdata('login_result', FALSE);
		redirect('');
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
			redirect('');
		}
		redirect('');
	}
	
}
