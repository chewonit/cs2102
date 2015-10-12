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
		$email = $this->auth->get_info()->email;
		$result = $this->company_employer_model->get( $email )->result();
	
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
		
		$data['user_info'] = $this->get_user_info();
	
		$data1 = array(
		'company_reg_no' => $this->input->post('inputRegNo'), 
		'company_admin' => $this->input->post('inputEmail'), 
		'company_name' => $this->input->post('inputCompanyName'), 
		'location' => $this->input->post('inputLocation'),
		'description' => $this->input->post('inputDescription')
		);
		
		$data2 = array(
		'employer' => $this->input->post('inputEmail'),
		'company_reg_no' => $this->input->post('inputRegNo'),
		'accepted' => 1
		);
		
		// Check if company exists
		/*$this->init_form_validation();
		
		if ($this->form_validation->run()) 
		{
			$this->company_model->insert($data1);
			$this->company_employer_model->insert($data2);
		}*/
		
		$company_reg_no = $this->input->post('inputRegNo');
		$data['companyExist'] = $this->db->query("SELECT * FROM company c WHERE c.company_reg_no = '$company_reg_no'");

		if (empty($data['companyExist']))
		{
			$this->company_model->insert($data1);
			$this->company_employer_model->insert($data2);
		}
		
		$this->load_view($data, $page);
	}
	
	public function create_company() 
	{
		$this->form_validation->set_rules('inputRegNo', 'Company Registration Number', 'trim|required|is_unique[company.company_reg_no]');
		$this->form_validation->set_rules('inputCompanyName', 'Company Name', 'trim|required|is_unique[company.company_name]');
		$this->form_validation->set_rules('inputLocation', 'Location', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		
		$data_entry = array(
			'company_reg_no' => $this->input->post('inputRegNo'),
			'company_name' => $this->input->post('inputCompanyName'),
			'company_admin' => $this->input->post('inputEmail'),
			'location' => $this->input->post('inputLocation'),
			'description' => $this->input->post('inputDescription'),
		);
		
		if ( $this->form_validation->run() ) 
		{
			if ( $this->company_model->insert($data_entry) )
			{
				$data_entry = array(
					'company_reg_no' => $this->input->post('inputRegNo'),
					'employer' => $this->input->post('inputEmail'),
					'accepted' => 1
				);
				$this->company_employer_model->insert( $data_entry );
				redirect('/profile/');
			}
			else 
			{
				redirect('/profile/');
			}
		}
		else
		{
			redirect('/profile/');
		}
	}
	
	private function init_form_validation() {
		$this->form_validation->set_rules('inputRegNo', 'Registration Number', 'trim|required|is_unique[company.company_reg_no]');
		$this->form_validation->set_message('is_unique', 'The company has already been registered.');
	}
	
	public function check_unique_regNo()
	{
		if ( $this->auth->check_unique_regNo($this->input->post('inputRegNo')) ) {
			echo "true";
		}
		else
		{
			echo "false";
		}
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

		$data['company_list'] = $this->company_model->get();
		
		$email = $this->auth->get_info()->email;
		$data['user_email'] = $email;
		
		$data['company_applied_list'] = $this->company_model->get_applied_companies($email)->result();
		
		$this->load_view($data, $page);
	}
	
	public function join_company() 
	{
		$this->form_validation->set_rules('inputCompany', 'Description', 'trim|required');
		$this->form_validation->set_rules('inputEmail', 'Description', 'trim|required|is_unique[company_employer.employer]');
		
		$data_entry = array(
			'employer' => $this->input->post('inputEmail'),
			'company_reg_no' => $this->input->post('inputCompany'),
			'accepted' => 0
		);
		
		if ( $this->form_validation->run() ) 
		{
			if ( $this->company_employer_model->insert($data_entry) )
			{
				redirect('/profile/');
			}
			else 
			{
				redirect('/profile/');
			}
		}
		else
		{
			redirect('/profile/');
		}
	}
	
	public function cancel_join_company() 
	{
		$this->form_validation->set_rules('inputEmail', 'Description', 'trim|required');
		
		if ( $this->form_validation->run() ) 
		{
			if ( $this->company_employer_model->delete( $this->input->post('inputEmail') ) )
			{
				redirect('/profile/');
			}
			else 
			{
				redirect('/profile/');
			}
		}
		else
		{
			redirect('/profile/');
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
