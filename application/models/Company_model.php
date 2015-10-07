<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {
    
    private $table_name = "company";
    
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
    public function get($company_reg_no = NULL)
    {
        if ( !is_null($company_reg_no )) {
            $this -> db -> where('company_reg_no', $company_reg_no);
        }
        return $this -> db -> get($this->table_name);
    }
	
}
