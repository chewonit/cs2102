<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

	public function view()
	{
		$page = 'search_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Search";

		$data['search_query'] = $this->input->post('inputSearch');
		
		if($data['search_query'] == "") 
		{
			$this -> load_view($data, $page);
			return;
		}
		
		/*
		 * Call upon model to perform search on tables.
		 */
		$data['search_results'] = $this -> demo_model -> search($data['search_query']);
		
		$this -> load_view($data, $page);
		
	}

}