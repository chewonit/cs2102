<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function index($id = null)
	{
		if (!is_null($id)) 
		{
			/*
			 * Check if id is jobseeker ID or company.
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
			// 		redirect("dashboard/");
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
	
	public function update(){
		//$data['owner'] = $this->db->query('SELECT owner FROM resume_profile');
	//	$data['owner'] = $this -> resume_profile_model -> get('owner');
		$email = $this->auth->get_info()->email;
		
		$data = array(
		'address'=> $this->input->post('inputProfileAddress'),
		'description' => $this->input->post('inputProfileAbout'),
		'edu_history' => $this->input->post('inputProfileEducation'),
		'work_history' => $this->input->post('inputProfileWork')
	);
	$this -> resume_profile_model -> update($email,$data); 
	$this -> index();
		
	}
	
	private function load_jobseeker_private() {
		
		$page = 'profile_j_edit_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Profile";
		
		$email = $this->auth->get_info()->email;
		$data['resume_profile'] = $this -> resume_profile_model -> get();
		$data['resume_profile2'] = $this -> users_model -> get();
		$data['first_name'] = $this->db->query("SELECT u.first_name FROM users u,resume_profile p WHERE u.email = p.owner AND p.owner = '$email'");
		$data['last_name'] = $this->db->query("SELECT u.last_name FROM users u,resume_profile p WHERE u.email = p.owner AND p.owner = '$email'");
		//$this->update();
		
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
