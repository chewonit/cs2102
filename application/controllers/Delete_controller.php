<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete_controller extends CI_Controller {

	private $site_title = "CS2102 Group 9";

	public function view()
	{
		$page = 'delete_page';

		if (!file_exists(APPPATH . '/views/pages/' . $page . '.php'))
		{
			// Whoops, page not found!
			show_404();
		}

		$data['site_title'] = $this -> site_title;
		$data['page_title'] = "Delete Controller Page";

		/* Demo get from database */
		$data['demo_list'] = $this -> demo_model -> get();

		$this -> load -> view('templates/header', $data);
		$this -> load -> view('pages/' . $page, $data);
		$this -> load -> view('templates/footer', $data);
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
