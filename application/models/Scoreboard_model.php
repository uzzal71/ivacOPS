<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scoreboard_model extends CI_Model {

	public function store($data)
	{
		$this->db->insert('employee_score', $data);
	}

	public function updated($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('employee_score', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('employee_score');
	}

	// get center id
	public function get_center_id($employee_id)
	{
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('employee_id', $employee_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	// get center name
	public function get_center_name($center_id)
	{
		$this->db->select('*');
		$this->db->from('centers');
		$this->db->where('center_id', $center_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function saved_behavior($data)
	{
		$this->db->insert('behavior', $data);
	}



	public function check_save_data_exist($employee_id, $center_id, $date)
	{
		$this->db->select('*');
		$this->db->from('employee_score');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('center_id', $center_id);
		$this->db->where('date', $date);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	public function updated_behavior($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('behavior', $data);
	}

	public function delete_behavior($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('behavior');
	}

	public function check_score_is_already_entry($date, $employee_id, $center_id)
	{

		$sql = "SELECT * FROM `behavior` WHERE `date` = '$date' AND `employee_id` = '$employee_id' AND `center_id` = $center_id ";
		$query_result = $this->db->query($sql);
		$result = $query_result->row();
        return $result;
	}

}