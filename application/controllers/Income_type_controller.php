<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Income_type_controller extends CI_Controller {

	/**
	* Class Constructor
	*/
	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

    /**
    * Class Income Type Create Function
    */
    public function create()
    {
    	$data['page_name'] = 'income_type/add_income_type';
		$data['page_title'] = 'Add Income Type';
		$this->load->view('backend/index',$data);
    }

    /**
    * Class Income Type View Function
    */
    public function view()
    {
        $data['page_name'] = 'income_type/income_type_list';
        $data['page_title'] = 'Income Type List';
        $this->load->view('backend/index',$data); 
    }

    /**
    * Class Income Type Save Function
    */
    public function save()
    {
        $data['center_id'] = $this->input->post('center_id', true);
        $data['income_type'] = $this->input->post('income_type', true);
        $data['income_amount'] = $this->input->post('income_amount', true);
        $data['status'] = $this->input->post('status', true);
        $income_type = $data['income_type'];
        $center_id = $data['center_id'];

        $result = $this->income_type->check_dublicate_income_exist($income_type, $center_id);

        if($result)
        {
            $error = "CENTER ALREADY EXIST!";
            $this->session->set_userdata('error', $error);
            redirect('income_type_controller/create', 'refresh'); 
        }
        else
        {
            $this->income_type->save_data($data);
            $message = "Income type added!";
            $this->session->set_userdata('message', $message);
            redirect('income_type_controller/create', 'refresh');
        }
    }

    /**
    * Class Income Type Edit Function
    **/
    public function Edit($income_id)
    {
        $data['page_name'] = 'income_type/edit_income_type';
        $data['page_title'] = 'Income Type Edit';
        $data['income_id'] = $income_id;
        $this->load->view('backend/index',$data);
    }

    /**
    * Class Income Type Upload Function
    **/
    public function Update($income_id)
    {
        $data['center_id'] = $this->input->post('center_id', true);
        $data['income_type'] = $this->input->post('income_type', true);
        $data['income_amount'] = $this->input->post('income_amount', true);
        $data['status'] = $this->input->post('status', true);

        $this->income_type->update_data($income_id, $data);
        $message = "INcome type has been Updated!";
        $this->session->set_userdata('message', $message);
        redirect('income_type_controller/view', 'refresh');
    }

    /**
    * Class Income Type Delete Function
    **/
    public function destory($income_id)
    {
        $this->income_type->delete_data($income_id);
        $message = "Income Type Deleted!";
        $this->session->set_userdata('message', $message);
        redirect('income_type_controller/view', 'refresh');
    }


	
}