<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_type_model extends CI_Model {
	/**
	* Model Income Type Save Function
	**/
	public function save_data($data)
	{
		$this->db->insert('income_type', $data);
	}

	/**
	* Model Income Type Delete Function
	**/
	public function update_data($income_id, $data)
	{
		$this->db->where('income_id', $income_id);
		$this->db->update('income_type', $data);
	}

	/**
	* Model Income Type Delete Function
	**/
	public function delete_data($income_id)
	{
		$this->db->where('income_id', $income_id);
		$this->db->delete('income_type');
	}

	/**
	* Model Income Type Check already exist
	*/
	public function check_dublicate_income_exist($income_type, $center_id)
	{
		$sql = "SELECT `income_type`, `center_id` FROM `income_type` WHERE `income_type` = '$income_type' AND `center_id` = '$center_id' ";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
	}
	
}