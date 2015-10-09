<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs_model extends CI_Model {
    
	private $table_name = "jobs";
	private $column = array('job_id', 'company_reg_no', 'date_created', 'published', 'category_id', 'title', 'description', 'experience', 'skills');
	private $search_fields = "title, description, skills";
    
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
		return $this -> db -> get($this->table_name);
	}
	public function search($data,$cat,$exp)
	{
		/**
		$this -> db -> where('category_id',$cat);		
		$this -> db -> where('experience',$exp);
		$this->db->where("MATCH (title,description,title) AGAINST ('$data')", NULL, FALSE);
		return $this -> db -> get($this->table_name);
		
		**/
		if ($cat == 0){
			if ($exp == 0){
				//return $this -> db -> query("
				//	SELECT * FROM jobs WHERE MATCH(title, description, skills) AGAINST ('$data' IN BOOLEAN MODE)");
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location ,j.published
				FROM jobs j , company c 
				WHERE c.company_reg_no = j.company_reg_no AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 1){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.published, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.experience <2 AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 2){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.published, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.experience>0 AND  j.experience <4 AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 3){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.published, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND experience >3 AND experience <7 AND (j.title='$data' OR description = '$data')");
			}
			else if ($exp == 4){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.published, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no ANDexperience >6 AND experience <10 AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 5){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.published, j.title, j.description, j.experience, j.skills, j.date_created, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND experience >9 AND (j.title='$data' OR j.description = '$data')");
			}
		}
		else{
			if ($exp == 0){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created,j.published, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.category_id = '$cat' AND j.category_id = '$cat' AND (title='$data' OR j.description = '$data')");
			}
			else if ($exp == 1){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created,j.published, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.category_id = '$cat' AND j.experience <2 AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 2){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created,j.published, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.category_id = '$cat' AND j.experience >1 AND j.experience <4 AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 3){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created,j.published, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.category_id = '$cat' AND j.experience >3 AND j.experience <7 AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 4){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created,j.published, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.category_id = '$cat' AND j.experience >6 AND j.experience <10 AND (j.title='$data' OR j.description = '$data')");
			}
			else if ($exp == 5){
				return $this -> db -> query("
					SELECT j.job_id, j.company_reg_no, j.category_id, j.title, j.description, j.experience, j.skills, j.date_created,j.published, c.company_name, c.location 
				FROM jobs j , company c 
				WHERE c.company_reg_no=j.company_reg_no AND j.category_id = '$cat' AND j.experience >9 AND (j.title='$data' OR j.description = '$data')");
			}
		}
		
	}
	public function insert($data)
	{
		return $this -> db -> insert($this->table_name, $data);
	}
	
	public function update($job_id, $company_reg_no, $data)
	{
		$this -> db -> where('job_id', $job_id);
		$this -> db -> where('company_reg_no', $company_reg_no);
		return $this -> db -> update($this->table_name, $data);
	}
	
	public function delete($job_id, $company_reg_no)
	{
		$this -> db -> where('job_id', $job_id);
		$this -> db -> where('company_reg_no', $company_reg_no);
		return $this -> db -> delete($this->table_name);
	}
	
	function get_datatables()
	{
		$this->_get_datatables_query();
		
		if($_POST['length'] != -1) {
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		
		$query = $this->db->get();
		return $query->result();
	}
	
	private function _get_datatables_query()
	{
		
		$this->db->from($this->table_name);

		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value']) {
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			}
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
	}
}
