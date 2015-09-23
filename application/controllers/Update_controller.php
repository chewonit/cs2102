<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_controller extends CI_Controller {

	private $site_title = "CS2102 Group 9 Update";

	public function view()
	{
		$page = 'update_page';

		if (!file_exists(APPPATH . '/views/pages/' . $page . '.php'))
		{
			// Whoops, page not found!
			show_404();
		}

		$data['site_title'] = $this -> site_title;
		$data['page_title'] = "Update Controller Page";

		/* Demo get from database */
		$this -> load -> library('table');
		$this -> load -> model('demo_model');
		$data['demo_list'] = $this -> demo_model -> get();

		$this -> load -> view('templates/header', $data);
		$this -> load -> view('pages/' . $page, $data);
		$this -> load -> view('templates/footer', $data);
	}

	public function update()
	{
		$segment = $this -> uri -> segment(2);
		echo "<h3>Segment: " . $segment . "</h3>";

		echo '<ul>';
		echo '<li>' . anchor('demo/update', 'Update') . '</li>';
		echo '</ul>';

		if($segment == 'update') {
			$data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'title' => $this->input->post('title'),
			'description' => $this->input->post('description'),
			'location' => $this->input->post('location')
			);
			
			$this -> demo_model -> update($data);
			echo "Row Updated <br /><br />";

			$result = $this -> demo_model -> get($data['id']);
			echo $this -> table -> generate($result);
			
			echo "<br /><br />";

			$result = $this -> demo_model -> get();
			echo $this -> table -> generate($result);
			return;
		}
	}
}
