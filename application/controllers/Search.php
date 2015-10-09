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

		$data['search_query'] = $this->input->post('inputSearch');
		$data['search_cat'] = $this->input->post('variable');
		$data['search_exp'] = $this->input->post('variable1');
		
		
		if($data['search_query'] == "") 
		{
			$data['search_results'] = $this -> jobs_model -> get();
		}
		else 
		{
			/*
			 * Call upon model to perform search on tables.
			 */
			$data['search_results'] = 
				$this -> jobs_model -> search($data['search_query'],$data['search_cat'],$data['search_exp']);
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
		
		if($data['search_query'] == "") 
		{
			$data['search_results'] = $this -> jobs_model -> get();
			
		}
		else 
		{
		
			$data['search_results'] = $this -> jobs_model -> search($data['search_query']);
		}
		
		$this -> load_view($data, $page);
	}
}
?>