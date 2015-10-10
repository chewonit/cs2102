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
			$this->load_company_admin($email, $result[0]);
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
	 * Loads the Company Join view for employers
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
	 * Accepts the employer to join the company.
	 *
	 * @access	public
	 * @return	
	 */
	public function company_accept_employer() {
		
		$employer = $this->input->post('employer');
		
		$data = array(
			'accepted' => 1
		);
		
		$output = array(
			'status' => false
		);
		
		if ( $this->company_employer_model->update($employer, $data) ) 
		{
			$output["status"] = true;
		}
		
		echo json_encode($output);
	}
	
	/**
	 * Accepts the employer to join the company.
	 *
	 * @access	public
	 * @return	
	 */
	public function company_reject_employer() {
		
		$employer = $this->input->post('employer');
		
		$data = array(
			'accepted' => 0
		);
		
		$output = array(
			'status' => false
		);
		
		if ( $this->company_employer_model->update($employer, $data) ) 
		{
			$output["status"] = true;
		}
		
		echo json_encode($output);
	}
		
	
	/**
	 * Loads the Jobseeker private profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_company_admin($email, $company) {
		
		$page = 'company_admin_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Company Admin";
		
		$company_reg_no = $company->company_reg_no;
		
		$employer_list = $this->company_employer_detailed_model->get_except($company_reg_no, false, $email)->result();
		$employer_list_accepted = $this->company_employer_detailed_model->get_except($company_reg_no, true, $email)->result();

		$data['employer_list'] = $employer_list;
		$data['employer_list_accepted'] = $employer_list_accepted;
		
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

		$data['company_list'] = $this->db->query("SELECT * FROM company");
		
		$data['user_info'] = $this->get_user_info();
		
		$this->input->post('inputCompany');
		
		$data_entry = array(
		'employer' => $this->input->post('inputEmail'),
		'company_reg_no' => $this->input->post('inputCompany'),
		'accepted' => 0
		);
		
		if ($this->input->post('inputCompany'))
		{
			// add employer to the company
			$this->company_employer_model->insert($data_entry);
			redirect('/company/profile');
		}
			
		$this->load_view($data, $page);
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
