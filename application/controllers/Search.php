<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

	public function index()
	{
		if ($this->is_employer()) {
			$this->load_search_jobseekers();
			return;
		}
		
		$email = null;
		if ($this->is_jobseeker()) {
			$email = $this->auth->get_info()->email;
		}
		
		$page = 'search_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Search";

		$search_string = $this->input->post('inputSearch');
		
		$data['search_query'] = $this->input->post('inputSearch');
		$data['search_cat'] = $this->input->post('inputCategory');
		$data['search_location'] = $this->input->post('inputLocation');
		$data['search_exp'] = $this->input->post('inputExp');
		
		$conditions = array();
		
		$category_id = $this->input->post('inputCategory');
		if ($category_id) {
			$conditions['j.category_id'] = $category_id;
		}
		
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
		
		$location = $this->input->post('inputLocation');
		if ($location != "") 
		{
			$conditions['j.location'] = $location;
		}
		
		if( $search_string == "") 
		{
			$data['search_results'] = $this -> search_model -> get($conditions, null, $email);
		}
		else 
		{
			/*
			 * Call upon model to perform search on tables.
			 */
			$data['search_results'] = $this -> search_model -> get( $conditions, $search_string, $email);
		}
		
		$this -> load_view($data, $page);
	}
	

	/**
	 * Loads the Search Jobseeker page for Employer users.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_search_jobseekers() {
		
		$page = 'search_jobseekers_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Search Jobseekers";
		
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
		
		$location = $this->input->post('inputLocation');
		$data['inputLocation'] = $location;
		if ($location != "") 
		{
			$conditions['p.location_pref'] = $location;
		}

		$data['search_query'] = $this->input->post('inputSearch');
		
		if($data['search_query'] == "" && count($conditions) <= 0 )
		{
			$data['search_results'] = $this -> search_model -> search_jobseekers();
		}
		else if($data['search_query'] == "" && count($conditions) > 0 )
		{
			$data['search_results'] = $this -> search_model 
				-> search_jobseekers( $conditions );
		}		
		else
		{
			$data['search_results'] = $this -> search_model 
				-> search_jobseekers( $conditions, $data['search_query'] );
		}
		
		$this -> load_view($data, $page);
	}
}
?>