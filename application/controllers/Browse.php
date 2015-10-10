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
		
		$data['owner_list'] = $this->db->query("SELECT DISTINCT owner FROM resume_profile");
		$data['work_list'] = $this->db->query("SELECT DISTINCT work_history FROM resume_profile");
		$data['description_list'] = $this->db->query("SELECT DISTINCT description FROM resume_profile");
		$data['address_list'] = $this->db->query("SELECT DISTINCT address FROM resume_profile");
		$data['education_list'] = $this->db->query("SELECT DISTINCT edu_history FROM resume_profile");
		
		$data['search_query1'] = $this->input->post('inputSearch1');
		$data['search_query2'] = $this->input->post('inputSearch2');
		$data['search_query3'] = $this->input->post('inputSearch3');
		$data['search_query4'] = $this->input->post('inputSearch4');
		$data['search_query5'] = $this->input->post('inputSearch5');
		
		if($data['search_query1'] != ""){
			$data['search_results'] = $this -> resume_profile_model -> search($data['search_query1']);
		} else if($data['search_query2'] != ""){
			$data['search_results'] = $this -> resume_profile_model -> search($data['search_query2']);
		} else if($data['search_query3'] != ""){
			$data['search_results'] = $this -> resume_profile_model -> search($data['search_query3']);
		}else if($data['search_query4'] != ""){
			$data['search_results'] = $this -> resume_profile_model -> search($data['search_query4']);
		}else if($data['search_query5'] != ""){
			$data['search_results'] = $this -> resume_profile_model -> search($data['search_query5']);
		}else{
			$data['search_results'] = $this -> resume_profile_model -> get();
		}
		
		$this -> load_view($data, $page);
		
	}

}