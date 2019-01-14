<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Center_model extends CI_Model {

	function store($data) {

		$this->db->insert('centers', $data);
	}

	function update($id, $data) {

		$this->db->where('center_id', $id);
		$this->db->update('centers', $data);
	}

	function delete($center_id) {

		$this->db->where('center_id', $center_id);
		$this->db->delete('centers');
	}

	public function check_dublicate_center_exist($center)
	{
		$sql = "SELECT `center_name` FROM `centers` WHERE `center_name` = '$center' ";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
	}	

}