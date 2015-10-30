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
				$this->load_company_public($result[0]);
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
					$this->load_company_private($result[0]);
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
	
		$email = $this->auth->get_info()->email;
		
		$data = array(
			'address'=> $this->input->post('inputProfileAddress'),
			'description' => $this->input->post('inputProfileAbout'),
			'edu_history' => $this->input->post('inputProfileEducation'),
			'work_history' => $this->input->post('inputProfileWork'),
			'skills' => $this->input->post('inputSkills'),
			'interest_area' => $this->input->post('inputInterest'),
			'location_pref' => $this->input->post('inputLocation'),
		);
		$this -> resume_profile_model -> update($email,$data); 
		$this -> index();	
	}
	
	public function updateCompanyProfile(){
	
		$company_reg_no = $this->input->post('hiddenRegNo');
		
		$data = array(
			'company_name'=> $this->input->post('hiddenCompanyName'),
			'address'=> $this->input->post('inputAddress'),
			'description' => $this->input->post('inputDescription'),
		);
		$this -> company_model -> update($company_reg_no, $data); 
		
		redirect('profile/');
	}
	
	private function load_jobseeker_private() {
		
		$page = 'profile_j_edit_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Profile";
		
		$email = $this->auth->get_info()->email;
		$data['resume_profile'] = $this -> resume_profile_model -> get_profile_with_user($email);
		
		$info = $this->auth->get_info();
		$data['email'] = $info->email;
		$data['first_name'] = $info->first_name;
		$data['last_name'] = $info->last_name;
		
		$this->load_view($data, $page);
	
	}
	
	/**
	 * Loads the Company private profile view.
	 *
	 * @access	private
	 * @return	
	 */
	private function load_company_private($company_employer) {
		
		$page = 'profile_c_edit_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Company Profile";
		
		$company_reg_no = $company_employer->company_reg_no;
		$data['company_profile'] = $this->company_model->get($company_reg_no)->result();
		$data['company_profile'] = $data['company_profile'][0];
		
		/*
		 * Check if is Company admin
		 */
		$data['is_company_admin'] = false;
		$email = $this->auth->get_info()->email;
		$result = $this->company_model->get( NULL, $email )->result();
		if ( count($result) == 1 ) 
		{
			$data['is_company_admin'] = true;
		}
		
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

		$data['page_title'] = "Jobseeker Profile of " . $user->email;
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
	private function load_company_public($company) {
		
		$page = 'profile_c_read_page';

		$this->check_page_files('/views/pages/' . $page . '.php');

		$data['page_title'] = "Company Profile of " . ucwords($company->company_name);
		$data['company_profile'] = $company;

		$this->load_view($data, $page);
	}
	

}
