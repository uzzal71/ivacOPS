<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

	public function delete_data($id)
	{
		$this->db->where('id', $id);
      
    $this->db->delete('employee');
	}

	public function check_employee_id($employee_id, $center_id)
    {
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('employee_id',$employee_id);
        $this->db->where('center_id',$center_id);
        $this->db->where('status','1');
		    $query_result=$this->db->get();
        $result=$query_result->result();
        return $result;
    }

    public function save_data($data)
    {
	 
     $query=$this->db->insert('employee',$data); 
		
    }

    public function update_data($id,$data)
    {

        $this->db->where('id',$id);
        $this->db->update('employee',$data);
        return $this->db->affected_rows() > 0;
    }

    public function get_pdf_data()
    {
      $center_permitted = $this->session->userdata('center_permitted');
      $expload_center = explode(',', $center_permitted);
      $center_length = count($expload_center);

      $result = array();
      for($i=0; $i<$center_length;$i++){
      // $where_employee = array('center_id' => $expload_center[$i]);
      // $employees= $this->db->get_where('employee', $where_employee)->result_array();
        $this->db->select('*');
        $this->db->from('employee');
        $this->db->where('center_id',1);
        $query_result=$this->db->get();
        array_push($result, $query_result->result());
    }

      return $result;
    }
	
}