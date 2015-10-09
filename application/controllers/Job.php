<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller {

	public function index($id = null)
	{
		if (is_null($id)) 
		{
			redirect("profile/");
		}
		
		/*
		 * Check if id is vaoid Job ID.
		 */
		$job = $this->jobs_model->get( $id )->result();
		
		if ( count($job) != 1 ) 
		{
			$this->load_job_error();
			return;
		}
		
		if ($this->is_loggedin()) 
		{
			if ($this->is_employer()) {
			
				/*
				 * Check if employer is in current company of job posting.
				 */
				$accepted = 1;
				$company_reg_no = $job[0]->company_reg_no;
				$email = $this->auth->get_info()->email;
				$result = $this->company_employer_model->get( $email, $company_reg_no, $accepted )->result();
				
				if ( count($result) == 1 ) 
				{
					$this->load_job_edit($email, $job[0]);
					return;
				}
				else
				{
					$this->load_job_read();
					return;
				}
			}
			else
			{
				$this->load_job_read();
				return;
			}
		}
		else
		{
			$this->load_job_read();
			return;
		}
	}
	
	/**
	 * Loads the job error view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_job_error() {
		
		$page = 'job_error_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Job Not Found";

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the job edit view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_job_edit($email, $job) {
		
		$page = 'job_edit_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Job Edit";
		
		$data['job_applications'] = $this->job_application_model->get(NULL, $job->job_id)->result();

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the job read view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_job_read() {
		
		$page = 'job_read_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Job";

		$this->load_view($data, $page);
	}
	
}
