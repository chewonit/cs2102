<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query_controller extends MY_Controller {

	public function view()
	{
		$page = 'query_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Query Controller Page";

		/* Demo get from database */
		$data['demo_list'] = $this -> demo_model -> get();

		$this -> load_view($data, $page);
	}

}
	
	
