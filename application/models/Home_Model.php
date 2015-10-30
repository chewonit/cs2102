<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
    
	private $table_name = "jobs";
	private $column = array('job_id', 'company_reg_no', 'date_created', 'published', 'category_id', 'title', 'description', 'experience', 'skills');
    
	public function __construct()
	{
		parent::__construct();
	}
    
	public function get_limit($limit) {
		
		$this->db->select('j.*, c.company_name');
		$this->db->from('jobs j, company c');
		$this->db->where('j.company_reg_no = c.company_reg_no');
		$this->db->where('j.published = 1');
		$this->db->limit($limit);
		$this->db->order_by('j.date_created', 'desc');
		return $this -> db -> get();
	}
}
