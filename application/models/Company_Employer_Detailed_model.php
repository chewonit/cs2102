<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_Employer_Detailed_model extends CI_Model {
    
    private $table_name = "company_employer_detailed";
    
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
	 * Retrieves all columns from all rows.
	 * Optional to filter by company_reg_no column.
	 * And omit employer.
	 *
	 * @access	public
	 * @param	string [$company_reg_no] The company_reg_no row to select only
	 * @param	string [$employer] The employer to omit
	 * @return	
	 */
    public function get_except($company_reg_no = NULL, $accepted = NULL, $employer = NULL)
    {
        if ( !is_null($company_reg_no )) {
            $this -> db -> where('company_reg_no', $company_reg_no);
        }
		if ( !is_null($accepted )) {
            $this -> db -> where('accepted', $accepted);
        }
		if ( !is_null($employer )) {
            $this -> db -> where('employer !=', $employer);
        }
        return $this -> db -> get($this->table_name);
    }
	
	public function count_all()
	{
		$this->db->from($this->table_name);
		return $this->db->count_all_results();
	}
}
