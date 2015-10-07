<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	private $page_title = "Admin";

	public function index()
	{
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
		
		$create_user_data = array(
			'first_name' => strtolower($this->input->post('inputFirstName')),
			'last_name' => strtolower($this->input->post('inputLastName')),
			'email' => strtolower($this->input->post('inputEmail')),
			'password' => $this->input->post('inputPassword'),
			'nationality' => strtolower($this->input->post('inputNationality')),
			'contact' => $this->input->post('inputContact'),
			'gender' => strtolower($this->input->post('inputGender')),
			'role' => strtolower($this->input->post('inputAccount'))
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
		
		$create_user_data = array(
			'first_name' => strtolower($this->input->post('inputFirstName')),
			'last_name' => strtolower($this->input->post('inputLastName')),
			'nationality' => strtolower($this->input->post('inputNationality')),
			'contact' => $this->input->post('inputContact'),
			'gender' => strtolower($this->input->post('inputGender')),
			'role' => strtolower($this->input->post('inputAccount'))
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
	}
	
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
