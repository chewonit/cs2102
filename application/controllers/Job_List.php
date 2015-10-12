<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_List extends MY_Controller {

	public function index()
	{
		if ($this->is_loggedin()) 
		{
			if ($this->is_jobseeker()) {
		
				$this->load_jobseeker_job_list();
				return;
			}
			else if ($this->is_employer()) {
			
				/*
				 * Check if employer has joined a company.
				 * Otherwise redirect to join company page.
				 */
				$accepted = 1;
				$email = $this->auth->get_info()->email;
				$result = $this->company_employer_model->get( $email, NULL, $accepted )->result();
				
				if ( count($result) == 1 ) 
				{
					$this->load_company_job_list( $result[0] );
					return;
				}
				else
				{
					redirect("company/join");
				}
			}
			else
			{
				redirect("login/");
			}
		}
		else
		{
			redirect("login/");
		}
	}
	
	/**
	 * Loads the Jobseeker private profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_jobseeker_job_list() {
		
		$page = 'job_list_j_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Job List";

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the Company private profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_company_job_list($result) {
		
		$page = 'job_list_c_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Company Job List";
		
		$data['company_name'] = $this->company_model->get( $result->company_reg_no )->result()[0]->company_name;
		
		$data['job_list'] = $this->jobs_model->get_job_list( $result->company_reg_no )->result();
		
		$this->load_view($data, $page);
	}
	
}
