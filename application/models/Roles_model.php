<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {
    
    private $table_name = "roles";
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 *
	 * @access	public
	 * @return	
	 */
    public function get()
    {
        return $this -> db -> get($this->table_name);
    }
}
