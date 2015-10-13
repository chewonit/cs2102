<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
    
	public function __construct()
	{
		parent::__construct();
	}
    
	public function get( $conditions = null, $search = null ) 
	{
		$this->db->select('j.job_id, j.company_reg_no, j.date_created, j.published, j.category_id, j.title, j.description AS job_description, j.experience, j.skills, c.company_admin, c.company_name, c.location, c.description, cat.*');
		$this->db->from('jobs j');
		$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
		$this->db->join('job_category cat', 'cat.category_id = j.category_id');
		
		$search_fields = "j.Title, j.Description, j.Skills";
		
		if( !is_null($conditions) ) 
		{
			$this->db->where($conditions);
		}
		if( !is_null($search) ) 
		{
			//
			// To be implemented
			//
			$this->db->where("MATCH (".$search_fields.") AGAINST ('$search')", NULL, FALSE);
		}
		return $this -> db -> get();
	}
}
