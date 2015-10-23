<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends MY_Controller {

	public function index($cat1 = null, $cat2 = null, $cat3 = null)
	{
		if ($this->is_employer()) {
			$this->load_browse_jobseekers();
			return;
		}
		
		$email = null;
		if ($this->is_jobseeker()) {
			$email = $this->auth->get_info()->email;
		}
		
		$page = 'browse_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Browse";
		
		$this->load->model('browse_model');
		
		$data['job_list'] = $this -> jobs_model -> get();
		$data['company_list'] = $this -> browse_model -> get_company_with_jobs();
		$data['category_list'] = $this -> job_category_model -> get();
		
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
			$conditions['j.location'] = $location;
		}
		
		$skills = $this->input->post('inputSkills');
		if ($skills == "") 
		{
			$skills = null;
		}
		
		$data['browse_query'] = $this -> browse_model -> browse($conditions, $skills, $email);
		
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
		
		$this->load->model('browse_model');
		
		$data['owner_list'] = $this->db->query("SELECT DISTINCT owner FROM resume_profile");
		
		$conditions = array();
		
		$gender = $this->input->post('inputGender');
		$data['inputGender'] = $gender;
		if ($gender != "") 
		{
			$conditions['u.gender'] = $gender;
		}
		
		$nationality = $this->input->post('inputNationality');
		$data['inputNationality'] = $nationality;
		if ($nationality != "") 
		{
			$conditions['u.nationality'] = $nationality;
		}
		
		$email = $this->input->post('inputEmail');
		$data['inputEmail'] = $email;
		if ($email != "") 
		{
			$conditions['p.owner'] = $email;
		}
		
		$location = $this->input->post('inputLocation');
		$data['inputLocation'] = $location;
		if ($location != "") 
		{
			$conditions['p.location_pref'] = $location;
		}
		
		if( count($conditions) > 0 )
		{
			$data['search_results'] = $this -> browse_model -> browse_jobseekers($conditions);
		}
		else
		{
			$data['search_results'] = $this -> browse_model -> browse_jobseekers();
		}
		
		$this -> load_view($data, $page);
		
	}

}