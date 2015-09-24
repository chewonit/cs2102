<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Insert_controller extends CI_Controller {
    private $site_title = "CS2102 Group 9";
    public function view()
    {
        $page = 'insert_page';
        if (!file_exists(APPPATH . '/views/pages/' . $page . '.php'))
        {
            // Whoops, page not found!
            show_404();
        }
        $data['site_title'] = $this -> site_title;
        $data['page_title'] = "Insert Controller Page";
		
        /* Demo get from database */
        $this -> load -> library('table');
        $this -> load -> model('demo_model');
        $data['demo_list'] = $this -> demo_model -> get();
		
        $this -> load -> view('templates/header', $data);
        $this -> load -> view('pages/' . $page, $data);
        $this -> load -> view('templates/footer', $data);
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
