<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance_model extends CI_Model {

	public function store($data)
	{
		$this->db->insert('performances', $data);
	}

	public function updated($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('performances', $data);
	}


	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('performances');
	}
	
}