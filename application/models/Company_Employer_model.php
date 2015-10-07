<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_Employer_model extends CI_Model {
    
    private $table_name = "company_employer";
    
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
    public function get($employer = NULL, $company_reg_no = NULL)
    {
        if ( !is_null($employer )) {
            $this -> db -> where('employer', $employer);
        }
		if ( !is_null($company_reg_no )) {
            $this -> db -> where('company_reg_no', $company_reg_no);
        }
        return $this -> db -> get($this->table_name);
    }
	
}
