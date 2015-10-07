<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Application_model extends CI_Model {
    
    private $table_name = "job_application";
    private $column = array('applicant', 'job_id', 'date_submitted');
	
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
	
	public function insert($data)
    {
        return $this -> db -> insert($this->table_name, $data);
    }
	
	public function update($applicant, $job_id, $data)
    {
		$this -> db -> where('applicant', $applicant);
		$this -> db -> where('job_id', $job_id);
        return $this -> db -> update($this->table_name, $data);
    }
	
	public function delete($applicant, $job_id)
    {
        $this -> db -> where('applicant', $applicant);
        $this -> db -> where('job_id', $job_id);
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

