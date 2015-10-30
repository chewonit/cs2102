<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	private $page_title = "Admin";

	public function index()
	{
		$this->users();
	}
	
	/*
	 * Users functions
	 */
	 
	public function users() {
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_users_page';
		
		$data['page_title'] = $this->page_title;

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function users_list()
	{
		$list = $this->users_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) {
			$no++;
			$row = array();
			$row[] = $user->email;
			//$row[] = $user->password;
			$row[] = $user->first_name;
			$row[] = $user->last_name;
			$row[] = $user->nationality;
			$row[] = $user->dob;
			$row[] = $user->contact;
			$row[] = $user->gender;
			$row[] = $user->role;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$user->email."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$user->email."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->users_model->count_all(),
						"recordsFiltered" => $this->users_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function users_edit()
	{
		$data = $this->users_model->get( strtolower($this->input->post('email')) );
		echo json_encode($data->row());
	}
	
	public function users_add()
	{
		$response_array = array();
		$this->form_validation_users_add();
		
		$inputDob = trim($this->input->post('inputDob'));
		$inputDob = $inputDob == '' ? date("Y-m-d") : date("Y-m-d", strtotime($inputDob));
		
		$create_user_data = array(
			'first_name' => strtolower($this->input->post('inputFirstName')),
			'last_name' => strtolower($this->input->post('inputLastName')),
			'email' => strtolower($this->input->post('inputEmail')),
			'password' => $this->input->post('inputPassword'),
			'nationality' => strtolower($this->input->post('inputNationality')),
			'contact' => $this->input->post('inputContact'),
			'gender' => strtolower($this->input->post('inputGender')),
			'role' => strtolower($this->input->post('inputAccount')),
			'dob' => $inputDob
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->auth->create_user($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function users_update()
	{
		$response_array = array();
		$this->form_validation_users_update();
		
		$inputDob = trim($this->input->post('inputDob'));
		$inputDob = $inputDob == '' ? date("Y-m-d") : date("Y-m-d", strtotime($inputDob));
		
		$create_user_data = array(
			'first_name' => strtolower($this->input->post('inputFirstName')),
			'last_name' => strtolower($this->input->post('inputLastName')),
			'nationality' => strtolower($this->input->post('inputNationality')),
			'contact' => $this->input->post('inputContact'),
			'gender' => strtolower($this->input->post('inputGender')),
			'role' => strtolower($this->input->post('inputAccount')),
			'dob' => $inputDob
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->users_model->update( strtolower($this->input->post('inputEmail')), $create_user_data ) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}
	
	public function users_delete()
	{
		$this->users_model->delete( strtolower($this->input->post('email')) );
		echo json_encode(array("status" => TRUE));
	}
	
	private function form_validation_users_add() {
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputFirstName', 'First Name', 'trim|required');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('inputEmail', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('inputPassword', 'Password', 'trim|required|min_length[8]|callback_password_check');
		$this->form_validation->set_rules('inputNationality', 'Nationality', 'trim|required');
		$this->form_validation->set_rules('inputContact', 'Contact', 'trim|required|is_natural');
		$this->form_validation->set_rules('inputGender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('inputAccount', 'Account', 'trim|required');
		$this->form_validation->set_rules('inputDob', 'Date of Birth', 'trim|required');
		
		$this->form_validation->set_message('is_unique', 'The email has already been registered.');
		$this->form_validation->set_message('password_check', 'The password must contain Alphabets and Numbers.');
	}
	
	private function form_validation_users_update() {
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputFirstName', 'First Name', 'trim|required');
		$this->form_validation->set_rules('inputLastName', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('inputNationality', 'Nationality', 'trim|required');
		$this->form_validation->set_rules('inputContact', 'Contact', 'trim|required|is_natural');
		$this->form_validation->set_rules('inputGender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('inputAccount', 'Account', 'trim|required');
		$this->form_validation->set_rules('inputDob', 'Date of Birth', 'trim|required');
	}
	
	
	/*
	 * Roles functions
	 */
	
	public function roles()
	{
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_roles_page';
		
		$data['page_title'] = $this->page_title;

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function roles_list()
	{
		$list = $this->roles_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $role) {
			$no++;
			$row = array();
			$row[] = $role->role;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$role->role."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$role->role."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->roles_model->count_all(),
						"recordsFiltered" => $this->roles_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function roles_edit()
	{
		$data = $this->roles_model->get( strtolower($this->input->post('role')) );
		echo json_encode($data->row());
	}
	
	public function roles_add()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputRole', 'Role', 'trim|required|is_unique[roles.role]');
		$this->form_validation->set_message('is_unique', 'The role already exists.');
		
		$create_user_data = array(
			'role' => strtolower($this->input->post('inputRole'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->roles_model->insert($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function roles_update()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputRole', 'Role', 'trim|required|is_unique[roles.role]');
		$this->form_validation->set_message('is_unique', 'The role already exists.');
		
		$create_user_data = array(
			'role' => strtolower($this->input->post('inputRole'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->roles_model->update( strtolower($this->input->post('originalRole')), $create_user_data ) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}
	
	public function roles_delete()
	{
		$this->roles_model->delete( strtolower($this->input->post('role')) );
		echo json_encode(array("status" => TRUE));
	}
	
	
	/*
	 * Resume Profile functions
	 */
	
	public function resumes()
	{
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_resumes_page';
		
		$data['page_title'] = $this->page_title;

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function resumes_list()
	{
		$list = $this->resume_profile_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $item->owner;
			$row[] = $item->address;
			$row[] = $item->description;
			$row[] = $item->work_history;
			$row[] = $item->edu_history;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$item->owner."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$item->owner."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->resume_profile_model->count_all(),
						"recordsFiltered" => $this->resume_profile_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function resumes_edit()
	{
		$data = $this->resume_profile_model->get( strtolower($this->input->post('owner')) );
		echo json_encode($data->row());
	}
	
	public function resumes_add()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputOwner', 'Owner', 'trim|required');
		$this->form_validation->set_rules('inputAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		
		$create_user_data = array(
			'owner' => strtolower($this->input->post('inputOwner')),
			'address' => strtolower($this->input->post('inputAddress')),
			'description' => strtolower($this->input->post('inputDescription')),
			'work_history' => strtolower($this->input->post('inputWorkHistory')),
			'edu_history' => strtolower($this->input->post('inputEduHistory'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->resume_profile_model->insert($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function resumes_update()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		
		$create_user_data = array(
			'address' => strtolower($this->input->post('inputAddress')),
			'description' => strtolower($this->input->post('inputDescription')),
			'work_history' => strtolower($this->input->post('inputWorkHistory')),
			'edu_history' => strtolower($this->input->post('inputEduHistory'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->resume_profile_model->update( strtolower($this->input->post('originalOwner')), $create_user_data ) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}
	
	public function resumes_delete()
	{
		$this->resume_profile_model->delete( strtolower($this->input->post('owner')) );
		echo json_encode(array("status" => TRUE));
	}
	
	
	/*
	 * Company functions
	 */
	
	public function company()
	{
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_company_page';
		
		$data['page_title'] = $this->page_title;

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function company_list()
	{
		$list = $this->company_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $item->company_reg_no;
			$row[] = $item->company_admin;
			$row[] = $item->company_name;
			$row[] = $item->address;
			$row[] = $item->description;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$item->company_reg_no."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$item->company_reg_no."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->company_model->count_all(),
						"recordsFiltered" => $this->company_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function company_edit()
	{
		$data = $this->company_model->get( strtolower($this->input->post('reg_no')) );
		echo json_encode($data->row());
	}
	
	public function company_add()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputRegNo', 'Company Reg No', 'trim|required');
		$this->form_validation->set_rules('inputAdmin', 'Company Admin', 'trim|required');
		$this->form_validation->set_rules('inputName', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('inputAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		
		$create_user_data = array(
			'company_reg_no' => strtolower($this->input->post('inputRegNo')),
			'company_admin' => strtolower($this->input->post('inputAdmin')),
			'company_name' => strtolower($this->input->post('inputName')),
			'address' => strtolower($this->input->post('inputAddress')),
			'description' => strtolower($this->input->post('inputDescription'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->company_model->insert($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function company_update()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputAdmin', 'Company Admin', 'trim|required');
		$this->form_validation->set_rules('inputName', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('inputAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		
		$create_user_data = array(
			'company_admin' => strtolower($this->input->post('inputAdmin')),
			'company_name' => strtolower($this->input->post('inputName')),
			'address' => strtolower($this->input->post('inputAddress')),
			'description' => strtolower($this->input->post('inputDescription'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->company_model->update( strtolower($this->input->post('originalRegNo')), $create_user_data ) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}
	
	public function company_delete()
	{
		$this->company_model->delete( strtolower($this->input->post('reg_no')) );
		echo json_encode(array("status" => TRUE));
	}
	
	
	
	/*
	 * Company Employer functions
	 */
	
	public function company_employer()
	{
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_company_employer_page';
		
		$data['page_title'] = $this->page_title;

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function company_employer_list()
	{
		$list = $this->company_employer_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $item->employer;
			$row[] = $item->company_reg_no;
			$row[] = $item->accepted;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$item->employer."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$item->employer."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->company_employer_model->count_all(),
						"recordsFiltered" => $this->company_employer_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function company_employer_edit()
	{
		$data = $this->company_employer_model->get( strtolower($this->input->post('employer')) );
		echo json_encode($data->row());
	}
	
	public function company_employer_add()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputEmployer', 'Employer', 'trim|required');
		$this->form_validation->set_rules('inputRegNo', 'Company Reg No', 'trim|required');
		$this->form_validation->set_rules('inputAccepted', 'Accepted', 'trim|required');
		
		$create_user_data = array(
			'employer' => strtolower($this->input->post('inputEmployer')),
			'company_reg_no' => strtolower($this->input->post('inputRegNo')),
			'accepted' => strtolower($this->input->post('inputAccepted'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->company_employer_model->insert($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function company_employer_update()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputRegNo', 'Company Reg No', 'trim|required');
		$this->form_validation->set_rules('inputAccepted', 'Accepted', 'trim|required');
		
		$create_user_data = array(
			'company_reg_no' => strtolower($this->input->post('inputRegNo')),
			'accepted' => strtolower($this->input->post('inputAccepted'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->company_employer_model->update( strtolower($this->input->post('originalEmployer')), $create_user_data ) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}
	
	public function company_employer_delete()
	{
		$this->company_employer_model->delete( strtolower($this->input->post('employer')) );
		echo json_encode(array("status" => TRUE));
	}
	
	
	
	/*
	 * Job Category functions
	 */
	
	public function job_category()
	{
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_job_category_page';
		
		$data['page_title'] = $this->page_title;
		$data['job_categories'] = $this->job_category_model->get()->result();
		
		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function job_category_list()
	{
		$list = $this->job_category_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $item->category_id;
			$row[] = $item->name;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$item->category_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$item->category_id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->job_category_model->count_all(),
						"recordsFiltered" => $this->job_category_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function job_category_edit()
	{
		$data = $this->job_category_model->get( strtolower($this->input->post('category_id')) );
		echo json_encode($data->row());
	}
	
	public function job_category_add()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputName', 'Name', 'trim|required');
				
		$create_user_data = array(
			'name' => strtolower($this->input->post('inputName'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->job_category_model->insert($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function job_category_update()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputName', 'Name', 'trim|required');
		
		$inputParent = $this->input->post('inputParent');
		$inputParent = $inputParent == '' ? NULL : $inputParent;
		
		$create_user_data = array(
			'name' => strtolower($this->input->post('inputName')),
			'parent' => $inputParent
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->job_category_model->update( strtolower($this->input->post('originalCategoryId')), $create_user_data ) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}
	
	public function job_category_delete()
	{
		$this->job_category_model->delete( strtolower($this->input->post('category_id')) );
		echo json_encode(array("status" => TRUE));
	}
	
	
	
	/*
	 * Jobs functions
	 */
	
	public function jobs()
	{
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_jobs_page';
		
		$data['page_title'] = $this->page_title;
		$data['job_categories'] = $this->job_category_model->get()->result();

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function jobs_list()
	{
		$list = $this->jobs_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $item->job_id;
			$row[] = $item->company_reg_no;
			$row[] = $item->date_created;
			$row[] = $item->published;
			$row[] = $item->category_id;
			$row[] = $item->title;
			$row[] = $item->description;
			$row[] = $item->experience;
			$row[] = $item->skills;
			$row[] = $item->location;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$item->job_id."'".", '".$item->company_reg_no."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$item->job_id."'".", '".$item->company_reg_no."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->jobs_model->count_all(),
						"recordsFiltered" => $this->jobs_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function jobs_edit()
	{
		$data = $this->jobs_model->get( 
			strtolower($this->input->post('job_id')), 
			strtolower($this->input->post('reg_no')) );
		echo json_encode($data->row());
	}
	
	public function jobs_add()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputRegNo', 'Company Reg No.', 'trim|required');
		$this->form_validation->set_rules('inputPublished', 'Published', 'trim|required');
		$this->form_validation->set_rules('inputCategoryId', 'Category', 'trim|required');
		$this->form_validation->set_rules('inputTitle', 'Title', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		$this->form_validation->set_rules('inputExperience', 'Experience', 'trim|required');
		$this->form_validation->set_rules('inputLocation', 'Location', 'trim|required');
		
		$inputSkills = $this->input->post('inputSkills');
		$inputSkills = $inputSkills == '' ? NULL : $inputSkills;
		
		$create_user_data = array(
			'company_reg_no' => strtolower($this->input->post('inputRegNo')),
			'published' => strtolower($this->input->post('inputPublished')),
			'category_id' => strtolower($this->input->post('inputCategoryId')),
			'title' => strtolower($this->input->post('inputTitle')),
			'description' => strtolower($this->input->post('inputDescription')),
			'experience' => strtolower($this->input->post('inputExperience')),
			'skills' => $inputSkills,
			'location' => strtolower($this->input->post('inputLocation'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->jobs_model->insert($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function jobs_update()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputPublished', 'Published', 'trim|required');
		$this->form_validation->set_rules('inputCategoryId', 'Category', 'trim|required');
		$this->form_validation->set_rules('inputTitle', 'Title', 'trim|required');
		$this->form_validation->set_rules('inputDescription', 'Description', 'trim|required');
		$this->form_validation->set_rules('inputExperience', 'Experience', 'trim|required');
		$this->form_validation->set_rules('inputLocation', 'Location', 'trim|required');
		
		$inputSkills = $this->input->post('inputSkills');
		$inputSkills = $inputSkills == '' ? NULL : $inputSkills;
		
		$create_user_data = array(
			'published' => strtolower($this->input->post('inputPublished')),
			'category_id' => strtolower($this->input->post('inputCategoryId')),
			'title' => strtolower($this->input->post('inputTitle')),
			'description' => strtolower($this->input->post('inputDescription')),
			'experience' => strtolower($this->input->post('inputExperience')),
			'skills' => $inputSkills,
			'location' => strtolower($this->input->post('inputLocation'))
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->jobs_model->update( 
				strtolower($this->input->post('originalJobId')), 
				strtolower($this->input->post('originalRegNo')), $create_user_data ) )
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}
	
	public function jobs_delete()
	{
		$this->jobs_model->delete( 
			strtolower($this->input->post('job_id')), 
			strtolower($this->input->post('reg_no')) );
		echo json_encode(array("status" => TRUE));
	}
	
	
	
	/*
	 * Job Application functions
	 */
	
	public function job_application()
	{
		if (!$this->is_loggedin() && !$this->is_admin()) 
		{
			redirect('dashboard/');
		}
		
		$page = 'admin/admin_job_application_page';
		
		$data['page_title'] = $this->page_title;
		$data['job_categories'] = $this->job_category_model->get()->result();

		$this->check_page_files('/views/pages/' . $page . '.php');

		$this->load_view($data, $page);
	}
	
	public function job_application_list()
	{
		$list = $this->job_application_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $item) {
			$no++;
			$row = array();
			$row[] = $item->applicant;
			$row[] = $item->job_id;
			$row[] = $item->date_submitted;

			//add action buttons to each row
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void()" title="Edit" onclick="edit_entry('."'".$item->applicant."'".", '".$item->job_id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
				  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Delete" onclick="delete_entry('."'".$item->applicant."'".", '".$item->job_id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->job_application_model->count_all(),
						"recordsFiltered" => $this->job_application_model->count_filtered(),
						"data" => $data,
				);
		
		echo json_encode($output);
	}
	
	public function job_application_edit()
	{
		$data = $this->job_application_model->get( 
			strtolower($this->input->post('applicant')), 
			strtolower($this->input->post('job_id')) );
		echo json_encode($data->row());
	}
	
	public function job_application_add()
	{
		$response_array = array();
		
		$this->form_validation->reset_validation();
		$this->form_validation->set_rules('inputApplicant', 'Applicant', 'trim|required');
		$this->form_validation->set_rules('inputJobId', 'Job ID', 'trim|required');
		
		$inputDateSubmitted = $this->input->post('inputDateSubmitted');
		$inputDateSubmitted = $inputDateSubmitted == '' ? date("Y-m-d H:i:s") : date("Y-m-d H:i:s", strtotime($inputDateSubmitted));
		
		$create_user_data = array(
			'applicant' => strtolower($this->input->post('inputApplicant')),
			'job_Id' => strtolower($this->input->post('inputJobId')),
			'date_submitted' => $inputDateSubmitted
		);
		
		if ( $this->form_validation->run() ) 
		{
			$response_array['form_validation'] = TRUE;
			if ( $this->job_application_model->insert($create_user_data) ) 
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		echo json_encode($response_array);
	}

	public function job_application_update()
	{
		$response_array = array();
		
		// $this->form_validation->reset_validation();
		
		$inputDateSubmitted = $this->input->post('inputDateSubmitted');
		$inputDateSubmitted = $inputDateSubmitted == '' ? NULL : date("Y-m-d H:i:s", strtotime($inputDateSubmitted));
		
		$create_user_data = array(
			'date_submitted' => $inputDateSubmitted
		);
		
		// if ( $this->form_validation->run() ) 
		// {
			$response_array['form_validation'] = TRUE;
			if ( $this->job_application_model->update( 
				strtolower($this->input->post('originalApplicant')), 
				strtolower($this->input->post('originalJobId')), $create_user_data ) )
			{
				$response_array['status'] = TRUE;
			}
			else 
			{
				$response_array['status'] = FALSE;
			}
		/*
		}
		else
		{
			$response_array['form_validation'] = FALSE;
			$response_array['status'] = FALSE;
			$response_array['form_validation_errors'] = validation_errors();
		}
		*/
		echo json_encode($response_array);
	}
	
	public function job_application_delete()
	{
		$this->job_application_model->delete( 
			strtolower($this->input->post('applicant')), 
			strtolower($this->input->post('job_id')) );
		echo json_encode(array("status" => TRUE));
	}
	
	
	/*
	 * Checks if email is unique.
	 *
	 * @access	public
	 * @return	boolean TRUE if the email is unique.
	 */
	public function check_unique_email()
	{
		if ( $this->auth->check_unique_email($this->input->post('inputEmail')) ) {
			echo "true";
		}
		else
		{
			echo "false";
		}
	}
	
	/*
	 * Checks if string contains at least 1 alphabet and 1 number.
	 *
	 * @access	public
	 * @param	string [$str] The string to check upon.
	 * @return	boolean TRUE if the string contains at least 1 alphabet and 1 number.
	 */
	public function password_check($str)
	{
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str)) {
			return TRUE;
		}
		return FALSE;
	}
}
