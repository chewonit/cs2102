<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_model extends CI_Model {
    
    private $table_name = "demo";
	private $search_fields = "Name, Title, Description, Location";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get($id = NULL)
    {
        if ( !is_null($id )) {
            $this -> db -> where('id', $id);
        }
        return $this -> db -> get($this->table_name);
    }

    public function insert($data)
    {
        return $this -> db -> insert($this->table_name, $data);
    }

    public function update($data)
    {
        $this -> db -> where('id', $data['id']);
        return $this -> db -> update($this->table_name, $data);
    }

    public function delete($id)
    {
        $this -> db -> where('id', $id);
        return $this -> db -> delete($this->table_name);
    }

	public function search($keywords) {
		$this->db->where("MATCH (".$this->search_fields.") AGAINST ('$keywords')", NULL, FALSE);
		return $this -> db -> get($this->table_name);
	}
}
