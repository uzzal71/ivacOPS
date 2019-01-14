<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asset_register_model extends CI_Model {

	public function save_asset_info($data)
	{
        $this->db->insert('tbl_asset_register_log', $data); 
	}

	function update($id, $data)
	{
	$this->db->where('id', $id);
	$this->db->update('tbl_asset_register_log', $data);
	}
    /**
    * Model Assert Delete Data
    **/
	public function delete_data($id)
	{
		$this->db->where('id', $id);      
        $this->db->delete('tbl_asset_register_log');
	}

   
	
}