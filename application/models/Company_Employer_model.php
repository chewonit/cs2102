<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_Employer_model extends CI_Model {
    
    private $table_name = "company_employer";
	private $column = array('employer', 'company_reg_no', 'accepted');
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 * Optional to filter by employer, company_reg_no column.
	 *
	 * @access	public
	 * @param	string [$employer] The employer row to select only
	 * @param	string [$company_reg_no] The company_reg_no row to select only
	 * @return	
	 */
    public function get($employer = NULL, $company_reg_no = NULL, $accepted = NULL)
    {
        if ( !is_null($employer )) {
            $this -> db -> where('employer', $employer);
        }
		if ( !is_null($company_reg_no )) {
            $this -> db -> where('company_reg_no', $company_reg_no);
        }
		if ( !is_null($accepted )) {
            $this -> db -> where('accepted', $accepted);
        }
        return $this -> db -> get($this->table_name);
    }
	
	public function insert($data)
    {
        return $this -> db -> insert($this->table_name, $data);
    }
	
	public function update($employer, $data)
    {
		$this -> db -> where('employer', $employer);
        return $this -> db -> update($this->table_name, $data);
    }
	
	public function delete($employer)
    {
        $this -> db -> where('employer', $employer);
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
