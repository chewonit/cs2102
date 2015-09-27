<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function view()
	{
		$page = 'register_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Register";

		$this->load_view($data, $page);
	}
	
	public function register_user()
	{
		
	}
	
}
