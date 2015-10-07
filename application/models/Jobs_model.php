<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs_model extends CI_Model {
    
    private $table_name = "jobs";
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 * Optional to filter by job_id column.
	 *
	 * @access	public
	 * @param	string [$job_id] The job_id row to select only
	 * @return	
	 */
    public function get($job_id = NULL)
    {
        if ( !is_null($job_id )) {
            $this -> db -> where('job_id', $job_id);
        }
        return $this -> db -> get($this->table_name);
    }
	
}
