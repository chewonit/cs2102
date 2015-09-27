<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insert_controller extends MY_Controller {
    
	public function view()
    {
        $page = 'insert_page';
        
		$this -> check_page_files('/views/pages/' . $page . '.php');
		
		$data['page_title'] = "Insert Controller Page";
		
        $data['demo_list'] = $this -> demo_model -> get();
		
        $this -> load_view($data, $page);
    }
	
    public function insert()
	{
		$data = array(
		'id' => $this->input->post('inputJobId'),
		'name' => $this->input->post('inputCompanyName'),
		'title' => $this->input->post('inputTitle'),
		'description' => $this->input->post('inputDescription'),
		'location' => $this->input->post('inputLocation')
		);
		
		$this -> demo_model -> insert($data);
		redirect('/demo/insert');
	}
}
