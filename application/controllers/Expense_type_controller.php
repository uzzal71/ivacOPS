<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expense_type_controller extends CI_Controller {

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
    * Class Expense Create function
    */
    public function create()
    {
    	$data['page_name'] = 'expense_type/add_expense_type';
		$data['page_title'] = 'Expense Type';
		$this->load->view('backend/index',$data);
    }

    /**
    * Class Expense View Function
    */
    public function view()
    {
        $data['page_name'] = 'expense_type/expense_type_list';
        $data['page_title'] = 'Expense Type';
        $this->load->view('backend/index',$data); 
    }

    /**
    * Class Expense Save Function
    */
    public function save()
    {
        $data['center_id'] = $this->input->post('center_id', true);
        $data['expense_type'] = $this->input->post('expense_type', true);
        $data['status'] = $this->input->post('status', true);
        $expense_type = $data['expense_type'];
        $center_id = $data['center_id'];

        $result = $this->expense_type->check_dublicate_expense_exist($expense_type, $center_id);

        if($result)
        {
            $error = "CENTER ALREADY EXIST!";
            $this->session->set_userdata('error', $error);
            redirect('Expense_type_controller/create', 'refresh'); 
        }
        else
        {
            $this->expense_type->save_data($data);
            $message = "Expense type added!";
            $this->session->set_userdata('message', $message);
            redirect('Expense_type_controller/create', 'refresh');
        }
    }

    /**
    * Class Expense Edit Function
    */
    public function edit($expense_id)
    {
        $data['page_name'] = 'expense_type/edit_expense_type';
        $data['page_title'] = 'Expense Type Edit';
        $data['expense_id'] = $expense_id;
        $this->load->view('backend/index',$data);
    }

    /**
    * Class Expense Upldate Function
    */
     public function update($expense_id)
    {
        $data['center_id'] = $this->input->post('center_id', true);
        $data['expense_type'] = $this->input->post('expense_type', true);
        $data['status'] = $this->input->post('status', true);

        $this->expense_type->update_data($expense_id, $data);
        $message = "Expense type has been Updated!";
        $this->session->set_userdata('message', $message);
        redirect('Expense_type_controller/view', 'refresh');
    }

    /**
    * Class Expense Delete Function
    **/
    public function destory($expense_id)
    {
        $this->expense_type->delete_data($expense_id);
        $message = "Expense Deleted!";
        $this->session->set_userdata('message', $message);
        redirect('Expense_type_controller/view', 'refresh');
    }


	
}