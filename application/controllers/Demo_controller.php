<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_controller extends CI_Controller {

    private $site_title = "CS2102 Group 9";

    public function view()
    {
        $page = 'demo_page';

        if (!file_exists(APPPATH . '/views/pages/' . $page . '.php'))
        {
            // Whoops, page not found!
            show_404();
        }

        $data['site_title'] = $this -> site_title;
        $data['page_title'] = "Demo Controller Page";

        /* Demo get from database */
        $this -> load -> library('table');
        $this -> load -> model('demo_model');
        $data['demo_list'] = $this -> demo_model -> get();

        $this -> load -> view('templates/header', $data);
        $this -> load -> view('pages/' . $page, $data);
        $this -> load -> view('templates/footer', $data);
    }

    public function test()
    {
        $segment = $this -> uri -> segment(3);
        echo "<h3>Segment: " . $segment . "</h3>";

        echo '<ul>';
        echo '<li>' . anchor('demo/test/query', 'Query') . '</li>';
        echo '<li>' . anchor('demo/test/insert', 'Insert') . '</li>';
        echo '<li>' . anchor('demo/test/update', 'Update') . '</li>';
        echo '<li>' . anchor('demo/test/delete', 'Delete') . '</li>';
        echo '</ul>';

        switch ($segment) {
            case 'query' :
                $result = $this -> demo_model -> get();
                echo $this -> table -> generate($result);
                return;

            case 'insert' :
                $data = array(
                    'id' => '12345',
                    'name' => 'Company Name',
                    'Title' => 'Title',
                    'Description' => 'Description',
                    'Location' => 'China'
                );
                $this -> demo_model -> insert($data);
                echo "Row Inserted <br /><br />";

                $result = $this -> demo_model -> get('12345');
                echo $this -> table -> generate($result);
                return;

            case 'update' :
                $data = array(
                    'id' => '12345',
                    'name' => 'UPDATED Company Name',
                    'Title' => 'UPDATED Title',
                    'Description' => 'UPDATED Description',
                    'Location' => 'UPDATED Location'
                );
                $this -> demo_model -> update($data);
                echo "Row Updated <br /><br />";

                $result = $this -> demo_model -> get('12345');
                echo $this -> table -> generate($result);
                
                echo "<br /><br />";

                $result = $this -> demo_model -> get();
                echo $this -> table -> generate($result);
                return;

            case 'delete' :
                $id = '12345';
                $this -> demo_model -> delete($id);
                echo "Row Deleted <br /><br />";

                $result = $this -> demo_model -> get();
                echo $this -> table -> generate($result);
                return;

            default :
                echo "<h3>Invalid Segment.</h3>";
                return;
        }

    }

}
