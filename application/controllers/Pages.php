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
		
		/* Demo get from database */
        $data['demo_list'] = $this -> demo_model -> get();

		$data['nav_class'] = "home";
		
        $this -> load_view($data, $page, $page);
    }
}
