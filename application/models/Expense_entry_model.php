<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_entry_model extends CI_Model {

	public function save_expense_info($data)
	{
        $this->db->insert('tbl_daily_expense_log',$data); 
	}

	public function update_data()
	{

	}

	public function select_data()
	{

	}

	/**
    * Model Expense Delete Data
    **/
    public function delete_data($expense_code)
    {
        $this->db->where('expense_code', $expense_code);      
        $this->db->delete('tbl_daily_expense_log');
    }

	/**
	* Model Get Expense Type Function
	**/
	public function get_expense_type($center_id)
	{
		$this->db->select('*');
        $this->db->from('expense_type');
        $this->db->where('center_id',$center_id);
        $this->db->where('status','1');
        $this->db->order_by('expense_type','asc');
        $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;

    }

    /**
    * Model Select Last Insert Expense Code Function
    **/
    public function select_last_expense_code()
    {	
        $final='EX'.date('Ym');

        $sql = "SELECT max(SUBSTRING(expense_code,9,16)) as lastid FROM `tbl_daily_expense_log` WHERE `expense_code` LIKE '$final%' ESCAPE '!' AND length(`expense_code`) > 10 ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
		return $result;

    }

    /**
    * Model Pick Lastest Expense Code
    **/
     public function pick_latest_expense_code($final)
    {   
        $sql = "SELECT max(SUBSTRING(expense_code,9,16)) as lastid FROM `tbl_daily_expense_log` WHERE `expense_code` LIKE '$final%' ESCAPE '!' AND length(`expense_code`) > 10 ";
        $query_result = $this->db->query($sql);
        $result = $query_result->result();
		return $result;

    }

     /**
    **get_expense_info_to_update
    **/
    public function get_expense_info_to_update($expense_code)
    {
    $this->db->select('*');
    $this->db->from('tbl_daily_expense_log');
    $this->db->where('expense_code',$expense_code);
     
    $query_result = $this->db->get();
    $result = $query_result->result();

    return $result;

    }

   
	
}