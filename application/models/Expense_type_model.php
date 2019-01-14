<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_type_model extends CI_Model {
	/**
	* Model Expense Save Function
	**/
	public function save_data($data)
	{
		$this->db->insert('expense_type', $data);
	}

	/**
	* Model Expense Delete Function
	**/
	public function update_data($expense_id, $data)
	{
		$this->db->where('expense_id', $expense_id);
		$this->db->update('expense_type', $data);
	}

	/**
	* Model Expense Delete Function
	**/
	public function delete_data($expense_id)
	{
		$this->db->where('expense_id', $expense_id);
		$this->db->delete('expense_type');
	}

	/**
	* Model Expense Check already exist
	*/
	public function check_dublicate_expense_exist($expense_type, $center_id)
	{
		$sql = "SELECT `expense_type`, `center_id` FROM `expense_type` WHERE `expense_type` = '$expense_type' AND `center_id` = '$center_id' ";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
	}
	
}