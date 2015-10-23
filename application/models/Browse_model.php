<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class browse_model extends CI_Model {

	private $table_name = "jobs";
	private $table_name2 = "company";
	private $tables = array('jobs','company');
	private $column = array('job_id', 'company_reg_no', 'date_created', 'published', 'category_id', 'title', 'description', 'experience', 'skills');
    
	public function __construct()
	{
		parent::__construct();
	}
    
	/**
	* Retrieves all columns from all rows.
	* Optional to filter by job_id or company_reg_no column.
	*
	* @access	public
	* @param	string [$job_id] The job_id row to select only
	* @param	string [$company_reg_no] The company_reg_no row to select only
	* @return	
	*/
	public function get($job_id = NULL, $company_reg_no = NULL)
	{
		if ( !is_null($job_id )) {
			$this -> db -> where('job_id', $job_id);
		}
		if ( !is_null($company_reg_no )) {
			$this -> db -> where('company_reg_no', $company_reg_no);
		}
		return $this -> db -> get($this->tables);
	}
	
	public function browse( $conditions = null, $like = null, $email = null ) 
	{
		$this->db->select('*, j.description AS job_description');
		$this->db->from('jobs j');
		$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
		$this->db->join('job_category cat', 'cat.category_id = j.category_id');
		
		$search_fields = "j.Title, j.Description, j.Skills";
		
		if( !is_null($conditions) ) 
		{
			$this->db->where($conditions);
		}
		if( !is_null($like) ) 
		{
			$this->db->like('j.skills', $like);
		}
		if( !is_null($email) ) 
		{
			$this->db->where("`job_id` NOT IN (SELECT `job_id` FROM job_application WHERE `applicant` = '$email')");
		}
		
		return $this -> db -> get();
	}
	
	public function browse_jobseekers( $conditions = null ) 
	{
		$this->db->from('resume_profile p');
		$this->db->join('users u', 'u.email = p.owner');
		$this->db->where('u.role', 'jobseeker');
		
		if( !is_null($conditions) ) 
		{
			$this->db->where($conditions);
		}
		return $this -> db -> get();
	}
	
	public function get_company_with_jobs() 
	{
		$this->db->select('c.company_reg_no, c.company_name');
		$this->db->distinct();
		$this->db->from('jobs j');
		$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
		return $this -> db -> get();
	}

}