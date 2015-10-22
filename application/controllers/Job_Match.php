<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Match extends MY_Controller {

	public function index()
	{
		if ($this->is_loggedin()) 
		{
			if ($this->is_jobseeker()) 
			{
				$this->load_job_match();
				return;
			}
			else
			{
				redirect();
			}
		}
		else
		{
			redirect("login/");
		}
	}
	
	/**
	 * Loads the Job Match view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_job_match() {
		
		$page = 'job_match_page';

		$this->check_page_files('/views/pages/' . $page . '.php');
		
		$this->load->model('job_match_model');

		$data['page_title'] = "Job Match";
		
		$email = $this->auth->get_info()->email;
		
		$data['job_list'] = $this->job_match_model->get($email);
		
		$this->load_view($data, $page);
	}
		
}
