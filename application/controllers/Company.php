<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends MY_Controller {

	public function index($id = null)
	{
		$this->enforce_log_in();
		$this->enforce_employer();
		
		/*
		 * Check if employer is a company admin.
		 * Otherwise redirect to profile page.
		 */
		$email = $this->auth->get_info()->email;
		$result = $this->company_model->get( NULL, $email )->result();
	
		if ( count($result) == 1 ) 
		{
			$this->load_company_admin();
			return;
		}
		else
		{
			redirect("profile/");
		}		
	}
	
	/**
	 * Loads the Company Create view for employers.
	 *
	 * @access	public
	 * @return	
	 */
	public function create() {
		
		$this->enforce_log_in();
		$this->enforce_employer();
		
		/*
		 * Check if employer has joined a company.
		 * Otherwise redirect to profile page.
		 */
		$accepted = 1;
		$email = $this->auth->get_info()->email;
		$result = $this->company_employer_model->get( $email, NULL, $accepted )->result();
	
		if ( count($result) == 0 ) 
		{
			$this->load_create_company();
			return;
		}
		else
		{
			redirect("profile/");
		}
	}
	
	/**
	 * LLoads the Company Join view for employers
	 *
	 * @access	public
	 * @return	
	 */
	public function join() {
		
		$this->enforce_log_in();
		$this->enforce_employer();
		
		/*
		 * Check if employer has joined a company.
		 * Otherwise redirect to profile page.
		 */
		$accepted = 1;
		$email = $this->auth->get_info()->email;
		$result = $this->company_employer_model->get( $email, NULL, $accepted )->result();
	
		if ( count($result) == 0 ) 
		{
			$this->load_join_company();
			return;
		}
		else
		{
			redirect("profile/");
		}
	}
	
	
	/**
	 * Loads the Jobseeker private profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_company_admin() {
		
		$page = 'company_admin_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Company Admin";

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the Jobseeker public profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_create_company() {
		
		$page = 'company_create_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Create Company";

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the Company public profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_join_company() {
		
		$page = 'company_join_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Join Company";

		$this->load_view($data, $page);
	}
	
	/**
	 * Checks if the user is logged in and redirects otherwise.
	 *
	 * @access	private
	 * @return	
	 */
	private function enforce_log_in() {
		
		if (!$this->is_loggedin()) 
		{
			redirect("login/");
		}
	}
	
	/**
	 * Checks if the user is an employer and redirects otherwise.
	 *
	 * @access	private
	 * @return	
	 */
	private function enforce_employer() {
		
		if (!$this->is_employer()) 
		{
			redirect("profile/");
		}
	}
}
