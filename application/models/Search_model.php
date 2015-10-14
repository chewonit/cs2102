<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
    
	public function __construct()
	{
		parent::__construct();
	}
    
	public function get( $conditions = null, $search = null ) 
	{
		$this->db->select('*, j.description AS job_description');
		$this->db->from('jobs j');
		$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
		$this->db->join('job_category cat', 'cat.category_id = j.category_id');
		
		$search_fields = "j.Title, j.Description, j.Skills";
		$search_fields2 = "c.Company_name, c.Location";
		
		if( !is_null($conditions) ) 
		{
			$this->db->where($conditions);
		}
		if( !is_null($search) ) 
		{
			$this->db->where("MATCH (".$search_fields.") AGAINST ('$search')", NULL, FALSE);
			$this->db->or_where("MATCH (".$search_fields2.") AGAINST ('$search')", NULL, FALSE);
		}
		
		return $this -> db -> get();
	}
}
