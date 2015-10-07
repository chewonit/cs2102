<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Application_model extends CI_Model {
    
    private $table_name = "job_application";
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 * Optional to filter by applicant or job_id column.
	 *
	 * @access	public
	 * @param	string [$applicant] The applicant row to select only
	 * @param	string [$job_id] The job_id row to select only
	 * @return	
	 */
    public function get($applicant = NULL, $job_id = NULL)
    {
        if ( !is_null($applicant )) {
            $this -> db -> where('applicant', $applicant);
        }
		if ( !is_null($job_id )) {
            $this -> db -> where('job_id', $job_id);
        }
        return $this -> db -> get($this->table_name);
    }
	
}
