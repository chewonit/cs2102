<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Category_model extends CI_Model {
    
    private $table_name = "job_category";
	private $column = array('category_id', 'name');
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 * Optional to filter by category_id column.
	 *
	 * @access	public
	 * @param	string [$category_id] The category_id row to select only
	 * @return	
	 */
    public function get($category_id = NULL)
    {
        if ( !is_null($category_id )) {
            $this -> db -> where('category_id', $category_id);
        }
        return $this -> db -> get($this->table_name);
    }
	
	public function insert($data)
    {
        return $this -> db -> insert($this->table_name, $data);
    }
	
	public function update($category_id, $data)
    {
		$this -> db -> where('category_id', $category_id);
        return $this -> db -> update($this->table_name, $data);
    }
	
	public function delete($category_id)
    {
        $this -> db -> where('category_id', $category_id);
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
