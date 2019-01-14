<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_name extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('admin_login') != 1) {
				redirect(site_url(), 'refresh');
		}
    }

	
}