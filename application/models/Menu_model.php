<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	function add_menu($data) {	

		$this->db->insert('menus', $data);
	}

	function edit_menu($id) {

		$data['url_link']		=	$this->input->post('url_link');
		$data['menu']		=	$this->input->post('menu');
		$data['parent_id']		=	$this->input->post('parent_id');
		$data['status']		=	($this->input->post('status') == 'on') ? 1 : 0;

		$this->db->where('id', $id);
		$this->db->update('menus', $data);
	}

	function delete_menu($id) {

		$this->db->where('id', $id);
		$this->db->delete('menus');
	}

	public function return_parent()
	{
		$this->db->select('*');
		$this->db->from('menus');
		$query = $this->db->get();

		return $query->result_array();
	}	


	public function select_all_parent_list()
    {
        $this->db->select('*');
        $this->db->from('menus');
        $this->db->order_by('menu');
        $query_result = $this->db->get();
        $result = $query_result->result();
        return $result;
    }	


    public function select_each_user_role($id)
    {
        $this->db->select('*');
        $this->db->from('menus');
        $this->db->where('id',$id);
        $query_result = $this->db->get();
        $result = $query_result->row();
        return $result;
    }

    public function check_duplicate_menu_exist($menu_name)
	{
		$sql = "SELECT `menu` FROM `menus` WHERE `menu` = '$menu_name' ";
        $query_result = $this->db->query($sql);
        $result = $query_result->row();
        return $result;
	}	


}