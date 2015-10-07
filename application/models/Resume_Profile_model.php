<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resume_Profile_model extends CI_Model {
    
    private $table_name = "resume_profile";
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 *
	 * @access	public
	 * @param	string [$owner] The owner row to select only
	 * @return	
	 */
    public function get($owner = NULL)
    {
        if ( !is_null($owner )) {
            $this -> db -> where('owner', $owner);
        }
        return $this -> db -> get($this->table_name);
    }
	
}
