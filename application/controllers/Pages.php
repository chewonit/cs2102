<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends MY_Controller {

    public function index($page = 'home')
    {
        if (!file_exists(APPPATH . '/views/pages/' . $page . '.php'))
        {
            // Whoops, page not found!
            show_404();
        }
		
		$this->load->model("home_model");
        $data['latest_jobs'] = $this -> home_model -> get_limit(4);

		$data['nav_class'] = "home";
		
        $this -> load_view($data, $page, $page);
    }
}
