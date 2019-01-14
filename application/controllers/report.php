<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*  Report Controller
*/
class Report_controller extends CI_Controller
{

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
    * Score Report Functon
    */
	public function score_report()
	{
		$data['page_name'] = 'report/score_report';
		$data['page_title'] = 'Employee Score Report';
		$this->load->view('backend/index',$data);
	}

	/**
	* Center Summary Report Function
	*/
	public function center_summary_report()
	{
		$this->load->view('backend/admin/report/center_summary_result');
	}

	public function employee_performance_details($employee_id, $from_date, $to_date)
	{
		$data['employee_id'] = $employee_id;
		$data['from_date'] = $from_date;
		$data['to_date'] = $to_date;
		$this->load->view('backend/admin/report/employee_performance_report', $data);
	}

	public function employee_performance_excel()
	{
		$this->load->view('backend/admin/report/employee_performance_excel');
	}

	public function center_summary_excel()
	{
		$this->load->view('backend/admin/report/center_summary_result_excel');
	}

	public function center_details()
	{
		$this->load->view('backend/admin/report/center_details_report');
	}

	public function center_details_excel()
	{
		$this->load->view('backend/admin/report/center_details_excel');
	}
}