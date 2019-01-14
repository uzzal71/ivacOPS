<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_controller extends CI_Controller {


	/** Class Constructor **/
	public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('admin_login') != 1) {

				redirect(site_url(), 'refresh');
		}
    }


    // User Create Page View Class Function
    public function create()
    {
    	$data['employees']=$this->user->select_all_employee_list();
    	$data['page_name'] = 'users/user_add';
		$data['page_title'] = 'User Add';
		$this->load->view('backend/index',$data);
    }


    // User List View Class Function
    public function view()
    {
    	$data['page_name'] = 'users/user_list';
		$data['page_title'] = 'User List';
		$this->load->view('backend/index',$data);
    }

    /**
    * Get Employee Name
    **/
    public function pick_employee_name()
	{
		 $data = array();
		  $employee_id = $this->input->post('employee_id', true);
		  if($employee_id == 'select'){
		  	echo '';
		  	exit();
		  }
		 $center_id = $this->session->userdata('center_id');
		 $pick_employee_name =$this->user->employee_name($employee_id);
		 $employee_name = $pick_employee_name->employee_name;
		 echo $employee_name;
	}


	// Save User Class Function
	public function save_user(){

        $data=array();
        $employee_id = $this->input->post('employee_id', true);
        $data['employee_id']=$employee_id;
        $data['center_id'] = $this->input->post('center_id', true);
        $center_id =  $data['center_id'];
		$data['menu_permitted'] = $this->input->post('user_role', true);
		$data['center_role'] = $this->input->post('center_role', true);
		$data['center_id'] = $this->input->post('center_id', true);
        $password = $this->input->post('password', true);
        $comfirm_password = $this->input->post('comfirm_password', true);


		if($password != $comfirm_password){
			echo "Confirm Password doesn't match with Password!";
			exit();
		}

        $data['password']=md5($password);
        
		$data['created_at'] = date("Y-m-d H:i:s");

		$data['created_by'] = $this->session->userdata('login_type');
		$data['status']  =  $this->input->post('status', true);

		$check_employee_id = $this->user->check_employee_id($employee_id, $center_id);

		if($check_employee_id){

			echo "EMPLOYEE ID ALREADY EXIST!";

			exit();
		}

		else{

			
			$save_user = $this->user->save_user_info($data);

			if($save_user){
				$sql = "UPDATE `employee` SET `user_status` = 2 WHERE  `employee_id` = '$employee_id' ";

	        	$this->db->query($sql);

				echo "Saved";
				
		}	else{
				echo "Not saved";
				
			}
		}

    }


    // User Edit Page View Class Function
    public function edit($id, $employee_id)
    {
    	$data['page_name'] = 'users/edit_user';
		$data['page_title'] = 'User Edit';
		$center_id = $this->session->userdata('center_id');
		$data['each_user'] = $this->user->select_each_user_info($id, $employee_id);
		$data['employee_id'] = $employee_id;
		$data['id'] = $id;
		$this->load->view('backend/index',$data);
    }
    /**
    * User Update Class Function
    **/
    public function update_user()
	{	
        $data=array();
		$center_id = $this->session->userdata('center_id');
        $employee_id=$this->input->post('employee_id', true);
        $data['employee_id']=$employee_id;

		$data['menu_permitted']=$this->input->post('user_role', true);
		$data['center_role']=$this->input->post('center_role', true);
		$data['center_id']=$this->input->post('center_id', true);
		
 
		$data['created_at'] = date("y-m-d h:i:s");
		$data['created_by'] = $this->session->userdata('login_type');
		$data['status'] = $this->input->post('status', true);

		$update_user = $this->user->update_user_info($employee_id, $data);

		if($update_user)
		{
			echo "Updated user info";
		}	
		else
		{
			echo "Not updated";
		}	

    }


    // Delete User Information Class Function
    public function destory($id, $employee_id)
    {
    	$sql = "UPDATE `employee` SET `user_status` = 1 WHERE  `employee_id` = '$employee_id' ";
		$this->db->query($sql);
    	$this->user->delete_user_info($id);
    	redirect('user_controller/view', 'refresh');
    }

	//pick employee ID
	public function pick_employee_list()
	{
    	$center_id=$this->input->post('center_id',true);
    	$where_data = array('center_id' => $center_id, 'user_status' => 1);
    	$employees=$this->db->get_where('employee', $where_data)->result_array();

    	if($employees)
		{
			$return_html = '<option value="select">Select</option>';
			foreach($employees as $row)
			{
				$return_html = $return_html.'<option value = "'.$row['employee_id'].'">'.$row['employee_name'].'</option>';
			}
		
				echo $return_html;
		}

		else
			{
				echo "No User Found!";
			}	
  
	}

	/**
	*Pick Employee List Without Status
	**/
	public function pick_employee_list_without_status()
	{
		$center_id=$this->input->post('center_id',true);
    	$where_data = array('center_id' => $center_id);
    	$employees=$this->db->get_where('employee', $where_data)->result_array();

    	if($employees)
		{
			$return_html = '<option value="select">Select</option>';
			foreach($employees as $row)
			{
				$return_html = $return_html.'<option value = "'.$row['employee_id'].'">'.$row['employee_id'].'</option>';
			}
		
				echo $return_html;
		}

		else
			{
				echo "No User Found!";
			}
	}


	/**
	* Admin Change User Password
	**/
	public function Admin_Change_User_Password()
	{
		$data['page_name'] = 'users/admin_cup';
		$data['page_title'] = 'Admin Change User Password';
		$this->load->view('backend/index',$data);
	}

	/**
	* Admin Change User Password
	**/
	public function Admin_Change_User_Password_Save()
	{
		$employee_id = $this->input->post('employee_id', true);
		$password = md5($this->input->post('password', true));

		$sql = "UPDATE `users` SET `password` = '$password' WHERE  `employee_id` = '$employee_id' ";
		$this->db->query($sql);
		echo "Change User Password!";
    	redirect('user_controller/Admin_Change_User_Password', 'refresh');
	}

	/**
	*pick_employee_name_check_center
	**/
	public function pick_employee_name_check_center()
	{
		$data = array();
		  $employee_id = $this->input->post('employee_id', true);
		  $center_id = $this->session->userdata('set_center');

		  if($employee_id == 'select'){
		  	echo '';
		  	exit();
		  }
		 
		 $pick_employee_name =$this->user->employee_name_with_center($employee_id, $center_id);
		 $employee_name = $pick_employee_name->employee_name;
		 echo $employee_name;
	}

	/**
	**center_set_session
	**/
	public function center_set_session()
	{
		$center_id = $this->input->post('center_id', true);
		$this->session->set_userdata('set_center',$center_id);
		echo "Center Set";
	}


	
}