<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Center_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

    //create
    public function create()
    {
    	$data['page_name'] = 'center/center_add';
		$data['page_title'] = 'Center';
		$this->load->view('backend/index',$data);
    }

    /**
    *View Function
    **/
    public function view()
    {
    	$data['page_name'] = 'center/center_list';
		$data['page_title'] = 'Center';
		$this->load->view('backend/index',$data);
    }

    /**
    *Edit Function
    **/
    public function edit($id)
    {
    	$data['page_name'] = 'center/center_edit';
		$data['page_title'] = 'Center';
		$data['id'] = $id;
		$this->load->view('backend/index',$data);
    }

    /**
    *Save Function
    **/
    public function save()
    {
    	$data['center_name'] = $this->input->post('center_name', true);
    	$data['status'] = ($this->input->post('status') == 'on') ? '1' : '0';
        $center = $data['center_name'];

        $result = $this->center->check_dublicate_center_exist($center);

        if($result)
        {
            $error = "CENTER ALREADY EXIST!";
            $this->session->set_userdata('error', $error);
            redirect('center_controller/create', 'refresh'); 
        }
        else
        {
            $this->center->store($data);
            $message = "Center added!";
            $this->session->set_userdata('message', $message);
            redirect('center_controller/view', 'refresh');
        }
    }

    /**
    *Delete Function
    **/
    public function destory($center_id)
    {
    	$this->center->delete($center_id);

    	$message = "Center Deleted!";
    	$this->session->set_userdata('message', $message);
    	redirect('center_controller/view', 'refresh');
    }

    //update
    public function update($id)
    {
    	$id = $this->input->post('center_id', true);
    	$data['center_name'] = $this->input->post('center_name', true);
    	$data['status'] = ($this->input->post('status') == 'on') ? '1' : '0';

    	$this->center->update($id, $data);
    	$message = "Center has been Updated!";
    	$this->session->set_userdata('message', $message);
    	redirect('center_controller/view', 'refresh');
    }

	
}