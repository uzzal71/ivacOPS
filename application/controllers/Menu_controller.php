<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

    public function create()
    {
    	$page_data['page_name'] = 'menu/menu_add';
		$page_data['page_title'] = 'Add New Menu';
		$page_data['parent_select'] = $this->menu->return_parent();

		$this->load->view('backend/index', $page_data);
    }

    // save data
    public function save()
    {
        $data['url_link']   =   $this->input->post('url_link');
        $data['menu']       =   $this->input->post('menu');
        $data['parent_id']      =   $this->input->post('parent_id');
        $data['status']     =   ($this->input->post('status') == 'on') ? 1 : 0;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['created_by'] = $this->session->userdata('logged_in_user');
        $menu_name = $data['menu'];

        $result = $this->menu->check_duplicate_menu_exist($menu_name);
        if($result)
        {
            $error = "MENU ALREADY EXIST!";
            $this->session->set_userdata('error', $error);
            redirect('menu_controller/create', 'refresh');
        }
        else
        {
            $this->menu->add_menu($data);
            $message = "Menu added!";
            $this->session->set_userdata("message", $message);
            redirect(site_url('menu_controller/view'), 'refresh');
        }

    }

    //view function
    public function view()
    {
    	$page_data['page_name'] = 'menu/menu_list';
		$page_data['page_title'] = 'Menu';

		$this->load->view('backend/index', $page_data);
    }

    // edit
    public function edit($id)
    {
    	$page_data['page_name'] = 'menu/menu_edit';
		$page_data['page_title'] = 'Menu Edit';
		$page_data['id'] = $id;
		$page_data['each_user_role']=$this->menu->select_each_user_role($id);
		$page_data['all_role']=$this->menu->select_all_parent_list();

		$this->load->view('backend/index', $page_data);
    }


    // update
    public function update($id)
    {
    	$this->menu->edit_menu($id);
        $message = "Menu Updated!";
        $this->session->set_userdata("message", $message);
    	redirect(site_url('menu_controller/view'), 'refresh');
    }

    // destory
    public function destory($id)
    {
    	$this->menu->delete_menu($id);
        $message = "Menu Deleted!";
        $this->session->set_userdata("message", $message);
    	redirect(site_url('menu_controller/view'), 'refresh');
    }

	
}