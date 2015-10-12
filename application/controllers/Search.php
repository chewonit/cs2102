<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

	public function index()
	{
		if ($this->is_employer()) {
			$this->load_search_jobseekers();
			return;
		}
		
		$page = 'search_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Search";

		$search_string = $this->input->post('inputSearch');
		
		$data['search_query'] = $this->input->post('inputSearch');
		$data['search_cat'] = $this->input->post('variable');
		$data['search_exp'] = $this->input->post('variable1');
		
		$conditions = array();
		
		$category_id = $this->input->post('variable');
		if ($category_id) {
			$conditions['category_id'] = $category_id;
		}
		
		$experience = $this->input->post('variable1');
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
		
		if( $search_string == "") 
		{
			$data['search_results'] = $this -> search_model -> get($conditions);
		}
		else 
		{
			/*
			 * Call upon model to perform search on tables.
			 */
			// $data['search_results'] = 
			//	$this -> jobs_model -> search($data['search_query'],$data['search_cat'],$data['search_exp']);
			
			
			
			$data['search_results'] = $this -> search_model -> get( $conditions, $search_string );
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

		$data['search_query'] = $this->input->post('inputSearch');
		
		if($data['search_query'] == ""){
			$data['search_results'] = $this -> resume_profile_model -> get();
		}else{
			$data['search_results'] = $this -> resume_profile_model -> search($data['search_query']);
		}
		
		$this -> load_view($data, $page);
	}
}
?>