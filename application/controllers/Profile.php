<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function index($id = null)
	{
		if (!is_null($id)) 
		{
			/*
			 * Load profile of Jobseeker with ID.
			 */
			
			$page = 'profile_j_read_page';

			$this->check_page_files('/views/pages/' . $page . '.php');

			$data['page_title'] = "Profile";

			$this->load_view($data, $page);
			
			return;
		}
		if ($this->is_loggedin()) 
		{
			$page = 'profile_j_edit_page';

			$this->check_page_files('/views/pages/' . $page . '.php');

			$data['page_title'] = "Profile";

			$this->load_view($data, $page);
			
			return;
		}
		else
		{
			redirect("login/");
		}
	}
}
