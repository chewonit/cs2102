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
	
	/**
	* Returns results queried
	* Accoring to category, experience, company name, location and skills
	**/
	public function browse($cat, $exp, $name, $loc, $skill){
		if ($cat == 0 && $exp==0 && strlen($loc)==0 && strlen($skill)==0 && strlen($name)==0){
			return $this -> db -> query("
				SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location ,j.published
				FROM jobs j , company c 
				WHERE j.company_reg_no=c.company_reg_no
				ORDER BY j.date_created DESC ");
			}
		
		else if ($cat != 0){
			
			return $this -> db -> query("
				SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
				FROM jobs j , company c
				WHERE c.company_reg_no=j.company_reg_no AND (j.category_id = '$cat')
				ORDER BY j.date_created DESC ");
		}
		
		else if ($exp != 0){
			
			if ($exp==1){
				return $this -> db -> query("
				SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND (j.experience = 0)
				ORDER BY j.date_created DESC ");
			}
			else if ($exp==2){
				return $this -> db -> query("
				SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND (j.experience >= 1) AND (j.experience <=4)
				ORDER BY j.date_created DESC ");
			}
			else if ($exp==3){
				return $this -> db -> query("
				SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND (j.experience>=4) AND (j.experience<=7)
				ORDER BY j.date_created DESC ");
			}
			else if ($exp==4){
				return $this -> db -> query("
				SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND (j.experience>=7) AND (j.experience<=10)
				ORDER BY j.date_created DESC ");
			}
			else if ($exp==5){
				return $this -> db -> query("
				SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND (j.experience >=10)
				ORDER BY j.date_created DESC ");
			}
		}
		
		else if (strlen($name)!=0) {
			return $this -> db -> query ("
			SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
			FROM jobs j , company c
			WHERE c.company_reg_no=j.company_reg_no AND c.company_reg_no = '$name'
			ORDER BY j.date_created DESC");
		}
		
		else if (strlen($loc)!=0) {
			return $this -> db -> query ("
			SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
			FROM jobs j , company c
			WHERE c.company_reg_no=j.company_reg_no AND c.location='$loc'
			ORDER BY j.date_created DESC");	
		}
		
		else if (strlen($skill)!=0) {
			return $this -> db -> query ("
			SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location
			FROM jobs j , company c
			WHERE c.company_reg_no=j.company_reg_no AND j.skills='$skill'
			ORDER BY j.date_created DESC");
			
		}
	}

}