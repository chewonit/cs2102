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
		
		$this->load->model('browse_model');
		
		$data['job_list'] = $this -> jobs_model -> get();
		$data['company_list'] = $this -> company_model -> get_distinct(null, "company_name");
		$data['category_list'] = $this -> job_category_model -> get();
		$data['location_list'] = $this -> company_model -> get_distinct('location', 'location');
		
		$skills = array();
		foreach ( $this -> jobs_model -> get_skills()->result() as $skill )
		{
			$_skills = explode(',', $skill->skills);
			foreach ( $_skills as $x ) 
			{
				
				$x = trim($x);
				if ($x != '') $skills[$x] = $x;
			}
		}
		ksort($skills);
		$data['skills_list'] = $skills;
		
		$data['browse_cat'] = $this->input->post('inputCategory');
		$data['browse_exp'] = $this->input->post('inputExp');
		$data['browse_name'] = $this->input->post('inputCompany');
		$data['browse_loc'] = $this->input->post('inputLocation');
		$data['browse_skill'] = $this->input->post('inputSkills');
		
		$conditions = array();
		
		$experience = $this->input->post('inputExp');
		if ($experience) 
		{
			switch($experience) 
			{
				case 1:
					$conditions['experience <'] = 1;
					break;
				case 2:
					$conditions['experience >='] = 1;
					$conditions['experience <'] = 4;
					break;
				case 3:
					$conditions['experience >='] = 4;
					$conditions['experience <'] = 7;
					break;
				case 4:
					$conditions['experience >='] = 7;
					$conditions['experience <'] = 10;
					break;
				case 5:
					$conditions['experience >'] = 10;
					break;
			}
		}
		
		$category_id = $this->input->post('inputCategory');
		if ($category_id != "") 
		{
			$conditions['j.category_id'] = $category_id;
		}
		
		$company = $this->input->post('inputCompany');
		if ($company != "") 
		{
			$conditions['c.company_reg_no'] = $company;
		}
		
		$location = $this->input->post('inputLocation');
		if ($location != "") 
		{
			$conditions['c.location'] = $location;
		}
		
		$skills = $this->input->post('inputSkills');
		if ($skills == "") 
		{
			$skills = null;
		}
		
		$data['browse_query'] = $this -> browse_model -> browse($conditions, $skills);
		
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