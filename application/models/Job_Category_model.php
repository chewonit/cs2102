<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_Category_model extends CI_Model {
    
    private $table_name = "job_category";
    
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
	
}
