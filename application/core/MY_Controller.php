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
	
		$data['is_login'] = $this->auth->is_loggedin();
		$data['site_title'] = $this -> site_title;
	
		if (file_exists(APPPATH . "views/templates/header-$postfix" . '.php')) {
           $this -> load -> view("templates/header-$postfix", $data);
        } else {
			$this -> load -> view("templates/header", $data);
		}
		
        $this -> load -> view('pages/' . $page, $data);
		
		if (file_exists(APPPATH . "views/templates/footer-$postfix" . '.php')) {
           $this -> load -> view("templates/footer-$postfix", $data);
        } else {
			$this -> load -> view("templates/footer", $data);
		}
	}
	
	/**
	 * Log in the user and redirects to home page.
	 * Form parameters are grabbed via POST.
	 *
	 * @access	public
	 * @return	
	 */
	public function login(){
		echo $this->input->post('inputLoginEmail')."<br />";
		echo $this->input->post('inputLoginPassword')."<br />";
		if ( $this->auth->login($this->input->post('inputLoginEmail'), $this->input->post('inputLoginPassword')) ) 
		{
			echo 'true | logged in';
		}
		echo 'false | failed to log in';
		redirect('home');
	}
	
	/**
	 * Logs the user out and redirects to home page.
	 *
	 * @access	public
	 * @return	
	 */
	public function logout(){
		if ( $this->auth->logout() ) 
		{
			echo 'true | logged out';
		}
		echo 'false | failed to log in';
		redirect('home');
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
}
