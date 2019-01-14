<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        if ($this->session->userdata('admin_login') != 1) {

				redirect(site_url(), 'refresh');
		}
    }

	public function index()
	{
		if ($this->session->userdata('admin_login') != 1) {

			redirect(site_url(), 'refresh');
		}
	}

	/** Dashboard view **/
	function dashboard(){

		if ($this->session->userdata('admin_login') != 1) {

			redirect(site_url(), 'refresh');
		}

		$data['page_name'] = 'dashboard';
		$data['page_title'] = 'DashBoard';
		$this->load->view('backend/index',$data);
	}


}