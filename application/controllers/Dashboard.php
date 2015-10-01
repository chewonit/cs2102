<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		if (!$this->is_loggedin()) 
		{
			redirect("login/");
		}
	
		$page = 'dashboard_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Dashboard";

		$this->load_view($data, $page);
	}
}
