<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_entry_model extends CI_Model {
    /**
    * Model Income Entry Function
    **/
	public function save_income_info($data)
    {
        $this->db->insert('tbl_daily_income_log',$data); 
    }

	public function update_data()
	{

	}

	/**
    * Model Income Delete Data
    **/
    public function delete_data($income_code)
    {
        $this->db->where('income_code', $income_code);      
        $this->db->delete('tbl_daily_income_log');
    }

	/**
	* Model Get Income Type Function
	**/
	public function get_income_type($center_id)
	{
		$this->db->select('*');
        $this->db->from('income_type');
        $this->db->where('center_id',$center_id);
        $this->db->where('status','1');
        $this->db->order_by('income_type','asc');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;

    }

    /**
    * Model Select Last Income Code Function
    **/
    public function select_last_income_code()
    {	
        $final='IN'.date('Ym');

        $sql = "SELECT max(SUBSTRING(income_code,9,16)) as lastid FROM `tbl_daily_income_log` WHERE `income_code` LIKE '$final%' ESCAPE '!' AND length(`income_code`) > 10 ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
		return $result;

    }

    /**
    * Model Pick Lasted Income Code Function
    **/
     public function pick_latest_income_code($final)
    {   
        $sql = "SELECT max(SUBSTRING(income_code,9,16)) as lastid FROM `tbl_daily_income_log` WHERE `income_code` LIKE '$final%' ESCAPE '!' AND length(`income_code`) > 10 ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
		return $result;

    }

     /**
    * Model Get Expense Amount
    **/
    public function get_amount($income_id)
    {
        $this->db->select('*');
        $this->db->from('income_type');
        $this->db->where('income_id',$income_id);
        $this->db->where('status','1');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;

    }

    /**
    **get_center_name
    **/
    public function get_center_name($center_id)
    {
        $this->db->select('*');
        $this->db->from('centers');
        $this->db->where('center_id',$center_id);;
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }

    /**
    **get_income_info_to_update
    **/
    public function get_income_info_to_update($income_code)
    {
    $this->db->select('*');
    $this->db->from('tbl_daily_income_log');
    $this->db->where('income_code',$income_code);
     
    $query_result = $this->db->get();
    $result = $query_result->result();

    return $result;

    }
	
}