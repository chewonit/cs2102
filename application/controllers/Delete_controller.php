<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_controller extends MY_Controller {

	public function view()
	{
		$page = 'delete_page';

		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Delete Controller Page";

		/* Demo get from database */
		$data['demo_list'] = $this -> demo_model -> get();

		$this -> load_view($data, $page);
	}
	
	public function delete()
	{
		$id = $this->input->post('inputJobId');
		if(is_null($id)) {
			redirect('/demo/delete');
		}
		$this -> demo_model -> delete($id);
		
		echo "id: $id | Row deleted";
	}
	
}
