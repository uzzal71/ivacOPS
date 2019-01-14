<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information_controller extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

    public function profile_details()
    {
    	$data['page_name'] = 'profile/profile_view';
		$data['page_title'] = 'Profile';
		$this->load->view('backend/index',$data);
    }

    public function change_password()
    {
    	$data['page_name'] = 'profile/change_password';
		$data['page_title'] = 'Change Password';
		$this->load->view('backend/index',$data);
    }

    public function save_password()
    {
    	$password = $this->input->post('password', true);
    	$confirm_password = $this->input->post('confirm_password', true);
    	$employee_id = $this->input->post('employee_id', true);

    	if($password != $confirm_password){

			$error = "Password not match plase type again";
			$this->session->set_userdata('error', $error);

			redirect('information_controller/change_password', 'refresh');
		}

		$password = md5($password);

		$this->information->save($employee_id, $password);

		$message = "Password changed successfuly!";
		$this->session->set_userdata('message', $message);

		redirect('information_controller/change_password', 'refresh');
    }

	
}