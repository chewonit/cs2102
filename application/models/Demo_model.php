<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_model extends CI_Model {
    
    private $table_name = "demo";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get($id = NULL)
    {
        if ( !is_null($id )) {
            $this -> db -> where('id', $id);
        }
        $query = $this -> db -> get($this->table_name);
        return $query;
    }

    public function insert($data)
    {
        $this -> db -> insert($this->table_name, $data);
        return;
    }

    public function update($data)
    {
        $this -> db -> where('id', $data['id']);
        $this -> db -> update($this->table_name, $data);
    }

    public function delete($id)
    {
        $this -> db -> where('id', $id);
        $this -> db -> delete($this->table_name);
    }

}
