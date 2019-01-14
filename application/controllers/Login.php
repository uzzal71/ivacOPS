S<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('admin_login')==1) {
			
			redirect(site_url('admin/dashboard'),'refresh');
		}
		$this->load->view('backend/login');
	}

	function attempt_login(){
		$employee_id = $this->input->post('employee_id');
		$password = md5($this->input->post('password'));

		$credentials = array('employee_id' => $employee_id, 'password' => $password, 'status' => 1 );

		$query = $this->db->get_where('users',$credentials);
		if ($query->num_rows()>0) {
			$this->session->set_userdata('admin_login',1);
			$this->session->set_userdata('login_type','admin');
			$this ->session->set_userdata('center_id',$query->row()->center_id);
			$this ->session->set_userdata('employee_id',$query->row()->employee_id);
			$this->session->set_userdata('menu_permitted', $query->row()->menu_permitted);
			$this->session->set_userdata('center_permitted', $query->row()->center_role);

			redirect(site_url('admin/dashboard'), 'refresh');
		}

		$error = "Username & password not match!";
		$this->session->set_userdata('error', $error);

		$this->load->view('backend/login', 'refresh');
	}
	function logout(){
		$this->session->sess_destroy();
		$message = "Logout sucessfuly!";
		$this->session->set_userdata('message', $message);
		$this->load->view('backend/login', 'refresh');
	}
}