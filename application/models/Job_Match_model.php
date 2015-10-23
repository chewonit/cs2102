<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Match_model extends CI_Model {
    
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get( $email ) 
	{
		$this->db->from('resume_profile');
		$this->db->where('owner', $email);
		$result = $this -> db -> get()->result();
		
		if ( count( $result ) == 1 ) 
		{
			$profile = $result[0];
			
			$this->db->select('*, j.description AS job_description');
			$this->db->from('jobs j');
			$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
			$this->db->join('job_category cat', 'cat.category_id = j.category_id');
			$this->db->where('j.published', 1);
			
			$this->db->where("`job_id` NOT IN (SELECT `job_id` FROM job_application WHERE `applicant` = '$email')");
			
			$search_fields = "j.Title, j.Description, j.Skills";
				
			$clause = "MATCH (".$search_fields.") AGAINST ('$profile->description')";
			$clause .= " OR MATCH (".$search_fields.") AGAINST ('$profile->work_history')";
			$clause .= " OR MATCH (".$search_fields.") AGAINST ('$profile->edu_history')";
			$clause .= " OR MATCH (".$search_fields.") AGAINST ('$profile->skills')";
			$clause .= " OR MATCH (".$search_fields.") AGAINST ('$profile->interest_area')";
			
			$search_fields1 = "c.Company_name, c.Address";
			
			$clause = " MATCH (".$search_fields1.") AGAINST ('$profile->description')";
			$clause .= " OR MATCH (".$search_fields1.") AGAINST ('$profile->work_history')";
			$clause .= " OR MATCH (".$search_fields1.") AGAINST ('$profile->edu_history')";
			$clause .= " OR MATCH (".$search_fields1.") AGAINST ('$profile->interest_area')";
			
			$search_fields2 = "cat.Name";
			
			$clause = " MATCH (".$search_fields2.") AGAINST ('$profile->description')";
			$clause .= " OR MATCH (".$search_fields2.") AGAINST ('$profile->work_history')";
			$clause .= " OR MATCH (".$search_fields2.") AGAINST ('$profile->edu_history')";
			$clause .= " OR MATCH (".$search_fields2.") AGAINST ('$profile->interest_area')";

			$this->db->where("( $clause OR j.location = '$profile->location_pref')", NULL, FALSE);
			
			$result = $this -> db -> get()->result();
			
			return $result;
			
		}
		else 
		{
			return null;
		}
		
		return $this -> db -> get();
	}
    
	/*
	public function get( $conditions = null, $search = null ) 
	{
		$this->db->select('*, j.description AS job_description');
		$this->db->from('jobs j');
		$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
		$this->db->join('job_category cat', 'cat.category_id = j.category_id');
		
		$search_fields = "j.Title, j.Description, j.Skills";
		$search_fields2 = "c.Company_name, c.Address";
		
		if( !is_null($conditions) ) 
		{
			$this->db->where($conditions);
		}
		if( !is_null($search) ) 
		{
			$clause = "MATCH (".$search_fields.") AGAINST ('$search')";
			$clause .= " OR MATCH (".$search_fields2.") AGAINST ('$search')";
			
			$this->db->where("( $clause )", NULL, FALSE);
		}
		
		return $this -> db -> get();
	}
	
	
	public function search_jobseekers( $conditions = null , $keywords = null ) 
	{
		$this->db->from('resume_profile p');
		$this->db->join('users u', 'u.email = p.owner');
		$this->db->where('u.role', 'jobseeker');
		
		if( !is_null($conditions) ) 
		{
			$this->db->where($conditions);
		}
		
		if( !is_null($keywords) ) 
		{
			$search_fields = "p.owner, p.address, p.description, p.work_history, p.edu_history, p.skills, p.interest_area";
			$search_fields2 = "u.first_name, u.last_name";
			
			$clause = "MATCH (".$search_fields.") AGAINST ('$keywords')";
			$clause .= " OR MATCH (".$search_fields2.") AGAINST ('$keywords')";
			
			$this->db->where("( $clause )", NULL, FALSE);
		}
		
		return $this -> db -> get();
	}
	*/
}
