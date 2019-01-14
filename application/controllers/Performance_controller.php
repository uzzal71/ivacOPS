<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance_controller extends CI_Controller {

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
    	$data['page_name'] = 'performance/performance_add';
		$data['page_title'] = 'Performance';
		$this->load->view('backend/index',$data);
    }

    //save
    public function save()
    {
        $data['recive'] = $this->input->post('recive', true);
        $data['delivery'] = $this->input->post('delivery', true);
        $data['backend'] = $this->input->post('backend', true);
        $data['scanning'] = $this->input->post('scanning', true);
        $data['status'] = $data['status'] = ($this->input->post('status') == 'on') ? '1' : '0';
        $this->performance->store($data);
        $message = "Performance added";
        $this->session->set_userdata('message', $message);
        redirect('performance_controller/view', 'refress');
    }

    //view
    public function view()
    {
    	$data['page_name'] = 'performance/performance_list';
		$data['page_title'] = 'Performance';
		$this->load->view('backend/index',$data);
    }

    //edit
    public function edit($id)
    {
    	$data['page_name'] = 'performance/performance_edit';
		$data['page_title'] = 'Performance';
		$data['id'] = $id;
		$this->load->view('backend/index',$data);
    }

    // update
    public function update()
    {
        $id = $this->input->post('id', true);
        $data['recive'] = $this->input->post('recive', true);
        $data['delivery'] = $this->input->post('delivery', true);
        $data['backend'] = $this->input->post('backend', true);
        $data['scanning'] = $this->input->post('scanning', true);
        $data['status'] = $data['status'] = ($this->input->post('status') == 'on') ? '1' : '0';
        $this->performance->updated($id, $data);
        $message = "Performance updated";
        $this->session->set_userdata('message', $message);
        redirect('performance_controller/view', 'refress');
    }

    //delete
    public function destory($id)
    {
        $this->performance->delete($id);
        $message = "Performance Deleted";
        $this->session->set_userdata('message', $message);
        redirect('performance_controller/view', 'refress');
    }

	
}