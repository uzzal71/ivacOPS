<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	  

    public function select_all_employee_list()
	{

	    $this->db->Select('*');
	    $this->db->from('employee');
	    $this->db->where('status','1');
	    $query_result = $this->db->get();
	    $result = $query_result->result();
	    return $result;

	}


	public function employee_name($employee_id)
	{
		$sql = "SELECT `employee_name`, `center_id` FROM employee WHERE employee_id = '$employee_id' ";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
	}

    public function employee_name_with_center($employee_id, $center_id)
    {
        $sql = "SELECT `employee_name`, `center_id` FROM employee WHERE employee_id = '$employee_id' AND `center_id` = '$center_id' ";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
    }



   public function check_employee_id($employee_id, $center_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('employee_id',$employee_id);
        $this->db->where('center_id',$center_id);
        $query_result = $this->db->get();
        $result = $query_result->row();

        return $result;
    }


    public function save_user_info($data)
    {
        $this->db->insert('users',$data);
		return $this->db->affected_rows() > 0;
    }


    public function select_each_user_info($id,$employee_id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$id);
        $this->db->where('employee_id',$employee_id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }



    // Update User
    public function update_user_info($employee_id,$data)
    {
    	$menu_permitted = $data['menu_permitted'];
        $center_role = $data['center_role'];
        $center_id = $data['center_id'];
        $status = $data['status'];

    	$sql = "UPDATE `users` SET `menu_permitted` = '$menu_permitted', `center_role` = '$center_role', `status` = $status, `center_id` = $center_id WHERE  `employee_id` = '$employee_id' ";
		return $this->db->query($sql);

    }

    // Delete user
	public function delete_user_info($id)
	{
        
        $this->db->where('id', $id);
        $this->db->delete('users');
    }

    
    




}