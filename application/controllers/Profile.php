<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller {
	
	//private $data3 = array(
	//	'profile_updated' => FALSE,
	//);

	public function index($id = null)
	{
		if (!is_null($id)) 
		{
			$id = rawurldecode($id);
			
			/*
			 * Check if id is jobseeker ID.
			 */
			$role = 'jobseeker';
			$result = $this->users_model->get_by_email_role($id, $role)->result();
			
			if ( count( $result ) == 1 )
			{
				$this->load_jobseeker_public($result[0]);
				return;
			} 
			
			/*
			 * Check if id is company ID.
			 */
			$result = $this->company_model->get($id)->result();
			
			if ( count( $result ) == 1 ) 
			{
				$this->load_company_public();
				return;
			}
			
			/*
			 * Invalid Profile ID
			 */
			redirect("dashboard/");
		}
		
		if ($this->is_loggedin()) 
		{
			if ($this->is_jobseeker()) 
			{
				$this->load_jobseeker_private();
				return;
			}
			else if ($this->is_employer()) 
			{
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
		//$data['owner'] = $this -> resume_profile_model -> get('owner');
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
	
	public function updateCompanyProfile(){
		//$email = $this->auth->get_info()->email;
		$company_reg_no = $this->input->post('inputRegNo');
		
		$data2 = array(
		'company_reg_no'=> $this->input->post('inputRegNo'),
		'company_admin'=> $this->input->post('inputEmail'),
		'company_name'=> $this->input->post('inputCompanyName'),
		'location'=> $this->input->post('inputLocation'),
		'description' => $this->input->post('inputDescription'),
		);
		$this -> company_model -> update($company_reg_no,$data2); 
		
		// The company profile has been submitted.
		//$this->data3['profile_updated'] = TRUE;
		
		$this -> index();	
	}
	
	private function get_user_info() {
		$user_info = $this->auth->get_info();
		return array (
			'email' => $user_info->email,
			'first_name' => ucwords($user_info->first_name),
			'last_name' => ucwords($user_info->last_name),
			'nationality' => ucwords($user_info->nationality),
			'gender' => ucwords($user_info->gender),
			'contact' => $user_info->contact,
		);
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
		
		$email = $this->auth->get_info()->email;
		$data['user_info'] = $this->get_user_info();
		$data['company_reg_no'] = $this->db->query("SELECT c.company_reg_no FROM company_employer c WHERE c.employer = '$email'");
		$data['company_name'] = $this->db->query("SELECT c.company_name FROM company c, company_employer e WHERE e.employer = '$email' AND e.company_reg_no = c.company_reg_no");
		$data['location'] = $this->db->query("SELECT c.location FROM company c, company_employer e WHERE e.employer = '$email' AND e.company_reg_no = c.company_reg_no");
		$data['description'] = $this->db->query("SELECT c.description FROM company c, company_employer e WHERE e.employer = '$email' AND e.company_reg_no = c.company_reg_no");	
		
		$this->load_view($data, $page);
	}
	
	/**
	 * Loads the Jobseeker public profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_jobseeker_public($user) {
		
		$page = 'profile_j_read_page';

		$this->check_page_files('/views/pages/' . $page . '.php');
		
		$profile = $this->resume_profile_model->get( $user->email )->result();
		$profile = count($profile) == 1 ? $profile : NULL;

		$data['page_title'] = "Profile of " . $user->email;
		$data['user_data'] = $user;
		$data['user_profile'] = $profile[0];

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
