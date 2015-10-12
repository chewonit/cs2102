<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {
    
	public function __construct()
	{
		parent::__construct();
	}
    
	public function get( $conditions = null, $search = null ) 
	{
		$this->db->from('jobs j');
		$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
		
		$search_fields = "`c.company_name`, `j.Title`, `j.Description`, `c.Location`";
		
		if( !is_null($conditions) ) 
		{
			$this->db->where($conditions);
		}
		if( !is_null($search) ) 
		{
			//
			// To be implemented
			//
			// $this->db->where("MATCH (".$search_fields.") AGAINST ('$search')", NULL, FALSE);
		}
		return $this -> db -> get();
	}
}
