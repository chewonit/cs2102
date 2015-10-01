<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_controller extends MY_Controller {

	public function index()
	{
		$page = 'update_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Update Controller Page";

		$data['demo_list'] = $this -> demo_model -> get();

		$this -> load_view($data, $page);
	}
	
	public function update()
	{
		$data = array(
		'id' => $this->input->post('inputJobId'),
		'name' => $this->input->post('inputCompanyName'),
		'title' => $this->input->post('inputTitle'),
		'description' => $this->input->post('inputDescription'),
		'location' => $this->input->post('inputLocation')
		);
		
		$this -> demo_model -> update($data);
		redirect('/demo/update');
	}
	
}
