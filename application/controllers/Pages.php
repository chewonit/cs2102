<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	private $site_title = "CS2102 Group 9";

	public function view($page = 'home')
	{
		if ( ! file_exists(APPPATH.'/views/pages/'.$page.'.php'))
        {
                // Whoops, page not found!
                show_404();
        }

        $data['site_title'] = $this->site_title;
		
		/* Demo get from database */
		$this->load->library('table');
		$data['demo_list'] = $this->db->get('demo');

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
	}
}