<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends MY_Controller {

	public function index($cat1 = null, $cat2 = null, $cat3 = null)
	{
		$page = 'browse_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Browse";
		
		$this -> load_view($data, $page);
		
	}

}