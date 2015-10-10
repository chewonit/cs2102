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
		$this->load->model('browse_model');
		
		$data['browse_cat'] = $this->input->post('variable');
		$data['browse_exp'] = $this->input->post('variable1');
		$data['browse_name'] = $this->input->post('variable2');
		$data['browse_loc'] = $this->input->post('variable3');
		$data['browse_skill'] = $this->input->post('variable4');
		
		$data['browse_query'] = 
				$this -> browse_model -> browse($data['browse_cat'],$data['browse_exp'],$data['browse_name'],$data['browse_loc'],$data['browse_skill']);
		
		$this -> load_view($data, $page);
		
	}
	
	public function insert()
	{
		$data = array(
		'applicant' => $this->input->post('email'),
		'job_id' => $this->input->post('job_id'),
		);
		
		$this -> job_application_model -> insert($data);
		redirect('/browse/insert');
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