<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function index($id = null)
	{
		if (!is_null($id)) 
		{
			/*
			 * Check if id is joobseeker ID or company.
			 */
			
			// if ( id is jobseeker )
			// {
			
			$this->load_jobseeker_public();
			return;
			
			// } 
			// else if ( id is company )
			// {
			
			//	$this->load_company_public();
			//	return;
			// }
			// 
			// else 
			// {
			// 		error page;
			// }
			
		}
		if ($this->is_loggedin()) 
		{
			if ($this->is_jobseeker()) {
		
				$this->load_jobseeker_private();
				return;
			}
			else if ($this->is_employer()) {
			
				/*
				 * Check if employer has joined a company.
				 * Otherwise redirect to join company page.
				 */
				$accepted = 1;
				$email = $this->auth->get_info()->email;
				$result = $this->company_employer_model->get( $email, NULL, $accepted )->result();
				
				if ( count($result) == 1 ) 
				{
					$this->load_company_private();
					return;
				}
				else
				{
					redirect("company/join");
				}
			}
			else
			{
				redirect("login/");
			}
		}
		else
		{
			redirect("login/");
		}
	}
	
	/**
	 * Loads the Jobseeker private profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_jobseeker_private() {
		
		$page = 'profile_j_edit_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Profile";

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the Company private profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_company_private() {
		
		$page = 'profile_c_edit_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Company Profile";

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the Jobseeker public profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_jobseeker_public() {
		
		$page = 'profile_j_read_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Profile";

		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the Company public profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_company_public() {
		
		$page = 'profile_c_read_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Company Profile";

		$this->load_view($data, $page);
	}
}
