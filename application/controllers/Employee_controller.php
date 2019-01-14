<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}

    }


    public function view()
    {
      $data['page_name'] = 'employee/employee_list';
  		$data['page_title'] = 'Employee';
  		$this->load->view('backend/index',$data);
    }


    public function create()
    {
      $data['page_name'] = 'employee/employee_add';
  		$data['page_title'] = 'Employee';
  		$this->load->view('backend/index',$data);
    }

     public function save() {

        $data = array();

        $data['center_id']=$this->input->post('center_id', true);
        $data['employee_id'] = $this->input->post('employee_id', true);
       	$data['employee_name'] = $this->input->post('employee_name', true);
       	$data['father_name'] = $this->input->post('father_name', true);
        $data['mother_name'] = $this->input->post('mother_name', true);
        $data['email'] = $this->input->post('email', true);
      	$data['contact_number'] = $this->input->post('contact_number', true);
      	$data['present_address'] = $this->input->post('present_address', true);
      	$data['permanent_address'] = $this->input->post('permanent_address', true);
      	$data['spouse_name'] = $this->input->post('spouse_name', true);
      	$data['date_of_birth'] = $this->input->post('date_of_birth', true);
      	$data['date_of_joining'] = $this->input->post('date_of_joining', true);
      	$data['blood_group'] = $this->input->post('blood_group', true);
      	$data['em_name'] = $this->input->post('em_name', true);
      	$data['em_phone'] = $this->input->post('em_phone', true);
      	$data['status'] = ($this->input->post('status') == 'on') ? '1' : '0';
      	$data['user_status'] = '1';

    		$employee_id = $this->input->post('employee_id', true);
        $center_id = $data['center_id'];
		            
      $check_item_name=$this->employee->check_employee_id($employee_id, $center_id);
       
		if($check_item_name){
			$error = "EMPLOYEE ID ALREADY EXIST";
			$this->session->set_userdata('error', $error);
			redirect('employee_controller/create');
		}
		else{

			$this->employee->save_data($data);

			$message = "Employee  added!";
			$this->session->set_userdata('message', $message);
				
	        redirect('employee_controller/view');
		           
			}
			
		}
        


	// Delete data
	public function destory($id)
	{
		$message = "Employee has been Deleted!";
		$this->session->set_userdata('message', $message);

		$result=$this->employee->delete_data($id);
		redirect('employee_controller/view');			

	}

	/// Edit pages
	public function edit($id)
	{
		$data['page_name'] = 'employee/employee_edit';
		$data['page_title'] = 'Employee';
		$data['id'] = $id;
		$this->load->view('backend/index',$data);
	}


	public function update()
	{
        $data = array();
      	
        $id = $this->input->post('id', true);
        $data['center_id']=$this->input->post('center_id', true);
        $data['employee_id'] = $this->input->post('employee_id', true);
       	$data['employee_name'] = $this->input->post('employee_name', true);
       	$data['father_name'] = $this->input->post('father_name', true);
        $data['mother_name'] = $this->input->post('mother_name', true);
        $data['email'] = $this->input->post('email', true);
      	$data['contact_number'] = $this->input->post('contact_number', true);
      	$data['present_address'] = $this->input->post('present_address', true);
      	$data['permanent_address'] = $this->input->post('permanent_address', true);
      	$data['spouse_name'] = $this->input->post('spouse_name', true);
      	$data['date_of_birth'] = $this->input->post('date_of_birth', true);
      	$data['date_of_joining'] = $this->input->post('date_of_joining', true);
      	$data['blood_group'] = $this->input->post('blood_group', true);
      	$data['em_name'] = $this->input->post('em_name', true);
      	$data['em_phone'] = $this->input->post('em_phone', true);
      	$data['status']  =  ($this->input->post('status') == 'on') ? 1 : 0;

		$this->employee->update_data($id,$data);
		redirect('employee_controller/view', 'refresh');	           
			
			
	}

  /**
  * Employee List PDF Generator
  */
  public function employee_pdf()
  {

    $this->load->view('backend/admin/employee/employee_pdf');
  }

  /**
  * Employee List Excel Export
  */
  public function employee_excel()
  {
    $this->load->view('backend/admin/employee/employee_excel');
  }

  /**
  *employee_detail_download
  */
  public function employee_detail_download($employee_id)
  {
    $data['employee_id'] = $employee_id;
    $this->load->view('backend/admin/employee/employee_details_pdf', $data);
  }


	
}