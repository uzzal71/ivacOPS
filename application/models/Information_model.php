<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information_model extends CI_Model {

	public function save($employee_id, $password)
	{
		$sql = "UPDATE `users` SET `password` = '".$password."' WHERE  `employee_id` = '".$employee_id."'";
		$this->db->query($sql);
	}
}