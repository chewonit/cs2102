<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $site_title = "CS2102 Group 9";

	/**
	 * Template function to load the header, page and footer views.
	 *
	 * @access	protected
	 * @param	array [$data] The data to pass into the views
	 * @param	string [$page] The page view to load
	 * @param	string [$postfix] The headers with the postfix to load
	 * @return	
	 */
	protected function load_view($data, $page, $postfix = "") {
	
		$data['is_login'] = $this->is_loggedin();
		$data['is_admin'] = $this->is_admin();
		$data['is_jobseeker'] = $this->is_jobseeker();
		$data['is_employer'] = $this->is_employer();
		
		$data['site_title'] = $this -> site_title;
		
		$data['login_result'] = $this->session->flashdata('login_result');
		
		
		if (!array_key_exists("nav_class",$data))
		{
			$data['nav_class'] = "";
		}
	
		$this -> load -> view("templates/header", $data);
        $this -> load -> view('pages/' . $page, $data);
		$this -> load -> view("templates/footer", $data);
	}
	
	/**
	 * Checks if the page file exists.
	 * Otherwise, loads the Error 404 page.
	 *
	 * @access	protected
	 * @param	string [$page_path] The path of the page to check
	 * @return	
	 */
	protected function check_page_files($page_path) {
		if (!file_exists(APPPATH . $page_path))
		{
			// Whoops, page not found!
			show_404();
		}
	}
	
	protected function is_loggedin() {
		return $this->auth->is_loggedin();
	}
	
	protected function is_admin() {
		return $this->auth->is_role( $this->auth->roles['admin'] );
	}
	
	protected function is_jobseeker() {
		return $this->auth->is_role( $this->auth->roles['jobseeker'] );
	}
	
	protected function is_employer() {
		return $this->auth->is_role( $this->auth->roles['employer'] );
	}
}
