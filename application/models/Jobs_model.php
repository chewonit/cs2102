
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs_model extends CI_Model {
    
	private $table_name = "jobs";
	private $table_name2 = "company";
	private $tables = array('jobs','company');
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
	
	public function read($jobid) 
	{
		$this->db->select('*, j.description AS job_description');
		$this->db->from('jobs j');
		$this->db->join('company c', 'j.company_reg_no = c.company_reg_no');
		$this->db->join('job_category cat', 'cat.category_id = j.category_id');
		$this->db->where('j.job_id', $jobid);
		return $this -> db -> get();
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
	
	public function get_job_list_company($company_reg_no) 
	{
		$this->db->select('*, j.description AS job_description');
		$this->db->from('jobs AS j'); 
		$this->db->join('company c', 'c.company_reg_no = j.company_reg_no');
		$this->db->where('j.company_reg_no',$company_reg_no);
		$this->db->order_by('j.title','asc');
		return $this->db->get(); 
	}
	
	public function get_job_list_applicant($applicant) 
	{
		$this->db->select('*, j.description AS job_description');
		$this->db->from('jobs AS j'); 
		$this->db->join('company c', 'c.company_reg_no = j.company_reg_no');
		$this->db->join('job_application ja', 'ja.job_id = j.job_id');
		$this->db->join('job_category cat', 'cat.category_id = j.category_id');
		$this->db->where('ja.applicant',$applicant);
		$this->db->order_by('ja.date_submitted','desc');
		return $this->db->get(); 
	}
	
	public function get_skills() 
	{
		$this->db->select('skills');
		$this->db->distinct();
		$this->db->from('jobs'); 
		return $this->db->get();
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

