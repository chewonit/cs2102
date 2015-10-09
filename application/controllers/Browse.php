<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends MY_Controller {

	public function index($cat1 = null, $cat2 = null, $cat3 = null)
	{
		if ($this->is_employer()) {
			$this->load_browse_jobseekers();
			return;
		}
		
		$page = 'browse_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Browse";
		
		$data['job_list'] = $this -> jobs_model -> get();
		$data['company_list'] = $this -> company_model -> get();
		$data['category_list'] = $this -> job_category_model -> get();
		$data['location_list'] = $this->db->query('SELECT DISTINCT location FROM company');
		$data['skills_list'] = $this->db->query('SELECT DISTINCT skills FROM jobs');
		
		$this -> load_view($data, $page);
		
	}
	
	/**
	 * Loads the Browse Jobseeker page for Employer users.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_browse_jobseekers() {
		
		$page = 'browse_jobseekers_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Browse Jobseekers";
		
		$this -> load_view($data, $page);
		
	}

}