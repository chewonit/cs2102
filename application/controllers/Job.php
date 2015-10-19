<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job extends MY_Controller {

	private $update_data = array(
		'update_success' => FALSE,
		'form_validation' => FALSE,
		'submitted' => FALSE
		);

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
					$this->load_job_read($job[0]);
					return;
				}
			}
			else
			{
				$this->load_job_read($job[0]);
				return;
			}
		}
		else
		{
			$this->load_job_read($job[0]);
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
		
		$data['job_details'] = $job;
		
		$data['job_categories'] = $this->job_category_model->get()->result();
		
		$data['job_applications'] = $this->job_application_model->get(NULL, $job->job_id)->result();

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the job read view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_job_read($job) {
		
		$page = 'job_read_page';

		$this->check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Job";
		
		$this->load->model('jobs_model');
		$data['jobs_list'] = $this -> jobs_model -> read($job->job_id);
		
		$email = $this->auth->get_info()->email;
		$data['user_email'] = $email;
		
		$data['show_apply'] = false;
		if( $this->is_loggedin() && $this->is_jobseeker() ) 
		{
			$data['show_apply'] = true;
			
			$result = $this->job_application_model->get($email, $job->job_id)->result();
			if ( count($result) == 1 ) 
			{
				/*
				 * Jobseeker has already applied for this job
				 */
				$data['show_apply'] = false;
			}
		}

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the job create view.
	 *
	 * @access	public
	 * @return	
	 */
	public function create() {
		
		if ($this->is_loggedin()) 
		{
			if ($this->is_employer()) {
			
				/*
				 * Check if employer is in a company.
				 */
				$accepted = 1;
				$email = $this->auth->get_info()->email;
				$result = $this->company_employer_model->get( $email,NULL, $accepted )->result();
				
				if ( count($result) == 1 ) 
				{
					$page = 'job_create_page';

					$this->check_page_files('/views/pages/' . $page . '.php');

					$data['page_title'] = "Create Job";
					$data['job_details'] = $result[0];
					$data['job_categories'] = $this->job_category_model->get()->result();

					$this->load_view($data, $page);
					return;
				}
				else
				{
					redirect("profile");
					return;
				}
			}
			else
			{
				redirect("login");
				return;
			}
		}
		else
		{
			redirect("login");
			return;
		}
	}
	
	/**
	 * Creates a job entry
	 *
	 * @access	public
	 * @return	
	 */
	public function create_job() {
		
		$this->form_validation->set_rules('inputTitle', 'Title', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		$this->form_validation->set_rules('hiddenRegNo', 'Company Reg. No', 'trim|required');
		$this->form_validation->set_rules('inputPublished', 'Published', 'trim|required');
		$this->form_validation->set_rules('inputExperience', 'Experience', 'trim|required');
		$this->form_validation->set_rules('inputCategory', 'Category', 'trim|required');
		$this->form_validation->set_rules('inputLocation', 'Location', 'trim|required');
		
		$create_user_data = array(
			'company_reg_no' => $this->input->post('hiddenRegNo'),
			'title' => $this->input->post('inputTitle'),
			'description' => $this->input->post('inputDescription'),
			'published' => $this->input->post('inputPublished'),
			'experience' => $this->input->post('inputExperience'),
			'skills' => strtolower($this->input->post('inputSkills')),
			'category_id' => $this->input->post('inputCategory'),
			'location' => $this->input->post('inputLocation')
		);
		
		if ( $this->form_validation->run() ) 
		{
			if ( $this->jobs_model->insert( $create_user_data ) )
			{
				redirect("job_list/");
			}
			else 
			{
				$page = 'job_error_page';

				$this->check_page_files('/views/pages/' . $page . '.php');

				$data['page_title'] = "Could not create job entry";

				$this->load_view($data, $page);
			}
		}
		else
		{
			$page = 'job_error_page';

			$this->check_page_files('/views/pages/' . $page . '.php');

			$data['page_title'] = "Could not create job entry";

			$this->load_view($data, $page);
		}
	}
	
	/**
	 * Update job entry
	 *
	 * @access	public
	 * @return	
	 */
	public function update() {
		
		$this->form_validation->set_rules('inputTitle', 'Title', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		$this->form_validation->set_rules('hiddenJobId', 'Job ID', 'trim|required');
		$this->form_validation->set_rules('hiddenRegNo', 'Company Reg. No', 'trim|required');
		$this->form_validation->set_rules('inputPublished', 'Published', 'trim|required');
		$this->form_validation->set_rules('inputExperience', 'Experience', 'trim|required');
		$this->form_validation->set_rules('inputCategory', 'Category', 'trim|required');
		$this->form_validation->set_rules('inputLocation', 'Location', 'trim|required');
		
		$create_user_data = array(
			'title' => $this->input->post('inputTitle'),
			'description' => $this->input->post('inputDescription'),
			'published' => $this->input->post('inputPublished'),
			'experience' => $this->input->post('inputExperience'),
			'skills' => strtolower($this->input->post('inputSkills')),
			'category_id' => $this->input->post('inputCategory'),
			'location' => $this->input->post('inputLocation')
		);
		
		if ( $this->form_validation->run() ) 
		{
			if ( $this->jobs_model->update( $this->input->post('hiddenJobId'),
											$this->input->post('hiddenRegNo'),
											$create_user_data) ) 
			{
				redirect("job/" . $this->input->post('hiddenJobId') . '/');
			}
			else 
			{
				$page = 'job_error_page';

				$this->check_page_files('/views/pages/' . $page . '.php');

				$data['page_title'] = "Could not update job entry";

				$this->load_view($data, $page);
			}
		}
		else
		{
			$page = 'job_error_page';

			$this->check_page_files('/views/pages/' . $page . '.php');

			$data['page_title'] = "Could not update job entry";

			$this->load_view($data, $page);
		}
	}
	
	/**
	 * Delete job entry
	 *
	 * @access	public
	 * @return	
	 */
	public function delete() {
		
		if ( $this->jobs_model->delete( $this->input->post('hiddenJobId2'),
										$this->input->post('hiddenRegNo2') ) ) 
		{
			redirect("job_list/");
		}
		else 
		{
			$page = 'job_error_page';

			$this->check_page_files('/views/pages/' . $page . '.php');

			$data['page_title'] = "Could not delete job entry";

			$this->load_view($data, $page);
		}
		
	}
	
	/**
	 * Delete job application entry
	 *
	 * @access	public
	 * @return	
	 */
	public function delete_application() {
		
		if ( $this->job_application_model->delete( $this->input->post('hiddenApplicant2'),
										$this->input->post('hiddenJobId2') ) ) 
		{
			
		}
		redirect("job_list/");
	}
	
	/**
	 * Add job application entry
	 *
	 * @access	public
	 * @return	
	 */
	public function apply_job() {
		
		$create_application_data = array(
			'applicant' => $this->input->post('hiddenApplicant'),
			'job_id' => $this->input->post('hiddenJobId')
		);
		
		if ( $this->job_application_model->insert( $create_application_data) )
		{
			
		}
		redirect("job_list/");
	}
}
