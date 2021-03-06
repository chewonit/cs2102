<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {
    
    private $table_name = "company";
	private $column = array('company_reg_no', 'company_admin', 'company_name', 'location', 'description');
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 * Optional to filter by company_reg_no column.
	 *
	 * @access	public
	 * @param	string [$company_reg_no] The company_reg_no row to select only
	 * @return	
	 */
    public function get($company_reg_no = NULL, $company_admin = NULL)
    {
        if ( !is_null($company_reg_no )) {
            $this -> db -> where('company_reg_no', $company_reg_no);
        }
		if ( !is_null($company_admin )) {
            $this -> db -> where('company_admin', $company_admin);
        }
        return $this -> db -> get($this->table_name);
    }
	
	public function get_distinct($col = null, $order = null)
    {
		if ( !is_null($col)) {
            $this -> db -> select($col);
        }
		if ( !is_null($order)) {
			$this -> db -> order_by($order, 'asc');
        }
        $this -> db -> distinct();
        return $this -> db -> get($this->table_name);

    }
	
	public function insert($data)
    {
        return $this -> db -> insert($this->table_name, $data);
    }
	
	public function update($company_reg_no, $data)
    {
		$this -> db -> where('company_reg_no', $company_reg_no);
        return $this -> db -> update($this->table_name, $data);
    }
	
	public function delete($company_reg_no)
    {
        $this -> db -> where('company_reg_no', $company_reg_no);
        return $this -> db -> delete($this->table_name);
	}
	
	public function get_applied_companies($employer)
    {
		$this->db->from('company AS c'); 
		$this->db->join('company_employer e', 'e.company_reg_no = c.company_reg_no');
		$this->db->where('e.employer', $employer);
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
